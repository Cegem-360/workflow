# Common Issues & Troubleshooting

## Issue 1: Dark Borders Instead of Light Gray

### Symptom
Cards and UI elements have dark/black borders instead of light gray borders, even when using `border-gray-100` or `border-gray-200`.

### Cause
Filament's CSS sets `--color-gray-100: var(--gray-100)` but `--gray-100` is only defined when `@filamentStyles` is present in the HTML. Without it, the variable is undefined and falls back to a dark color.

### Solution
Add `@filamentStyles` to your `app.blade.php` layout:

```blade
<head>
    <!-- ... other head content ... -->

    @vite(['resources/css/app.css', 'resources/js/app.jsx'])

    @filamentStyles   {{-- ADD THIS LINE --}}
    @livewireStyles
</head>
```

And add `@filamentScripts` before closing body:

```blade
    @livewireScripts
    @filamentScripts   {{-- ADD THIS LINE --}}
</body>
```

### Verification
Check the page source for a `<style>` block containing:
```css
:root {
    --gray-50:oklch(...);
    --gray-100:oklch(0.967 0.001 286.375);
    /* ... more gray values ... */
}
```

---

## Issue 2: Fonts Not Loading

### Symptom
Text appears in default system font instead of Figtree/Poppins.

### Solution
Ensure fonts are loaded in `<head>` BEFORE other styles:

```blade
<!-- Fonts (load first) -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|poppins:400,500,600,700" rel="stylesheet" />

<!-- Then other styles -->
@vite(['resources/css/app.css'])
```

Also add the `.font-heading` class definition:

```blade
<style>
    .font-heading {
        font-family: 'Poppins', sans-serif;
    }
</style>
```

---

## Issue 3: Alpine.js Not Working

### Symptom
Dropdowns, mobile menus, and accordions don't open/close.

### Cause
Alpine.js is not loaded, or multiple versions conflict.

### Solution
`@filamentScripts` includes Alpine.js. Remove any CDN includes:

```blade
{{-- REMOVE these if using @filamentScripts --}}
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

{{-- Use this instead --}}
@filamentScripts
```

---

## Issue 4: Vite Manifest Error

### Symptom
```
Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest
```

### Solution
Run the build command:

```bash
npm run build
```

Or for development with hot reload:

```bash
npm run dev
```

---

## Issue 5: Language Switcher Not Working

### Symptom
Clicking HU/EN doesn't change the language.

### Checklist

1. **Route exists** in `routes/web.php`:
```php
Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'hu'], true)) {
        abort(400);
    }
    $cookie = cookie('locale', $locale, 60 * 24 * 365);
    return redirect()->back()->withCookie($cookie);
})->name('language.switch');
```

2. **Middleware exists** at `app/Http/Middleware/SetLocale.php`

3. **Middleware registered** in `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        SetLocale::class,
    ]);
})
```

4. **Route name used correctly** in component:
```blade
<a href="{{ route('language.switch', 'hu') }}">Magyar</a>
```

---

## Issue 6: Logo Not Displaying

### Symptom
Logo image shows broken/missing.

### Checklist

1. **File exists** at `resources/images/logo.png`

2. **Using Vite asset helper**:
```blade
<img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">
```

3. **Build has run** after adding the image:
```bash
npm run build
```

---

## Issue 7: Mobile Menu Not Collapsing Smoothly

### Symptom
Mobile menu appears/disappears abruptly without animation.

### Cause
Alpine Collapse plugin not loaded.

### Solution
`@filamentScripts` includes the collapse plugin. Ensure it's present:

```blade
@filamentScripts
```

And use the correct directive:

```blade
<div x-show="mobileMenuOpen" x-collapse>
    <!-- menu content -->
</div>
```

---

## Issue 8: Styles Not Updating After CSS Changes

### Symptom
CSS changes in `app.css` don't appear on the page.

### Solution

1. **Run build**:
```bash
npm run build
```

2. **Clear browser cache** (Cmd+Shift+R or Ctrl+Shift+R)

3. **Check for syntax errors** in app.css - Tailwind v4 is strict about `@theme` syntax

---

## Issue 9: [x-cloak] Elements Flashing

### Symptom
Elements with `x-cloak` briefly appear before Alpine initializes.

### Solution
Add this to your `<style>` block in the `<head>`:

```blade
<style>
    [x-cloak] { display: none !important; }
</style>
```

---

## Issue 10: Pricing/Feature Cards Not Aligned

### Symptom
Cards in a grid have different heights or misaligned content.

### Solution
Use consistent structure and Tailwind's grid:

```blade
<div class="grid md:grid-cols-3 gap-8">
    <div class="bg-white rounded-2xl p-8 flex flex-col">
        <div class="flex-1">
            <!-- Main content -->
        </div>
        <div class="mt-auto">
            <!-- CTA button at bottom -->
        </div>
    </div>
</div>
```

---

## Debugging Tips

### Check Computed Styles
Use browser DevTools to inspect an element and check "Computed" styles to see what CSS value is actually being applied.

### Check CSS Variables
In DevTools console:
```javascript
getComputedStyle(document.documentElement).getPropertyValue('--gray-100')
```

Should return something like `oklch(0.967 0.001 286.375)` not empty or a dark color.

### View Page Source
Check that the `<style>` block with `:root { --gray-100: ... }` is present in the HTML source.
