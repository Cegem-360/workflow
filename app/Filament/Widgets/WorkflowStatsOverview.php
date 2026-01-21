<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Workflow;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class WorkflowStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $teamId = Filament::getTenant()?->id;

        $totalWorkflows = Workflow::where('team_id', $teamId)->count();
        $activeWorkflows = Workflow::where('team_id', $teamId)->where('is_active', true)->count();
        $scheduledWorkflows = Workflow::where('team_id', $teamId)->where('is_scheduled', true)->count();
        $webhookEnabledWorkflows = Workflow::where('team_id', $teamId)->where('webhook_enabled', true)->count();

        return [
            Stat::make(__('Total Workflows'), (string) $totalWorkflows)
                ->description(__('All workflows in your team'))
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('gray'),

            Stat::make(__('Active Workflows'), (string) $activeWorkflows)
                ->description(__('Currently enabled'))
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make(__('Scheduled'), (string) $scheduledWorkflows)
                ->description(__('Running on schedule'))
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),

            Stat::make(__('Webhook Enabled'), (string) $webhookEnabledWorkflows)
                ->description(__('Triggered by webhooks'))
                ->descriptionIcon('heroicon-m-bolt')
                ->color('warning'),
        ];
    }
}
