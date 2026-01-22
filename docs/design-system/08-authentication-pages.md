# Authentication Pages

Custom login and registration pages with branded layouts that redirect to the user dashboard instead of the Filament admin panel.

## Overview

Each module has custom auth pages that:
- Use branded layouts (centered for login, split-view for registration)
- Include language switcher
- Redirect to `/dashboard` after authentication
- Auto-fill demo credentials in local environment

## Directory Structure

```
app/
├── Filament/
│   └── Pages/
│       └── Auth/
│           ├── Login.php           # Custom login page
│           └── Register.php        # Custom registration page
├── Http/
│   └── Responses/
│       ├── LoginResponse.php       # Redirect to /dashboard after login
│       └── RegistrationResponse.php # Redirect to /dashboard after registration
└── Providers/
    └── AppServiceProvider.php      # Bind custom responses

resources/views/filament/
├── layouts/
│   ├── auth.blade.php              # Centered layout for login
│   └── auth-split.blade.php        # Split layout for registration
└── pages/auth/
    ├── login.blade.php             # Login form UI
    └── register.blade.php          # Registration form UI
```

---

## Step 1: Create Custom Response Classes

These override Filament's default post-auth redirect (from `/admin` to `/dashboard`).

### LoginResponse.php

```php
<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\LoginResponse as BaseLoginResponse;
use Illuminate\Http\RedirectResponse;

final class LoginResponse extends BaseLoginResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->route('dashboard');
    }
}
```

### RegistrationResponse.php

```php
<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\RegistrationResponse as BaseRegistrationResponse;
use Illuminate\Http\RedirectResponse;

final class RegistrationResponse extends BaseRegistrationResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->route('dashboard');
    }
}
```

---

## Step 2: Bind Responses in AppServiceProvider

```php
<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Responses\LoginResponse;
use App\Http\Responses\RegistrationResponse;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse as RegistrationResponseContract;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        $this->app->singleton(RegistrationResponseContract::class, RegistrationResponse::class);
    }

    public function boot(): void
    {
        //
    }
}
```

---

## Step 3: Create Login Page Class

`app/Filament/Pages/Auth/Login.php`:

```php
<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BasePage;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;

final class Login extends BasePage
{
    public string $view = 'filament.pages.auth.login';

    protected static string $layout = 'filament.layouts.auth';

    public function mount(): void
    {
        parent::mount();

        if (app()->environment('local')) {
            $this->form->fill([
                'email' => 'admin@admin.com',
                'password' => 'password',
                'remember' => true,
            ]);
        }
    }

    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('email')
            ->label(__('Enter your work email'))
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->placeholder('example@company.com')
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): TextInput
    {
        return TextInput::make('password')
            ->label(__('Password'))
            ->password()
            ->revealable()
            ->autocomplete('current-password')
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    protected function getRememberFormComponent(): Checkbox
    {
        return Checkbox::make('remember')
            ->label(__('Remember me'))
            ->extraInputAttributes(['tabindex' => 3]);
    }
}
```

---

## Step 4: Create Register Page Class

`app/Filament/Pages/Auth/Register.php`:

```php
<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

final class Register extends BaseRegister
{
    public string $view = 'filament.pages.auth.register';

    protected static string $layout = 'filament.layouts.auth-split';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCompanyFieldset(),
            ])
            ->columns(2);
    }

    protected function getNameFormComponent(): TextInput
    {
        return TextInput::make('name')
            ->label(__('Full name'))
            ->required()
            ->maxLength(255)
            ->autofocus()
            ->columnSpanFull();
    }

    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('email')
            ->label(__('Work email'))
            ->email()
            ->required()
            ->maxLength(255)
            ->unique($this->getUserModel())
            ->columnSpanFull();
    }

    protected function getPasswordFormComponent(): TextInput
    {
        return TextInput::make('password')
            ->label(__('Password'))
            ->password()
            ->revealable()
            ->required()
            ->minLength(8)
            ->same('passwordConfirmation')
            ->validationAttribute(__('password'));
    }

    protected function getPasswordConfirmationFormComponent(): TextInput
    {
        return TextInput::make('passwordConfirmation')
            ->label(__('Confirm password'))
            ->password()
            ->revealable()
            ->required()
            ->dehydrated(false);
    }

    private function getCompanyFieldset(): Fieldset
    {
        return Fieldset::make(__('Company information'))
            ->schema([
                TextInput::make('company_name')
                    ->label(__('Company name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('position')
                    ->label(__('Your position'))
                    ->maxLength(255),
            ])
            ->columns(2)
            ->columnSpanFull();
    }
}
```

---

## Step 5: Register Auth Pages in AdminPanelProvider

Update `app/Providers/Filament/AdminPanelProvider.php`:

```php
use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Auth\Register;

// In the panel() method:
return $panel
    ->default()
    ->id('admin')
    ->path('admin')
    ->login(Login::class)
    ->registration(Register::class)
    // ... rest of configuration
```

---

## Step 6: Create Auth Layout (Centered)

