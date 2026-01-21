# Layout Components

## App Layout (app.blade.php)

The main layout wrapper that includes all necessary scripts, styles, and meta tags.

### Critical Requirements

1. **Must include `@filamentStyles`** - Provides CSS color variables
2. **Must include `@filamentScripts`** - Provides Alpine.js and Livewire integration
3. **Load fonts before other styles**

### Template

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Module Name | Cégem360' }}</title>
        <meta name="description" content="{{ $description ?? 'Default module description in Hungarian.' }}">

        <!-- Fonts (load first) -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|poppins:400,500,600,700" rel="stylesheet" />

        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])

        <!-- CRITICAL: Filament styles provide CSS color variables -->
        @filamentStyles
        @livewireStyles

        <style>
            [x-cloak] { display: none !important; }
            .font-heading { font-family: 'Poppins', sans-serif; }
        </style>
    </head>

    <body class="antialiased bg-white">
        <div class="min-h-screen">
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
        <!-- CRITICAL: Filament scripts include Alpine.js -->
        @filamentScripts
    </body>

</html>
```

### Why @filamentStyles is Required

Filament injects CSS variables like `--gray-100`, `--gray-200`, etc. that Tailwind's gray classes depend on. Without this directive, borders will appear dark instead of light gray.

---

## Navbar Component (navbar.blade.php)

Fixed-position navigation with logo, links, language switcher, and auth state.

### Structure

```blade
<nav class="bg-white border-b border-gray-100 fixed w-full top-0 z-50" x-data="{ mobileMenuOpen: false, openDropdown: null }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- Left: Logo --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}"
                         alt="{{ config('app.name') }}" class="h-10">
                    <span class="text-sm font-semibold text-[MODULE_COLOR]-600">
                        Module Name
                    </span>
                </a>
            </div>

            {{-- Center: Navigation Links (desktop) --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="#funkciok" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                    Funkciók
                </a>
                <a href="#integraciok" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                    Integrációk
                </a>
                <a href="#arak" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                    Árak
                </a>
                <a href="#gyik" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                    GYIK
                </a>
            </div>

            {{-- Right: Language Switcher + Auth --}}
            <div class="hidden lg:flex items-center gap-4">
                <x-language-switcher />

                @guest
                    <a href="/admin" class="text-sm font-medium text-gray-700 hover:text-gray-900">
                        Bejelentkezés
                    </a>
                    <a href="/admin" class="px-5 py-2 text-sm font-medium text-white bg-[MODULE_COLOR]-600 rounded-full hover:bg-[MODULE_COLOR]-700">
                        Ingyenes próba
                        <svg><!-- arrow icon --></svg>
                    </a>
                @endguest

                @auth
                    <a href="/admin" class="text-sm font-medium text-gray-700">Dashboard</a>
                    {{-- User dropdown menu --}}
                @endauth
            </div>

            {{-- Mobile menu button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-400">
                <!-- hamburger/close icon -->
            </button>
        </div>
    </div>

    {{-- Mobile menu (collapsible) --}}
    <div x-show="mobileMenuOpen" x-collapse class="lg:hidden border-t border-gray-200 bg-white">
        <!-- mobile navigation links -->
    </div>
</nav>
```

### Key Points

- Use `border-gray-100` for subtle borders
- Module color only on logo text and CTA buttons
- Language switcher in both desktop and mobile views
- User dropdown with Alpine.js `@mouseenter`/`@mouseleave`

---

## Footer Component (footer.blade.php)

5-column layout with collapsible sections on mobile.

### Structure

```blade
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            {{-- Column 1: Logo + Description --}}
            <div class="col-span-2 md:col-span-3 lg:col-span-1">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" class="h-8 mb-4">
                <p class="text-gray-400 text-sm">
                    A Cégem360 átfogó üzleti megoldást kínál...
                </p>
            </div>

            {{-- Column 2-5: Link sections with mobile collapse --}}
            <div x-data="{ open: false }">
                <button @click="open = !open" class="lg:hidden w-full flex justify-between items-center">
                    <span class="font-semibold text-white">Section Title</span>
                    <svg :class="{ 'rotate-180': open }"><!-- chevron --></svg>
                </button>
                <h4 class="hidden lg:block font-semibold text-white mb-4">Section Title</h4>
                <ul x-show="open || window.innerWidth >= 1024" x-collapse class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Link</a></li>
                </ul>
            </div>

        </div>

        {{-- Bottom bar: Copyright + Legal links --}}
        <div class="border-t border-gray-800 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">© 2024-2025 Cégem360</p>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-400 hover:text-white text-sm">ÁSZF</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Adatvédelem</a>
                </div>
            </div>
        </div>
    </div>
</footer>
```

---

## Language Switcher Component (language-switcher.blade.php)

Dropdown for HU/EN language switching.

```blade
<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="flex items-center gap-1.5 px-2 py-1.5 text-sm text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
        </svg>
        <span class="uppercase">{{ app()->getLocale() }}</span>
        <svg class="w-3 h-3" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open" @click.away="open = false" x-transition
         class="absolute right-0 mt-1 w-24 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
        <a href="{{ route('language.switch', 'hu') }}"
           class="block px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors {{ app()->getLocale() === 'hu' ? 'bg-gray-100 font-medium' : '' }}">
            Magyar
        </a>
        <a href="{{ route('language.switch', 'en') }}"
           class="block px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors {{ app()->getLocale() === 'en' ? 'bg-gray-100 font-medium' : '' }}">
            English
        </a>
    </div>
</div>
```
