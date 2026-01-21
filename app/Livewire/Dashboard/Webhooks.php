<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Workflow;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class Webhooks extends Component
{
    public function toggleWebhook(int $workflowId): void
    {
        $workflow = $this->getWorkflowById($workflowId);

        if ($workflow) {
            $workflow->update(['webhook_enabled' => ! $workflow->webhook_enabled]);

            if ($workflow->webhook_enabled && ! $workflow->webhook_token) {
                $workflow->generateWebhookToken();
            }
        }
    }

    public function regenerateToken(int $workflowId): void
    {
        $workflow = $this->getWorkflowById($workflowId);

        if ($workflow) {
            $workflow->generateWebhookToken();
        }
    }

    public function render(): View
    {
        $team = Auth::user()->teams->first();

        $webhookWorkflows = Workflow::query()
            ->where('team_id', $team?->id)
            ->where('webhook_enabled', true)
            ->latest()
            ->get();

        $otherWorkflows = Workflow::query()
            ->where('team_id', $team?->id)
            ->where('webhook_enabled', false)
            ->latest()
            ->get();

        return view('livewire.dashboard.webhooks', [
            'webhookWorkflows' => $webhookWorkflows,
            'otherWorkflows' => $otherWorkflows,
        ])->layout('components.layouts.dashboard', ['title' => __('Webhooks')]);
    }

    private function getWorkflowById(int $workflowId): ?Workflow
    {
        $team = Auth::user()->teams->first();

        return Workflow::where('id', $workflowId)
            ->where('team_id', $team?->id)
            ->first();
    }
}
