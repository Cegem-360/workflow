# Color System

## Module Color Assignments

Each Cégem360 module has a designated primary color. Use the correct color consistently throughout the module's landing page and UI.

### Module Colors

| Module | Hungarian Name | Primary Color | Hex | Tailwind Prefix |
|--------|---------------|---------------|-----|-----------------|
| Subscriber | Előfizető | Indigo | #6161FF | `indigo-` |
| Controlling | Kontrolling | Emerald | #10B981 | `emerald-` |
| CRM | CRM | Blue | #3B82F6 | `blue-` |
| Workflow | Automatizálás | Violet | #8B5CF6 | `violet-` |
| SEO Eszköz | SEO Eszköz | Violet | #7C3AED | `violet-` |
| Sales | Értékesítés | Red | #ef4444 | `red-` |
| Worksheet | Digitális Munkalap | Emerald | #10B981 | `emerald-` |
| MarketingHub | MarketingHub | Pink | #EC4899 | `pink-` |
| DataMind | DataMind | Violet | #8B5CF6 | `violet-` |

### Color Usage Guide

#### Primary Actions (Buttons, CTAs)
```html
<!-- Violet module example -->
<a class="bg-violet-600 hover:bg-violet-700 text-white">
    Primary CTA
</a>

<!-- Secondary button -->
<a class="text-violet-700 bg-white border-2 border-violet-200 hover:bg-violet-50">
    Secondary CTA
</a>
```

#### Badges and Labels
```html
<span class="bg-violet-100 text-violet-700 rounded-full px-4 py-1.5">
    Badge Text
</span>
```

#### Icon Backgrounds
```html
<div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center">
    <svg class="w-6 h-6 text-violet-600">...</svg>
</div>
```

#### Section Backgrounds
```html
<!-- Hero gradient -->
<section class="bg-gradient-to-b from-violet-50 to-white">

<!-- Accent section -->
<div class="bg-violet-50 rounded-2xl border border-violet-100">

<!-- CTA section -->
<section class="bg-gradient-to-r from-violet-600 to-purple-700">
```

#### Checkmarks and Success Indicators
```html
<svg class="w-4 h-4 text-violet-500">
    <!-- checkmark icon -->
</svg>
```

## Neutral Colors (Gray Scale)

**IMPORTANT:** Gray colors come from Filament's CSS variables. Always include `@filamentStyles` in your layout to get the correct light gray values.

### Gray Usage

| Purpose | Class | Result |
|---------|-------|--------|
| Card borders | `border-gray-100` | Very light border |
| Section borders | `border-gray-200` | Light border |
| Subtle text | `text-gray-500` | Muted text |
| Body text | `text-gray-600` | Secondary text |
| Headings | `text-gray-900` | Dark text |

### Card Styling Pattern
```html
<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
    <!-- Card content -->
</div>
```

## Semantic Colors

These colors are consistent across all modules:

| Purpose | Color | Tailwind |
|---------|-------|----------|
| Success | Green | `emerald-500` |
| Warning | Amber | `amber-500` |
| Error | Red | `red-500` |
| Info | Blue | `blue-500` |

## Dark Mode

Currently, landing pages use light mode only. The Filament admin panel supports dark mode automatically.

## Color in CSS Variables

The `app.css` defines module-specific primary colors:

```css
@theme {
    /* Primary Colors (change per module) */
    --color-primary-50: #f5f3ff;   /* violet-50 */
    --color-primary-100: #ede9fe;  /* violet-100 */
    --color-primary-200: #ddd6fe;  /* violet-200 */
    --color-primary-300: #c4b5fd;  /* violet-300 */
    --color-primary-400: #a78bfa;  /* violet-400 */
    --color-primary-500: #8b5cf6;  /* violet-500 */
    --color-primary-600: #7c3aed;  /* violet-600 */
    --color-primary-700: #6d28d9;  /* violet-700 */
    --color-primary-800: #5b21b6;  /* violet-800 */
    --color-primary-900: #4c1d95;  /* violet-900 */
    --color-primary-950: #2e1065;  /* violet-950 */
}
```

When creating a new module, update these values to match the module's designated color.
