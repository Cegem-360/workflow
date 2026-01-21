<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Workflow;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class Index extends Component
{
    public int $totalWorkflows = 0;

    public int $activeWorkflows = 0;

    public int $scheduledWorkflows = 0;

    public int $webhookWorkflows = 0;

    /**
     * @var \Illuminate\Database\Eloquent\Collection<int, Workflow>
     */
    public $recentWorkflows;

    public function mount(): void
    {
        $team = Auth::user()->teams->first();

        if ($team) {
            $this->totalWorkflows = Workflow::where('team_id', $team->id)->count();
            $this->activeWorkflows = Workflow::where('team_id', $team->id)->where('is_active', true)->count();
            $this->scheduledWorkflows = Workflow::where('team_id', $team->id)->where('is_scheduled', true)->count();
            $this->webhookWorkflows = Workflow::where('team_id', $team->id)->where('webhook_enabled', true)->count();
            $this->recentWorkflows = Workflow::where('team_id', $team->id)
                ->with('nodes')
                ->latest()
                ->limit(5)
                ->get();
        } else {
            $this->recentWorkflows = collect();
        }
    }

    public function render(): View
    {
        return view('livewire.dashboard.index')
            ->layout('components.layouts.dashboard', ['title' => __('Dashboard')]);
    }
}
