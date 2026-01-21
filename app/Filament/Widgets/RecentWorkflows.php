<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Filament\Resources\Workflows\WorkflowResource;
use App\Models\Workflow;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

final class RecentWorkflows extends TableWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('Recent Workflows'))
            ->query(fn (): Builder => Workflow::query()
                ->where('team_id', Filament::getTenant()?->id)
                ->latest()
                ->limit(5)
            )
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                IconColumn::make('is_scheduled')
                    ->label(__('Scheduled'))
                    ->boolean()
                    ->trueIcon('heroicon-o-clock')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('info')
                    ->falseColor('gray'),

                IconColumn::make('webhook_enabled')
                    ->label(__('Webhook'))
                    ->boolean()
                    ->trueIcon('heroicon-o-bolt')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                TextColumn::make('nodes_count')
                    ->label(__('Nodes'))
                    ->counts('nodes')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('last_run_at')
                    ->label(__('Last Run'))
                    ->dateTime()
                    ->since()
                    ->placeholder(__('Never')),

                TextColumn::make('updated_at')
                    ->label(__('Updated'))
                    ->dateTime()
                    ->since(),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label(__('Edit'))
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Workflow $record): string => WorkflowResource::getUrl('edit', ['record' => $record])),

                Action::make('editor')
                    ->label(__('Visual Editor'))
                    ->icon('heroicon-o-play')
                    ->color('success')
                    ->url(fn (Workflow $record): string => url('/admin?workflow='.$record->id))
                    ->openUrlInNewTab(),
            ])
            ->emptyStateHeading(__('No workflows yet'))
            ->emptyStateDescription(__('Create your first workflow to get started.'))
            ->emptyStateIcon('heroicon-o-squares-2x2')
            ->emptyStateActions([
                Action::make('create')
                    ->label(__('Create Workflow'))
                    ->url(WorkflowResource::getUrl('create'))
                    ->icon('heroicon-o-plus'),
            ])
            ->paginated(false);
    }
}
