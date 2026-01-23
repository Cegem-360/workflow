# Cégem360 Design System Cheatsheet

## Quick Reference

### Module Colors

| Module | Tailwind | Hex |
|--------|----------|-----|
| Subscriber | `indigo-*` | #6161FF |
| Controlling | `emerald-*` | #10B981 |
| CRM | `blue-*` | #3B82F6 |
| Automatizálás | `violet-*` | #8B5CF6 |
| Beszerzés | `amber-*` | #D97706 |

### Essential Layout Setup

```blade
{{-- app.blade.php <head> --}}
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|poppins:400,500,600,700" rel="stylesheet" />
@vite(['resources/css/app.css', 'resources/js/app.jsx'])
@filamentStyles   {{-- CRITICAL: Provides gray color variables --}}
@livewireStyles

{{-- app.blade.php before </body> --}}
@livewireScripts
@filamentScripts  {{-- Includes Alpine.js --}}
```

### Common Patterns

#### Primary CTA Button
```blade
<a class="px-8 py-4 text-white bg-violet-600 rounded-full hover:bg-violet-700 font-semibold">
    CTA Text
</a>
```

#### Secondary Button
```blade
<a class="px-8 py-4 text-violet-700 bg-white border-2 border-violet-200 rounded-full hover:bg-violet-50 font-semibold">
    Secondary
</a>
```

#### Feature Card
```blade
<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center mb-4">
        <svg class="w-6 h-6 text-violet-600">...</svg>
    </div>
    <h3 class="text-xl font-semibold text-gray-900 mb-3">Title</h3>
    <p class="text-gray-600">Description</p>
</div>
```

#### Section Header
```blade
<div class="text-center max-w-3xl mx-auto mb-12">
    <h2 class="text-3xl sm:text-4xl font-semibold text-gray-900 mb-4 font-heading">
        Section Title
    </h2>
    <p class="text-lg text-gray-600">Subtitle text</p>
</div>
```

#### Badge
```blade
<span class="inline-flex items-center gap-2 px-4 py-1.5 bg-violet-100 text-violet-700 rounded-full text-sm font-medium">
    Badge Text
</span>
```

#### Checklist Item
```blade
<li class="flex items-center gap-2 text-sm text-gray-600">
    <svg class="w-4 h-4 text-violet-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
    </svg>
    Item text
</li>
```

#### FAQ Accordion Item
```blade
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: false }">
    <button @click="open = !open" class="w-full px-6 py-4 text-left flex items-center justify-between">
        <span class="font-medium text-gray-900">Question?</span>
        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <div x-show="open" x-collapse>
        <div class="px-6 pb-4 text-gray-600">Answer text...</div>
    </div>
</div>
```

### Section Backgrounds

| Section | Classes |
|---------|---------|
| Hero | `bg-gradient-to-b from-violet-50 to-white` |
| Features | `bg-gray-50` |
| Normal | `bg-white` |
| CTA | `bg-gradient-to-r from-violet-600 to-purple-700` |

### Spacing

| Usage | Classes |
|-------|---------|
| Section padding | `py-16 lg:py-24` |
| Container | `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8` |
| Card grid gap | `gap-8` |
| Element margin bottom | `mb-4`, `mb-6`, `mb-8`, `mb-12` |

### Typography Quick Reference

| Element | Classes |
|---------|---------|
| H1 | `text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-900 font-heading leading-tight` |
| H2 | `text-3xl sm:text-4xl font-semibold text-gray-900 font-heading` |
| H3 | `text-xl font-semibold text-gray-900` |
| Subtitle | `text-lg sm:text-xl text-gray-600` |
| Body | `text-gray-600` |
| Small | `text-sm text-gray-600` |

### Files to Create for New Module

```
app/
├── Filament/Pages/Auth/
│   ├── Login.php               # Custom login page class
│   └── Register.php            # Custom registration page class
├── Http/
│   ├── Middleware/
│   │   └── SetLocale.php       # Language middleware
│   └── Responses/
│       ├── LoginResponse.php   # Redirect to /dashboard after login
│       └── RegistrationResponse.php # Redirect to /dashboard after registration
└── Providers/
    └── AppServiceProvider.php  # Bind custom auth responses

bootstrap/
└── app.php                     # Register SetLocale middleware

resources/
├── css/
│   └── app.css                 # Copy from existing, update primary colors
├── images/
│   └── logo.png                # Copy from existing module
└── views/
    ├── components/
    │   ├── layouts/
    │   │   ├── app.blade.php   # Include @filamentStyles/@filamentScripts
    │   │   ├── navbar.blade.php
    │   │   └── footer.blade.php
    │   └── language-switcher.blade.php
    ├── filament/
    │   ├── layouts/
    │   │   ├── auth.blade.php  # Centered layout (login)
    │   │   └── auth-split.blade.php # Split layout (registration)
    │   └── pages/auth/
    │       ├── login.blade.php # Login form UI
    │       └── register.blade.php # Registration form UI
    └── home.blade.php          # Landing page

routes/
└── web.php                     # Add home, language.switch, /login, /register routes
```

### Build Commands

```bash
npm install          # First time setup
npm run build        # Production build
npm run dev          # Development with hot reload
vendor/bin/pint      # Format PHP code
```

---

## React Components (Workflow Module Only)

> React is used **only** for the workflow editor (React Flow requires it). All other modules use the TALL stack.

### Scroll Indicator Pattern

```jsx
const [canScrollDown, setCanScrollDown] = useState(false);
const navRef = useRef(null);

useEffect(() => {
    const nav = navRef.current;
    const checkScroll = () => {
        const hasOverflow = nav.scrollHeight > nav.clientHeight;
        const isAtBottom = nav.scrollTop + nav.clientHeight >= nav.scrollHeight - 10;
        setCanScrollDown(hasOverflow && !isAtBottom);
    };

    setTimeout(checkScroll, 100); // Wait for content to render
    nav.addEventListener("scroll", checkScroll);
    return () => nav.removeEventListener("scroll", checkScroll);
}, []);

// Gradient indicator
{canScrollDown && (
    <div className="absolute bottom-0 left-0 right-0 h-16 bg-linear-to-t from-gray-200 via-gray-200/80 to-transparent pointer-events-none flex items-end justify-center pb-2">
        <ChevronDown className="w-4 h-4 text-gray-500 animate-bounce" />
    </div>
)}
```

### Drag-and-Drop Node

```jsx
<div
    draggable
    onDragStart={(e) => {
        e.dataTransfer.setData("application/reactflow", nodeType);
        e.dataTransfer.effectAllowed = "move";
    }}
    className="cursor-grab active:cursor-grabbing"
>
    {/* Node content */}
</div>
```

### Node Category Colors

```jsx
const categoryColors = {
    triggers: "text-violet-500",
    actions: "text-blue-500",
    integrations: "text-green-500",
    logic: "text-amber-500",
    flow: "text-gray-500",
};
```

### React + Alpine.js Coordination

The React editor lives inside an Alpine-controlled layout:

```blade
<body x-data="{ sidebarOpen: true }">
    {{-- Alpine controls sidebar visibility --}}
    <aside x-show="sidebarOpen">...</aside>

    {{-- React fills remaining space --}}
    <div :class="{ 'lg:ml-60': sidebarOpen }">
        <div id="admin-app" class="h-full"></div>
    </div>
</body>
```

React doesn't need sidebar state - it automatically fills the available container space.
