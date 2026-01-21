<?php

declare(strict_types=1);

use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Dashboard\Settings as DashboardSettings;
use App\Livewire\Dashboard\Webhooks as DashboardWebhooks;
use App\Livewire\Dashboard\Workflows as DashboardWorkflows;
use App\Livewire\Dashboard\WorkflowsCreate as DashboardWorkflowsCreate;
use App\Models\Workflow;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): View|Factory|RedirectResponse {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('home');
})->name('home');

Route::get('/workflow-editor', function () {
    return view('admin');
})->name('workflow.editor');

Route::get('/workflows', function () {
    return view('workflows');
})->name('workflows');

Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'hu'], true)) {
        abort(400);
    }
    $cookie = cookie('locale', $locale, 60 * 24 * 365);
    $referer = request()->headers->get('referer');
    $redirectUrl = $referer ?: url()->previous();

    return redirect($redirectUrl)->withCookie($cookie);
})->name('language.switch');

// User Dashboard
Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    // Workflows
    Route::get('/dashboard/workflows', DashboardWorkflows::class)->name('dashboard.workflows');
    Route::get('/dashboard/workflows/create', DashboardWorkflowsCreate::class)->name('dashboard.workflows.create');
    Route::get('/dashboard/workflows/{workflow}/editor', function (Workflow $workflow) {
        // Verify the workflow belongs to the user's team
        $team = Auth::user()->teams->first();
        if (! $team || $workflow->team_id !== $team->id) {
            abort(403);
        }

        return view('dashboard.workflow-editor', ['workflow' => $workflow]);
    })->name('dashboard.workflows.editor');

    // History - placeholder views for now
    Route::get('/dashboard/executions', function () {
        return view('dashboard.executions');
    })->name('dashboard.executions');

    Route::get('/dashboard/logs', function () {
        return view('dashboard.logs');
    })->name('dashboard.logs');

    // Integrations - placeholder view for now
    Route::get('/dashboard/integrations', function () {
        return view('dashboard.integrations');
    })->name('dashboard.integrations');

    // Webhooks
    Route::get('/dashboard/webhooks', DashboardWebhooks::class)->name('dashboard.webhooks');

    // Settings
    Route::get('/dashboard/settings', DashboardSettings::class)->name('dashboard.settings');
});
