# User Dashboard Implementation

The user dashboard is separate from the Filament admin panel and provides a customer-facing interface at `/dashboard`.

## Overview

- **Route prefix:** `/dashboard`
- **Auth middleware:** `auth`, `verified`
- **Technology:** Livewire 3 components with Filament Schemas
- **Layout:** Custom dashboard layout (not Filament)

## Directory Structure

```
app/Livewire/Dashboard/
├── Index.php                 # Main dashboard with statistics
├── Workflows.php             # Workflow listing
├── WorkflowsCreate.php       # Workflow creation form
├── Settings.php              # Team settings
└── Webhooks.php              # Webhook management

resources/views/
├── components/layouts/
│   ├── dashboard.blade.php           # Main dashboard layout
│   ├── dashboard-sidebar.blade.php   # 240px fixed sidebar
│   └── dashboard-header.blade.php    # Header with search & toggles
├── dashboard/
│   └── workflow-editor.blade.php     # React editor embedding
└── livewire/dashboard/
    ├── index.blade.php
    ├── workflows.blade.php
    ├── workflows-create.blade.php
    ├── settings.blade.php
    └── webhooks.blade.php
```

---

## Livewire Component Pattern

### Basic Component (Read-Only)

Use the `#[Layout]` attribute instead of `->layout()` in render():

```php
<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
final class Index extends Component
{
    public function render(): View
    {
        $team = auth()->user()->teams->first();

        return view('livewire.dashboard.index', [
            'workflows' => $team?->workflows ?? collect(),
        ]);
    }
}
```

### Form Component with Filament Schemas

For forms, use `HasSchemas` interface with `InteractsWithSchemas` trait:

```php
<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Decorations\FormActionsDecorations;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
final class WorkflowsCreate extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                TextInput::make('name')
                    ->label(__('Workflow name'))
                    ->required()
                    ->maxLength(255),

                Toggle::make('is_active')
                    ->label(__('Active'))
                    ->default(true),
            ]);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        // Create workflow logic...

        $this->redirectRoute('dashboard.workflows');
    }

    public function render(): View
    {
        return view('livewire.dashboard.workflows-create');
    }
}
```

### Blade View for Filament Schema Form

```blade
<div class="max-w-2xl mx-auto">
    <form wire:submit="create" class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-end gap-3">
            <a href="{{ route('dashboard.workflows') }}" class="...">
                {{ __('Cancel') }}
            </a>
            <button type="submit" class="...">
                {{ __('Create Workflow') }}
            </button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
```

---

## Dashboard Layout

### Main Layout (dashboard.blade.php)

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- meta tags, vite, filament styles -->
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50" x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <x-layouts.dashboard-sidebar />

        {{-- Main content area --}}
        <div class="flex-1 flex flex-col min-w-0" :class="{ 'lg:ml-60': sidebarOpen }">
            {{-- Header --}}
            <x-layouts.dashboard-header />

            {{-- Page content --}}
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Mobile overlay --}}
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden"
        @click="mobileMenuOpen = false"
    ></div>

    @livewire('notifications')
    @filamentScripts
</body>
</html>
```

### Sidebar State Management

The sidebar uses Alpine.js state at the body level for cross-component sharing:

```blade
<body x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
```

**Sidebar visibility:**
```blade
<aside
    class="fixed inset-y-0 left-0 z-50 w-60 bg-[#292F4C] text-white flex flex-col"
    x-show="sidebarOpen || mobileMenuOpen"
    x-cloak
>
```

**Main content offset:**
```blade
<div class="flex-1" :class="{ 'lg:ml-60': sidebarOpen }">
```

**Toggle button:**
```blade
<button @click="sidebarOpen = !sidebarOpen" class="hidden lg:block">
    <!-- hamburger icon -->
</button>
```

---

## Embedding React in Dashboard

For pages with React components (like the workflow editor):

```blade
{{-- workflow-editor.blade.php --}}
<body class="antialiased bg-gray-50" x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
    <div class="min-h-screen flex">
        <x-layouts.dashboard-sidebar />

        <div class="flex-1 flex flex-col min-w-0" :class="{ 'lg:ml-60': sidebarOpen }">
            <x-layouts.dashboard-header />

            {{-- Context bar specific to this page --}}
            <div class="h-12 bg-white border-b ...">
                <!-- workflow info, back button, badges -->
            </div>

            {{-- React app mount point --}}
            <main class="flex-1 overflow-hidden pt-8">
                <div id="admin-app" class="h-full" data-workflow-id="{{ $workflow->id }}"></div>
            </main>
        </div>
    </div>

    @livewire('notifications')
    @filamentScripts
</body>
```

React component detects dashboard mode:
```javascript
const workflowId = adminElement?.dataset.workflowId;
const isDashboardMode = !!workflowId;
```

---

## Routes Configuration

```php
// routes/web.php

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    // Workflows
    Route::get('/dashboard/workflows', DashboardWorkflows::class)->name('dashboard.workflows');
    Route::get('/dashboard/workflows/create', DashboardWorkflowsCreate::class)->name('dashboard.workflows.create');
    Route::get('/dashboard/workflows/{workflow}/editor', function (Workflow $workflow) {
        // Authorization check
        $team = Auth::user()->teams->first();
        if (!$team || $workflow->team_id !== $team->id) {
            abort(403);
        }
        return view('dashboard.workflow-editor', ['workflow' => $workflow]);
    })->name('dashboard.workflows.editor');

    // Settings
    Route::get('/dashboard/settings', DashboardSettings::class)->name('dashboard.settings');

    // Webhooks
    Route::get('/dashboard/webhooks', DashboardWebhooks::class)->name('dashboard.webhooks');
});
```

---

## Team-Based Authorization

All dashboard operations must verify team ownership:

```php
$team = Auth::user()->teams->first();

// For queries
$workflows = $team?->workflows()->latest()->get() ?? collect();

// For single resource access
if (!$team || $workflow->team_id !== $team->id) {
    abort(403);
}
```

---

## Notifications

Include Livewire notifications component in layout:

```blade
@livewire('notifications')
```

Send notifications from components:

```php
use Filament\Notifications\Notification;

Notification::make()
    ->title(__('Workflow created successfully'))
    ->success()
    ->send();
```
