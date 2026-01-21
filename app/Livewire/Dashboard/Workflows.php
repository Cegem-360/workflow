<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Workflow;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

final class Workflows extends Component
{
    use WithPagination;

    public string $search = '';

    public string $filter = 'all';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function toggleActive(int $workflowId): void
    {
        $workflow = $this->getWorkflowById($workflowId);

        if ($workflow) {
            $workflow->update(['is_active' => ! $workflow->is_active]);
        }
    }

    public function delete(int $workflowId): void
    {
        $workflow = $this->getWorkflowById($workflowId);

        if ($workflow) {
            $workflow->delete();
        }
    }

    public function render(): View
    {
        $team = Auth::user()->teams->first();
        $query = Workflow::query()
            ->where('team_id', $team?->id)
            ->withCount('nodes');

        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%');
        }

        if ($this->filter === 'active') {
            $query->where('is_active', true);
        } elseif ($this->filter === 'inactive') {
            $query->where('is_active', false);
        } elseif ($this->filter === 'scheduled') {
            $query->where('is_scheduled', true);
        } elseif ($this->filter === 'webhook') {
            $query->where('webhook_enabled', true);
        }

        $workflows = $query->latest()->paginate(10);

        return view('livewire.dashboard.workflows', [
            'workflows' => $workflows,
        ])->layout('components.layouts.dashboard', ['title' => __('My Workflows')]);
    }

    private function getWorkflowById(int $workflowId): ?Workflow
    {
        $team = Auth::user()->teams->first();

        return Workflow::where('id', $workflowId)
            ->where('team_id', $team?->id)
            ->first();
    }
}
