<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Workflow;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class WorkflowsCreate extends Component
{
    public string $name = '';

    public string $description = '';

    public bool $isActive = false;

    public bool $isScheduled = false;

    public string $scheduleCron = '';

    public bool $webhookEnabled = false;

    /**
     * @var array<string, array<string>>
     */
    protected array $rules = [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:1000'],
        'isActive' => ['boolean'],
        'isScheduled' => ['boolean'],
        'scheduleCron' => ['nullable', 'string'],
        'webhookEnabled' => ['boolean'],
    ];

    public function create(): void
    {
        $this->validate();

        $team = Auth::user()->teams->first();

        if (! $team) {
            $this->addError('name', __('You must be part of a team to create workflows.'));

            return;
        }

        $workflow = Workflow::create([
            'team_id' => $team->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->isActive,
            'is_scheduled' => $this->isScheduled,
            'schedule_cron' => $this->isScheduled ? $this->scheduleCron : null,
            'webhook_enabled' => $this->webhookEnabled,
        ]);

        if ($this->webhookEnabled) {
            $workflow->generateWebhookToken();
        }

        $this->redirect(route('dashboard.workflows.editor', $workflow));
    }

    public function render(): View
    {
        return view('livewire.dashboard.workflows-create')
            ->layout('components.layouts.dashboard', ['title' => __('Create Workflow')]);
    }
}
