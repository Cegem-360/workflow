# Dashboard Sidebar Component

## Overview

The dashboard sidebar is a fixed 240px (w-60) navigation panel that appears on the left side of all dashboard pages. It contains the logo, navigation links, and user profile section.

## Preventing Flash/Flicker on Page Load

When using Alpine.js with `x-show` and `x-cloak`, there can be a visible flicker where the sidebar briefly disappears and reappears during page load. This is because `x-cloak` hides elements until Alpine initializes.

### Solution

Instead of relying on `x-show` with `x-cloak`, use CSS classes as defaults and let Alpine only handle state changes:

#### Sidebar Component (`dashboard-sidebar.blade.php`)

```blade
{{-- Dashboard sidebar - 240px width --}}
<aside
    class="fixed inset-y-0 left-0 z-50 w-60 bg-[#292F4C] text-white flex flex-col transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0"
    :class="{
        'lg:-translate-x-full': !sidebarOpen,
        'lg:translate-x-0': sidebarOpen,
        '-translate-x-full': !mobileMenuOpen,
        'translate-x-0': mobileMenuOpen
    }"
>
```

**Key points:**
- Default: Hidden on mobile (`-translate-x-full`), visible on desktop (`lg:translate-x-0`)
- No `x-show` or `x-cloak` - the element is always in the DOM
- Alpine only toggles visibility via transform classes
- Smooth transition with `transition-transform duration-300 ease-in-out`

#### Main Content Area (`dashboard.blade.php`)

```blade
{{-- Main content area --}}
<div class="flex-1 flex flex-col min-w-0 lg:ml-60" :class="{ 'lg:!ml-0': !sidebarOpen }">
```

**Key points:**
- Default margin on desktop (`lg:ml-60`) - matches sidebar width
- When sidebar is closed, remove margin with `lg:!ml-0` (important modifier)
- No flicker because the initial state is set via CSS, not Alpine

### Alpine State

The body element should initialize with sidebar open by default:

```blade
<body x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
```

### Mobile Overlay

The mobile overlay can still use `x-show` with `x-cloak` since it's only visible on mobile interaction:

```blade
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
    x-cloak
></div>
```

## Responsive Behavior

| Breakpoint | Sidebar State | Main Content |
|------------|---------------|--------------|
| Mobile (<1024px) | Hidden by default, toggle with hamburger | Full width |
| Desktop (>=1024px) | Visible by default, toggleable | Left margin 240px |

## Modules Using This Pattern

- Storage-cms (Beszerzés)
- Subscriber
- Workflow
- CRM
- Controlling
