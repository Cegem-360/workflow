<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\Team;
use App\Models\Workflow;
use App\Services\Google\GoogleCalendarService;
use App\Services\Google\GoogleDocsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class WorkflowController extends Controller
{
    public function __construct(
        protected GoogleCalendarService $calendarService,
        protected GoogleDocsService $docsService
    ) {}

    public function index(): JsonResponse
    {
        $workflows = Workflow::with(['nodes', 'connections'])->get();

        return response()->json($workflows);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'team_id' => 'required|exists:teams,id',
            'is_active' => 'boolean',
            'is_scheduled' => 'boolean',
            'schedule_cron' => 'nullable|string|max:100',
            'webhook_enabled' => 'boolean',
            'metadata' => 'nullable|array',
            'nodes' => 'nullable|array',
            'connections' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $workflow = Workflow::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'team_id' => $validated['team_id'],
                'is_active' => $validated['is_active'] ?? true,
                'is_scheduled' => $validated['is_scheduled'] ?? false,
                'schedule_cron' => $validated['schedule_cron'] ?? null,
                'webhook_enabled' => $validated['webhook_enabled'] ?? false,
                'metadata' => $validated['metadata'] ?? null,
            ]);

            if ($workflow->is_scheduled && $workflow->schedule_cron) {
                $workflow->update(['next_run_at' => $workflow->calculateNextRunAt()]);
            }

            $this->syncNodes($workflow, $validated['nodes'] ?? []);
            $this->syncConnections($workflow, $validated['connections'] ?? []);

            DB::commit();

            return response()->json($workflow->load(['nodes', 'connections']), 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Workflow $workflow): JsonResponse
    {
        return response()->json($workflow->load(['nodes', 'connections']));
    }

    public function update(Request $request, Workflow $workflow): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'team_id' => 'sometimes|required|exists:teams,id',
            'is_active' => 'boolean',
            'is_scheduled' => 'boolean',
            'schedule_cron' => 'nullable|string|max:100',
            'webhook_enabled' => 'boolean',
            'metadata' => 'nullable|array',
            'nodes' => 'nullable|array',
            'connections' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $workflowFields = ['name', 'description', 'team_id', 'is_active', 'is_scheduled', 'schedule_cron', 'webhook_enabled', 'metadata'];
            $workflow->update(collect($validated)->only($workflowFields)->toArray());

            $this->updateScheduleIfNeeded($workflow, $validated);

            if (isset($validated['nodes'])) {
                $workflow->nodes()->delete();
                $this->syncNodes($workflow, $validated['nodes']);
            }

            if (isset($validated['connections'])) {
                $workflow->connections()->delete();
                $this->syncConnections($workflow, $validated['connections']);
            }

            DB::commit();

            return response()->json($workflow->load(['nodes', 'connections']));
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Workflow $workflow): JsonResponse
    {
        $workflow->delete();

        return response()->json(['message' => 'Workflow deleted successfully']);
    }

    public function generateWebhookToken(Workflow $workflow): JsonResponse
    {
        $workflow->generateWebhookToken();

        return response()->json($workflow->load(['nodes', 'connections']));
    }

    public function emailTemplates(Request $request): JsonResponse
    {
        $teamId = $request->query('team_id');

        $query = EmailTemplate::where('is_active', true);

        if ($teamId) {
            $query->where('team_id', $teamId);
        }

        $templates = $query->get(['id', 'name', 'slug', 'subject', 'variables']);

        return response()->json($templates);
    }

    public function sendEmail(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'template' => 'required|string',
            'recipients' => 'required|array',
            'recipients.*' => 'email',
            'subject' => 'nullable|string',
            'customData' => 'nullable|array',
            'team_id' => 'nullable|integer',
        ]);

        try {
            $query = EmailTemplate::where('slug', $validated['template'])
                ->where('is_active', true);

            if (isset($validated['team_id'])) {
                $query->where('team_id', $validated['team_id']);
            }

            $template = $query->first();

            if (! $template) {
                return response()->json([
                    'success' => false,
                    'error' => 'Email template not found: '.$validated['template'],
                ], 404);
            }

            $customData = $validated['customData'] ?? [];
            $rendered = $template->render($customData);

            $subject = $validated['subject'] ?? $rendered['subject'];

            foreach ($validated['recipients'] as $recipient) {
                Mail::html($rendered['body_html'], function ($message) use ($recipient, $subject) {
                    $message->to($recipient)
                        ->subject($subject);
                });
            }

            return response()->json([
                'success' => true,
                'message' => 'Email sent successfully',
                'recipients' => $validated['recipients'],
                'template' => $template->slug,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function scheduleOptions(Request $request): JsonResponse
    {
        $team = Team::find($request->query('team_id'));

        if (! $team) {
            return response()->json([]);
        }

        $options = $team->availableScheduleOptions()
            ->get()
            ->map(fn ($option) => [
                'value' => $option->cron_expression,
                'label' => $option->name,
                'description' => $option->description,
            ]);

        return response()->json($options);
    }

    public function executeGoogleCalendar(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'operation' => 'required|in:create,list,update,delete',
            'calendarId' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'startDateTime' => 'nullable|string',
            'endDateTime' => 'nullable|string',
            'attendees' => 'nullable|string',
            'eventId' => 'nullable|string',
            'timeMin' => 'nullable|string',
            'timeMax' => 'nullable|string',
            'maxResults' => 'nullable|integer',
        ]);

        try {
            $team = Team::findOrFail($validated['team_id']);

            if (! $team->hasGoogleCalendarConnected()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Google Calendar is not connected for this team',
                ], 400);
            }

            $calendarId = $validated['calendarId'] ?? 'primary';

            $result = match ($validated['operation']) {
                'create' => $this->calendarService->createEvent($team, $calendarId, [
                    'summary' => $validated['summary'] ?? '',
                    'description' => $validated['description'] ?? '',
                    'location' => $validated['location'] ?? '',
                    'start' => [
                        'dateTime' => $validated['startDateTime'] ?? now()->toIso8601String(),
                        'timeZone' => config('app.timezone', 'Europe/Budapest'),
                    ],
                    'end' => [
                        'dateTime' => $validated['endDateTime'] ?? now()->addHour()->toIso8601String(),
                        'timeZone' => config('app.timezone', 'Europe/Budapest'),
                    ],
                    'attendees' => $this->parseAttendees($validated['attendees'] ?? ''),
                ]),
                'list' => $this->calendarService->listEvents($team, $calendarId, [
                    'timeMin' => $validated['timeMin'] ?? null,
                    'timeMax' => $validated['timeMax'] ?? null,
                    'maxResults' => $validated['maxResults'] ?? 10,
                ]),
                'update' => $this->calendarService->updateEvent(
                    $team,
                    $calendarId,
                    $validated['eventId'] ?? '',
                    array_filter([
                        'summary' => $validated['summary'] ?? null,
                        'description' => $validated['description'] ?? null,
                        'location' => $validated['location'] ?? null,
                        'start' => isset($validated['startDateTime']) ? [
                            'dateTime' => $validated['startDateTime'],
                            'timeZone' => config('app.timezone', 'Europe/Budapest'),
                        ] : null,
                        'end' => isset($validated['endDateTime']) ? [
                            'dateTime' => $validated['endDateTime'],
                            'timeZone' => config('app.timezone', 'Europe/Budapest'),
                        ] : null,
                    ])
                ),
                'delete' => $this->calendarService->deleteEvent($team, $calendarId, $validated['eventId'] ?? ''),
            };

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function executeGoogleDocs(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'operation' => 'required|in:create,read,update,list',
            'documentId' => 'nullable|string',
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'updateOperation' => 'nullable|in:append,prepend,replace,insertAt',
            'searchText' => 'nullable|string',
            'insertIndex' => 'nullable|integer',
            'maxResults' => 'nullable|integer',
        ]);

        try {
            $team = Team::findOrFail($validated['team_id']);

            if (! $team->googleCredential) {
                return response()->json([
                    'success' => false,
                    'error' => 'Google is not connected for this team',
                ], 400);
            }

            $result = match ($validated['operation']) {
                'create' => $this->docsService->createDocument(
                    $team,
                    $validated['title'] ?? 'Untitled Document',
                    $validated['content'] ?? null
                ),
                'read' => $this->docsService->getDocument($team, $validated['documentId'] ?? ''),
                'update' => $this->docsService->updateDocument($team, $validated['documentId'] ?? '', [
                    'operation' => $validated['updateOperation'] ?? 'append',
                    'content' => $validated['content'] ?? '',
                    'searchText' => $validated['searchText'] ?? '',
                    'insertIndex' => $validated['insertIndex'] ?? 1,
                ]),
                'list' => $this->docsService->listDocuments($team, [
                    'maxResults' => $validated['maxResults'] ?? 20,
                ]),
            };

            // Check for error response (e.g., 404)
            if (\is_array($result) && isset($result['success']) && $result['success'] === false) {
                return response()->json($result, 404);
            }

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    protected function syncNodes(Workflow $workflow, array $nodes): void
    {
        foreach ($nodes as $node) {
            $workflow->nodes()->create([
                'node_id' => $node['id'],
                'type' => $node['type'],
                'label' => $node['data']['label'] ?? null,
                'data' => $node['data'] ?? null,
                'position' => $node['position'] ?? null,
            ]);
        }
    }

    protected function syncConnections(Workflow $workflow, array $connections): void
    {
        foreach ($connections as $connection) {
            $workflow->connections()->create([
                'connection_id' => $connection['id'],
                'source_node_id' => $connection['source'],
                'target_node_id' => $connection['target'],
                'source_handle' => $connection['sourceHandle'] ?? null,
                'target_handle' => $connection['targetHandle'] ?? null,
            ]);
        }
    }

    protected function updateScheduleIfNeeded(Workflow $workflow, array $validated): void
    {
        if (! isset($validated['is_scheduled']) && ! isset($validated['schedule_cron'])) {
            return;
        }

        if ($workflow->is_scheduled && $workflow->schedule_cron) {
            $workflow->update(['next_run_at' => $workflow->calculateNextRunAt()]);
        } elseif (! $workflow->is_scheduled) {
            $workflow->update(['next_run_at' => null]);
        }
    }

    protected function parseAttendees(string $attendees): array
    {
        if (empty($attendees)) {
            return [];
        }

        return collect(explode(',', $attendees))
            ->map(fn ($email) => ['email' => trim($email)])
            ->filter(fn ($a) => filter_var($a['email'], FILTER_VALIDATE_EMAIL))
            ->values()
            ->toArray();
    }
}
