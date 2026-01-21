<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Workflow;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
final class WorkflowsCreate extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    /** @var array<string, mixed> */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'is_active' => false,
            'is_scheduled' => false,
            'webhook_enabled' => false,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        $team = Auth::user()->teams->first();

        return $schema
            ->statePath('data')
            ->model(Workflow::class)
            ->components([
                Section::make(__('Basic Information'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Workflow Name'))
                            ->placeholder(__('Enter workflow name...'))
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label(__('Description'))
                            ->placeholder(__('Describe what this workflow does...'))
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Section::make(__('Settings'))
                    ->schema([
                        Toggle::make('is_active')
                            ->label(__('Active'))
                            ->helperText(__('Enable this workflow to run')),
                        Toggle::make('is_scheduled')
                            ->label(__('Scheduled'))
                            ->helperText(__('Run this workflow on a schedule'))
                            ->live(),
                        Select::make('schedule_cron')
                            ->label(__('Schedule Frequency'))
                            ->options(function () use ($team) {
                                if (! $team) {
                                    return [
                                        '* * * * *' => __('Every minute'),
                                        '*/5 * * * *' => __('Every 5 minutes'),
                                        '*/10 * * * *' => __('Every 10 minutes'),
                                        '*/15 * * * *' => __('Every 15 minutes'),
                                        '*/30 * * * *' => __('Every 30 minutes'),
                                        '0 * * * *' => __('Every hour'),
                                        '0 */4 * * *' => __('Every 4 hours'),
                                        '0 */12 * * *' => __('Every 12 hours'),
                                        '0 0 * * *' => __('Daily'),
                                    ];
                                }

                                return $team->availableScheduleOptions()
                                    ->get()
                                    ->pluck('name', 'cron_expression')
                                    ->toArray();
                            })
                            ->visible(fn ($get): bool => (bool) $get('is_scheduled'))
                            ->required(fn ($get): bool => (bool) $get('is_scheduled')),
                        Toggle::make('webhook_enabled')
                            ->label(__('Webhook'))
                            ->helperText(__('Trigger this workflow via webhook URL')),
                    ])
                    ->columns(1),
            ]);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $team = Auth::user()->teams->first();

        if (! $team) {
            Notification::make()
                ->title(__('You must be part of a team to create workflows.'))
                ->danger()
                ->send();

            return;
        }

        $workflow = Workflow::create([
            'team_id' => $team->id,
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'is_active' => $data['is_active'] ?? false,
            'is_scheduled' => $data['is_scheduled'] ?? false,
            'schedule_cron' => ($data['is_scheduled'] ?? false) ? ($data['schedule_cron'] ?? null) : null,
            'webhook_enabled' => $data['webhook_enabled'] ?? false,
        ]);

        if ($data['webhook_enabled'] ?? false) {
            $workflow->generateWebhookToken();
        }

        Notification::make()
            ->title(__('Workflow created successfully.'))
            ->success()
            ->send();

        $this->redirect(route('dashboard.workflows.editor', $workflow), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.dashboard.workflows-create');
    }
}
