# Typography

## Font Families

The Cégem360 design system uses the **Vibe Design System** (Monday.com style) typography:

| Font | Usage | Weight Range |
|------|-------|--------------|
| **Figtree** | Body text, UI elements | 400-700 |
| **Poppins** | Headings, titles | 400-700 |

## Loading Fonts

### Option 1: Bunny Fonts (Recommended - GDPR compliant)
```html
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|poppins:400,500,600,700" rel="stylesheet" />
```

### Option 2: Google Fonts
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
```

## CSS Configuration

In `app.css`, the fonts are defined in the `@theme` block:

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

## Heading Styles

Add this to your `<style>` block in `app.blade.php`:

```css
.font-heading {
    font-family: 'Poppins', sans-serif;
}
```

### Heading Hierarchy

| Element | Size | Weight | Line Height | Usage |
|---------|------|--------|-------------|-------|
| H1 | `text-4xl sm:text-5xl lg:text-6xl` | `font-semibold` | `leading-tight` | Page hero title |
| H2 | `text-3xl sm:text-4xl` | `font-semibold` | `leading-tight` | Section titles |
| H3 | `text-xl` | `font-semibold` | Default | Card titles, subsections |
| H4 | `text-lg` | `font-semibold` | Default | Small headings |

### Example Usage

```html
<!-- Hero H1 -->
<h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-900 mb-6 font-heading leading-tight">
    Szabadítsa fel csapata idejét az ismétlődő feladatoktól
</h1>

<!-- Section H2 -->
<h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
    Minden eszköz a hatékony automatizáláshoz
</h2>

<!-- Card H3 -->
<h3 class="text-xl font-semibold text-gray-900 mb-3">
    Trigger-alapú automatizálás
</h3>
```

## Body Text Styles

| Style | Classes | Usage |
|-------|---------|-------|
| Large paragraph | `text-lg sm:text-xl text-gray-600` | Hero subtitle |
| Body text | `text-base text-gray-600` | Card descriptions |
| Small text | `text-sm text-gray-600` | List items, details |
| Caption | `text-xs text-gray-500` | Labels, meta info |

### Example Usage

```html
<!-- Hero subtitle -->
<p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
    Ne végezzen manuálisan olyat, amit a rendszer is meg tud csinálni.
</p>

<!-- Card description -->
<p class="text-gray-600 mb-4">
    Definiáljon „ha ez történik, akkor csináld azt" típusú szabályokat.
</p>

<!-- List item -->
<li class="flex items-center gap-2 text-sm text-gray-600">
    <svg class="w-4 h-4 text-violet-500">...</svg>
    50+ trigger-típus
</li>
```

## Text Colors

| Color Class | Usage |
|-------------|-------|
| `text-gray-900` | Headings, important text |
| `text-gray-700` | Strong secondary text |
| `text-gray-600` | Body text, descriptions |
| `text-gray-500` | Muted text, captions |
| `text-gray-400` | Disabled, placeholder |
| `text-white` | Text on dark/colored backgrounds |

## Letter Spacing

For headings, use slightly negative letter spacing for a modern look:

```css
letter-spacing: -0.5px;  /* For large headings */
letter-spacing: -0.1px;  /* For smaller headings */
```

In Tailwind:
```html
<h1 class="tracking-tight">...</h1>
```
