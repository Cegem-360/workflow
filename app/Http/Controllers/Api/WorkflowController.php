<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\Workflow;
use App\Models\WorkflowConnection;
use App\Models\WorkflowNode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class WorkflowController extends Controller
{
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
            'is_active' => 'boolean',
            'metadata' => 'nullable|array',
            'nodes' => 'nullable|array',
            'connections' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $workflow = Workflow::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'is_active' => $validated['is_active'] ?? true,
                'metadata' => $validated['metadata'] ?? null,
            ]);

            if (isset($validated['nodes'])) {
                foreach ($validated['nodes'] as $node) {
                    WorkflowNode::create([
                        'workflow_id' => $workflow->id,
                        'node_id' => $node['id'],
                        'type' => $node['type'],
                        'label' => $node['data']['label'] ?? null,
                        'data' => $node['data'] ?? null,
                        'position' => $node['position'] ?? null,
                    ]);
                }
            }

            if (isset($validated['connections'])) {
                foreach ($validated['connections'] as $connection) {
                    WorkflowConnection::create([
                        'workflow_id' => $workflow->id,
                        'connection_id' => $connection['id'],
                        'source_node_id' => $connection['source'],
                        'target_node_id' => $connection['target'],
                        'source_handle' => $connection['sourceHandle'] ?? null,
                        'target_handle' => $connection['targetHandle'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return response()->json($workflow->load(['nodes', 'connections']), 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        $workflow = Workflow::with(['nodes', 'connections'])->findOrFail($id);

        return response()->json($workflow);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'metadata' => 'nullable|array',
            'nodes' => 'nullable|array',
            'connections' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $workflow = Workflow::findOrFail($id);

            $workflow->update([
                'name' => $validated['name'] ?? $workflow->name,
                'description' => $validated['description'] ?? $workflow->description,
                'is_active' => $validated['is_active'] ?? $workflow->is_active,
                'metadata' => $validated['metadata'] ?? $workflow->metadata,
            ]);

            if (isset($validated['nodes'])) {
                $workflow->nodes()->delete();
                foreach ($validated['nodes'] as $node) {
                    WorkflowNode::create([
                        'workflow_id' => $workflow->id,
                        'node_id' => $node['id'],
                        'type' => $node['type'],
                        'label' => $node['data']['label'] ?? null,
                        'data' => $node['data'] ?? null,
                        'position' => $node['position'] ?? null,
                    ]);
                }
            }

            if (isset($validated['connections'])) {
                $workflow->connections()->delete();
                foreach ($validated['connections'] as $connection) {
                    WorkflowConnection::create([
                        'workflow_id' => $workflow->id,
                        'connection_id' => $connection['id'],
                        'source_node_id' => $connection['source'],
                        'target_node_id' => $connection['target'],
                        'source_handle' => $connection['sourceHandle'] ?? null,
                        'target_handle' => $connection['targetHandle'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return response()->json($workflow->load(['nodes', 'connections']));
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        $workflow = Workflow::findOrFail($id);
        $workflow->delete();

        return response()->json(['message' => 'Workflow deleted successfully']);
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
}
