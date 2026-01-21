<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Settings as SettingsModel;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class Settings extends Component
{
    public ?string $defaultScheduleCron = null;

    public bool $notificationsEnabled = true;

    public ?string $notificationEmail = null;

    public bool $autoActivateWorkflows = false;

    public int $executionTimeout = 300;

    public function mount(): void
    {
        $settings = $this->getSettings();

        if ($settings) {
            $this->defaultScheduleCron = $settings->default_schedule_cron;
            $this->notificationsEnabled = $settings->notifications_enabled;
            $this->notificationEmail = $settings->notification_email;
            $this->autoActivateWorkflows = $settings->auto_activate_workflows;
            $this->executionTimeout = $settings->execution_timeout ?? 300;
        }
    }

    public function save(): void
    {
        $this->validate([
            'notificationEmail' => ['nullable', 'email'],
            'executionTimeout' => ['required', 'integer', 'min:30', 'max:3600'],
        ]);

        $team = Auth::user()->teams->first();

        if (! $team) {
            return;
        }

        $settings = $this->getSettings();

        if (! $settings) {
            $settings = new SettingsModel;
            $settings->team_id = $team->id;
        }

        $settings->fill([
            'default_schedule_cron' => $this->defaultScheduleCron,
            'notifications_enabled' => $this->notificationsEnabled,
            'notification_email' => $this->notificationEmail,
            'auto_activate_workflows' => $this->autoActivateWorkflows,
            'execution_timeout' => $this->executionTimeout,
        ]);

        $settings->save();

        Notification::make()
            ->success()
            ->title(__('Settings saved'))
            ->send();
    }

    public function render(): View
    {
        return view('livewire.dashboard.settings')
            ->layout('components.layouts.dashboard', ['title' => __('Settings')]);
    }

    private function getSettings(): ?SettingsModel
    {
        $team = Auth::user()->teams->first();

        return $team?->settings;
    }
}
