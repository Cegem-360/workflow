# CSS Configuration

## Overview

The Cégem360 design system uses:
- **Tailwind CSS v4** with CSS-first configuration (`@theme` directive)
- **Filament CSS** for admin panel components and color variables
- **Vibe Design System** (Monday.com style) for visual language

## app.css Structure

```css
/* 1. Import Tailwind */
@import "tailwindcss";

/* 2. Import Filament CSS (REQUIRED for color variables) */
@import "../../vendor/filament/support/resources/css/index.css";
@import "../../vendor/filament/actions/resources/css/index.css";
@import "../../vendor/filament/forms/resources/css/index.css";
@import "../../vendor/filament/infolists/resources/css/index.css";
@import "../../vendor/filament/notifications/resources/css/index.css";
@import "../../vendor/filament/schemas/resources/css/index.css";
@import "../../vendor/filament/tables/resources/css/index.css";
@import "../../vendor/filament/widgets/resources/css/index.css";

/* 3. Tailwind v4 configuration */
@variant dark (&:where(.dark, .dark *));
@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../storage/framework/views/*.php';
@source '../**/*.blade.php';
@source '../**/*.js';

/* 4. Theme configuration */
@theme {
    /* ... see below ... */
}

/* 5. Base styles */
@layer base {
    /* ... */
}

/* 6. Component utilities */
@layer components {
    /* ... */
}

/* 7. Custom animations */
@keyframes ... {
    /* ... */
}
```

## @theme Configuration

### Fonts

```css
@theme {
    --font-sans:
        "Figtree", "Roboto", "Noto Sans Hebrew", "Noto Kufi Arabic", "Noto Sans JP",
        ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
        "Segoe UI Symbol", "Noto Color Emoji";
    --font-heading:
        "Poppins", "Roboto", "Noto Sans Hebrew", "Noto Kufi Arabic", "Noto Sans JP",
        ui-sans-serif, system-ui, sans-serif;
}
```

### Primary Colors (Module-Specific)

**Change these values based on the module:**

```css
@theme {
    /* VIOLET (Automatizálás/Workflow module) */
    --color-primary-50: #f5f3ff;
    --color-primary-100: #ede9fe;
    --color-primary-200: #ddd6fe;
    --color-primary-300: #c4b5fd;
    --color-primary-400: #a78bfa;
    --color-primary-500: #8b5cf6;
    --color-primary-600: #7c3aed;
    --color-primary-700: #6d28d9;
    --color-primary-800: #5b21b6;
    --color-primary-900: #4c1d95;
    --color-primary-950: #2e1065;
}
```

**Other module colors:**

```css
/* EMERALD (Controlling module) */
--color-primary-500: #10b981;
--color-primary-600: #059669;

/* BLUE (CRM module) */
--color-primary-500: #3b82f6;
--color-primary-600: #2563eb;

/* INDIGO (Subscriber/Main module) */
--color-primary-500: #6161ff;
--color-primary-600: #605cd4;
```

### Semantic Colors

```css
@theme {
    /* Success */
    --color-success-500: #00ca72;
    --color-success-600: #00a85e;

    /* Warning */
    --color-warning-500: #ffcc00;
    --color-warning-600: #d9ad00;

    /* Danger */
    --color-danger-500: #fb275d;
    --color-danger-600: #d61e4e;
}
```

### Text Colors

```css
@theme {
    --color-text-primary: #323338;
    --color-text-secondary: #676879;
    --color-text-tertiary: #9699a6;
    --color-text-disabled: #c5c7d0;
    --color-text-inverse: #ffffff;
    --color-text-link: #7c3aed;        /* Match module primary-600 */
    --color-text-link-hover: #5b21b6;  /* Match module primary-800 */
}
```

### Border Colors

```css
@theme {
    --color-border-default: #c5c7d0;
    --color-border-light: #e6e9ef;
    --color-border-focus: #7c3aed;     /* Match module primary-600 */
    --color-border-error: #fb275d;
}
```

### Shadows

```css
@theme {
    --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
}
```

### Transitions

```css
@theme {
    --duration-fast: 70ms;
    --duration-normal: 100ms;
    --duration-slow: 150ms;
    --duration-expressive: 250ms;
    --duration-dramatic: 400ms;

    --ease-enter: cubic-bezier(0, 0, 0.35, 1);
    --ease-exit: cubic-bezier(0.4, 0, 1, 1);
    --ease-transition: cubic-bezier(0.4, 0, 0.2, 1);
    --ease-emphasize: cubic-bezier(0, 0, 0.2, 1.4);
}
```

## Custom Animations

### Floating Animation (Hero elements)

```css
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-6px);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float 6s ease-in-out infinite;
    animation-delay: 2s;
}

.animate-float-delayed-2 {
    animation: float 6s ease-in-out infinite;
    animation-delay: 4s;
}
```

### Pulse Glow (Active indicators)

```css
@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(139, 92, 246, 0);
    }
}

.animate-pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}
```

## Component Classes

### Buttons

```css
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    font-size: var(--text-sm);
    font-weight: var(--font-weight-medium);
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: all var(--duration-normal) var(--ease-transition);
    border: none;
}

.btn-primary {
    background-color: var(--color-primary-600);
    color: var(--color-text-inverse);
}

.btn-primary:hover:not(:disabled) {
    background-color: var(--color-primary-800);
}

.btn-secondary {
    background-color: var(--color-surface-secondary);
    color: var(--color-text-primary);
    border: 1px solid var(--color-border-default);
}
```

### Cards

```css
.card {
    background-color: var(--color-surface-primary);
    border: 1px solid var(--color-border-light);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
}
```

### Inputs

```css
.input {
    display: block;
    width: 100%;
    padding: 0.5rem 0.75rem;
    font-size: var(--text-sm);
    color: var(--color-text-primary);
    background-color: var(--color-surface-primary);
    border: 1px solid var(--color-border-default);
    border-radius: var(--radius-md);
}

.input:focus {
    outline: none;
    border-color: var(--color-border-focus);
    box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.25);
}
```

## Important Notes

1. **Always run `npm run build`** after CSS changes
2. **Both CSS imports AND blade directive are required:**
   - **CSS imports in app.css** → Compiles Filament component styles into your Vite bundle
   - **`@filamentStyles` in blade layouts** → Injects runtime CSS variables (grays, colors)
3. **Gray colors come from Filament**, not standard Tailwind - this is why `@filamentStyles` is critical
4. **Missing either one causes issues:**
   - Missing CSS imports → Filament components unstyled
   - Missing `@filamentStyles` → Dark borders, broken grays

## Common CSS Import Issues

If borders appear dark instead of light gray, or Filament components look broken:

1. Verify `app.css` has all Filament imports:
```css
@import "tailwindcss";
@import "../../vendor/filament/support/resources/css/index.css";
@import "../../vendor/filament/actions/resources/css/index.css";
@import "../../vendor/filament/forms/resources/css/index.css";
@import "../../vendor/filament/infolists/resources/css/index.css";
@import "../../vendor/filament/notifications/resources/css/index.css";
@import "../../vendor/filament/schemas/resources/css/index.css";
@import "../../vendor/filament/tables/resources/css/index.css";
@import "../../vendor/filament/widgets/resources/css/index.css";
```

2. Verify blade layout has `@filamentStyles` in `<head>` and `@filamentScripts` before `</body>`

3. Run `npm run build` to recompile assets
