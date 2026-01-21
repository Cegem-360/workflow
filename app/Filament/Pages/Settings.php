<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\Settings as SettingsModel;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Schema $form
 */
final class Settings extends Page
{
    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    protected string $view = 'filament.pages.settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?int $navigationSort = 99;

    public static function getNavigationLabel(): string
    {
        return __('Settings');
    }

    public function getTitle(): string
    {
        return __('Workflow Settings');
    }

    public function mount(): void
    {
        $this->form->fill($this->getRecord()?->attributesToArray() ?? [
            'notifications_enabled' => true,
            'execution_timeout' => 300,
            'auto_activate_workflows' => false,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Section::make(__('Default Workflow Settings'))
                        ->description(__('Configure default settings for new workflows'))
                        ->schema([
                            Select::make('default_schedule_cron')
                                ->label(__('Default Schedule'))
                                ->options([
                                    '* * * * *' => __('Every minute'),
                                    '*/5 * * * *' => __('Every 5 minutes'),
                                    '*/15 * * * *' => __('Every 15 minutes'),
                                    '*/30 * * * *' => __('Every 30 minutes'),
                                    '0 * * * *' => __('Every hour'),
                                    '0 */4 * * *' => __('Every 4 hours'),
                                    '0 0 * * *' => __('Daily'),
                                ])
                                ->placeholder(__('Select default schedule'))
                                ->helperText(__('This schedule will be pre-selected for new workflows')),
                            Toggle::make('auto_activate_workflows')
                                ->label(__('Auto-activate new workflows'))
                                ->helperText(__('Automatically activate workflows when created')),
                            TextInput::make('execution_timeout')
                                ->label(__('Execution Timeout'))
                                ->suffix(__('seconds'))
                                ->numeric()
                                ->default(300)
                                ->minValue(30)
                                ->maxValue(3600)
                                ->helperText(__('Maximum execution time for workflow runs')),
                        ])
                        ->columns(2),

                    Section::make(__('Notifications'))
                        ->description(__('Configure notification preferences'))
                        ->schema([
                            Toggle::make('notifications_enabled')
                                ->label(__('Enable notifications'))
                                ->helperText(__('Receive notifications about workflow runs and errors'))
                                ->live(),
                            TextInput::make('notification_email')
                                ->label(__('Notification Email'))
                                ->email()
                                ->placeholder('example@company.com')
                                ->helperText(__('Email address for workflow notifications'))
                                ->visible(fn ($get): bool => (bool) $get('notifications_enabled')),
                        ])
                        ->columns(2),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label(__('Save Settings'))
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $record = $this->getRecord();

        if (! $record instanceof SettingsModel) {
            $record = new SettingsModel;
            $record->team_id = Filament::getTenant()?->id;
        }

        $record->fill($data);
        $record->save();

        if ($record->wasRecentlyCreated) {
            $this->form->record($record)->saveRelationships();
        }

        Notification::make()
            ->success()
            ->title(__('Settings saved'))
            ->send();
    }

    public function getRecord(): ?SettingsModel
    {
        return Filament::getTenant()?->settings;
    }
}