`resources/views/filament/layouts/auth.blade.php`:

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-50 font-sans antialiased">
    <!-- Header with logo -->
    <header class="bg-white border-b border-gray-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ route('home') }}">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="{{ config('app.name') }}" class="h-10">
                </a>
                <x-language-switcher />
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="flex min-h-[calc(100vh-65px)] items-center justify-center p-4">
        {{ $slot }}
    </main>

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
```

---

## Step 7: Create Auth Split Layout (For Registration)

`resources/views/filament/layouts/auth-split.blade.php`:

This layout has a form on the left and a visual mockup on the right. Replace `[MODULE_COLOR]` with your module's color (violet, indigo, emerald, blue) and customize the mockup content.

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Left side - Form -->
        <div class="flex w-full flex-col bg-white lg:w-1/2">
            <!-- Logo header -->
            <div class="flex items-center justify-between px-6 py-6 lg:px-12">
                <a href="{{ route('home') }}">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="{{ config('app.name') }}" class="h-10">
                </a>
                <x-language-switcher />
            </div>
            <!-- Main content area - centered -->
            <div class="flex flex-1 flex-col items-center justify-center px-6 pb-6 lg:px-12">
                <div class="w-full max-w-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Right side - Illustration with floating elements -->
        <div class="hidden bg-[MODULE_COLOR]-600 lg:flex lg:w-1/2 lg:items-center lg:justify-center relative overflow-hidden">
            <!-- Concentric circles -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[800px] h-[800px] border-2 border-white/20 rounded-full"></div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[600px] h-[600px] border-2 border-white/25 rounded-full"></div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[400px] h-[400px] border-2 border-white/20 rounded-full"></div>
            </div>

            <div class="relative w-full max-w-2xl px-12">
                <!-- Dashboard mockup card - customize for each module -->
                <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 p-4 relative z-10">
                    <!-- Module-specific content here -->
                </div>

                <!-- Floating notifications - customize for each module -->
                <div class="absolute -left-8 top-1/4 bg-white rounded-lg shadow-lg p-3 border border-gray-100 animate-pulse z-20">
                    <!-- Notification content -->
                </div>
            </div>

            <!-- Decorative elements -->
            <div class="absolute top-16 right-16 w-24 h-24 border-2 border-white/30 rounded-full"></div>
            <div class="absolute bottom-24 left-12 w-16 h-16 bg-[MODULE_COLOR]-400/40 rounded-full"></div>
        </div>
    </div>

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
```

---

## Step 8: Create Login View

`resources/views/filament/pages/auth/login.blade.php`:

Replace `[MODULE_COLOR]` with your module's color hex code.

```blade
<div class="w-full max-w-md">
    <div class="text-center mb-10">
        <h1 class="text-2xl font-semibold text-gray-900">
            {{ __('Sign in to your account') }}
        </h1>
    </div>

    <form wire:submit="authenticate" class="space-y-6">
        {{ $this->form }}

        <div class="pt-2">
            <x-filament::button type="submit" color="primary" class="w-full! justify-center text-base">
                {{ __('Sign in') }}
                <x-slot name="iconAfter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </x-slot>
            </x-filament::button>
        </div>
    </form>

    <div class="mt-10 text-center space-y-3">
        <p class="text-sm text-gray-500">
            {{ __("Don't have an account?") }}
            <a href="{{ route('filament.admin.auth.register') }}" class="font-medium" style="color: [MODULE_COLOR] !important;">
                {{ __('Register') }}
            </a>
        </p>
        <p class="text-sm text-gray-400">
            <a href="#" class="hover:text-gray-600" style="color: #9ca3af !important;">
                {{ __("Can't sign in? Visit the help center") }}
            </a>
        </p>
    </div>
</div>
```

---

## Step 9: Create Register View

`resources/views/filament/pages/auth/register.blade.php`:

```blade
<div class="w-full">
    <div class="mb-5">
        <h1 class="text-2xl font-semibold text-gray-900">
            {{ __('Welcome to [Module Name]') }}
        </h1>
        <p class="mt-2 text-base text-gray-500">
            {{ __('Start for free - no credit card required.') }}
        </p>
    </div>

    <form wire:submit="register" class="space-y-4">
        {{ $this->form }}

        <div class="pt-1">
            <x-filament::button type="submit" color="primary" class="w-full! justify-center">
                {{ __('Continue') }}
            </x-filament::button>
        </div>

        <p class="text-center text-xs text-gray-500">
            {{ __('By continuing, you agree to our') }}
            <a href="#" class="underline" style="color: [MODULE_COLOR] !important;">{{ __('Terms of Service') }}</a>
            {{ __('and') }}
            <a href="#" class="underline" style="color: [MODULE_COLOR] !important;">{{ __('Privacy Policy') }}</a>.
        </p>

        <p class="text-center text-sm text-gray-500 pt-2">
            {{ __('Already have an account?') }}
            <a href="{{ route('filament.admin.auth.login') }}" class="font-medium" style="color: [MODULE_COLOR] !important;">
                {{ __('Sign in') }}
            </a>
        </p>
    </form>
</div>
```

---

## Step 10: Add Guest Routes

In `routes/web.php`, add redirects from `/login` and `/register` to Filament auth pages:

```php
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

// Guest routes - redirect to Filament auth pages
Route::middleware(['guest'])->group(function (): void {
    Route::get('/login', fn (): Redirector|RedirectResponse => to_route('filament.admin.auth.login'))->name('login');
    Route::get('/register', fn (): Redirector|RedirectResponse => to_route('filament.admin.auth.register'))->name('register');
});
```

---

## Module Color Reference

| Module | Color Name | Hex Code | Tailwind Class |
|--------|-----------|----------|----------------|
| Subscriber | Indigo | #4f46e5 | `indigo-*` |
| Controlling | Emerald | #10B981 | `emerald-*` |
| CRM | Blue | #3B82F6 | `blue-*` |
| Workflow | Violet | #7c3aed | `violet-*` |

---

## Verification Checklist

- [ ] Login page renders with custom layout
- [ ] Registration page renders with split layout
- [ ] Language switcher works on auth pages
- [ ] Demo credentials auto-fill in local environment
- [ ] After login, user redirects to `/dashboard`
- [ ] After registration, user redirects to `/dashboard`
- [ ] Links between login/register work correctly
- [ ] Module colors are consistent throughout
