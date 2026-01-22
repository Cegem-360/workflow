# React Workflow Editor Integration

> **Note:** React is used **only** for the workflow editor because React Flow (the node-based visual editor library) requires it. All other parts of the application use the TALL stack (Tailwind, Alpine, Livewire, Laravel).

The workflow editor is a React application embedded within the dashboard layout, built with React Flow for node-based visual editing.

## Overview

- **Technology:** React 19 + React Flow + Vite
- **Mount point:** `#admin-app` div element
- **Sidebar toggle:** Shared Alpine.js state with dashboard

---

## Project Structure

```
resources/js/
├── app.jsx                          # Main React entry point
├── components/
│   └── workflow/
│       ├── WorkflowEditor.jsx       # Main editor canvas
│       ├── WorkflowSidebar.jsx      # Node palette sidebar
│       ├── WorkflowContextBar.jsx   # Top context bar
│       └── nodes/                   # Custom node components
└── constants/
    └── workflowConstants.js         # Node type configurations
```

---

## Dashboard Integration

### Blade Template Setup

```blade
{{-- dashboard/workflow-editor.blade.php --}}
<body class="antialiased bg-gray-50" x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
    <div class="min-h-screen flex">
        <x-layouts.dashboard-sidebar />

        <div class="flex-1 flex flex-col min-w-0" :class="{ 'lg:ml-60': sidebarOpen }">
            <x-layouts.dashboard-header />

            {{-- Context bar for workflow-specific controls --}}
            <div class="h-12 bg-white border-b border-gray-200 flex items-center px-6 justify-between">
                <!-- workflow name, badges, save button -->
            </div>

            {{-- React app mount point with top padding for breathing room --}}
            <main class="flex-1 overflow-hidden pt-8">
                <div id="admin-app" class="h-full" data-workflow-id="{{ $workflow->id }}"></div>
            </main>
        </div>
    </div>

    @livewire('notifications')
    @filamentScripts
</body>
```

### React Mount Detection

```javascript
// app.jsx
const adminElement = document.getElementById("admin-app");
const workflowId = adminElement?.dataset.workflowId;
const isDashboardMode = !!workflowId;

if (adminElement) {
    const root = createRoot(adminElement);
    root.render(
        <StrictMode>
            <WorkflowEditor workflowId={workflowId} isDashboardMode={isDashboardMode} />
        </StrictMode>
    );
}
```

---

## WorkflowSidebar Component

### Node Palette with Categories

```jsx
const nodeCategories = {
    triggers: {
        label: "Triggers",
        nodes: ["start", "webhookTrigger"],
    },
    actions: {
        label: "Actions",
        nodes: ["apiAction", "emailAction", "databaseAction"],
    },
    integrations: {
        label: "Integrations",
        nodes: ["googleCalendarAction", "googleDocsAction"],
    },
    logic: {
        label: "Logic",
        nodes: ["condition", "constant", "template", "merge"],
    },
    flow: {
        label: "Flow",
        nodes: ["end"],
    },
};
```

### Scroll Indicator Pattern

When the node palette overflows, show a visual indicator that more content exists:

```jsx
const WorkflowSidebar = ({ onDragStart }) => {
    const navRef = useRef(null);
    const [canScrollDown, setCanScrollDown] = useState(false);

    useEffect(() => {
        const nav = navRef.current;
        if (!nav) return;

        const checkScroll = () => {
            const hasOverflow = nav.scrollHeight > nav.clientHeight;
            const isAtBottom = nav.scrollTop + nav.clientHeight >= nav.scrollHeight - 10;
            setCanScrollDown(hasOverflow && !isAtBottom);
        };

        // Delay initial check to ensure content is rendered
        const timeoutId = setTimeout(checkScroll, 100);

        nav.addEventListener("scroll", checkScroll);
        window.addEventListener("resize", checkScroll);

        return () => {
            clearTimeout(timeoutId);
            nav.removeEventListener("scroll", checkScroll);
            window.removeEventListener("resize", checkScroll);
        };
    }, []);

    return (
        <div className="w-60 bg-gray-200 flex flex-col overflow-hidden">
            {/* Header */}
            <div className="h-14 border-b">...</div>

            {/* Scrollable content with indicator */}
            <div className="flex-1 relative overflow-hidden">
                <nav ref={navRef} className="h-full overflow-y-auto py-4 px-3">
                    {/* Node categories */}
                </nav>

                {/* Gradient fade with bouncing chevron */}
                {canScrollDown && (
                    <div className="absolute bottom-0 left-0 right-0 h-16 bg-linear-to-t from-gray-200 via-gray-200/80 to-transparent pointer-events-none flex items-end justify-center pb-2">
                        <ChevronDown className="w-4 h-4 text-gray-500 animate-bounce" />
                    </div>
                )}
            </div>
        </div>
    );
};
```

### Category Color Coding

Each node category has a distinct icon color:

| Category     | Color Class     | Hex       |
|--------------|-----------------|-----------|
| Triggers     | `text-violet-500` | #8b5cf6 |
| Actions      | `text-blue-500`   | #3b82f6 |
| Integrations | `text-green-500`  | #22c55e |
| Logic        | `text-amber-500`  | #f59e0b |
| Flow         | `text-gray-500`   | #6b7280 |

---

## Sidebar Styling

### Background Color

The WorkflowSidebar uses `bg-gray-200` for a light, neutral appearance that complements the dashboard:

```jsx
<div className="w-60 bg-gray-200 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col rounded-r-xl shadow-lg overflow-hidden">
```

**Design decisions:**
- `bg-gray-200` provides subtle contrast against the white editor canvas
- `dark:bg-gray-800` maintains consistency in dark mode
- `rounded-r-xl` softens the sidebar edge
- `shadow-lg` creates depth separation from content

### Drag Handle Visual

Show grip handle on hover to indicate draggable items:

```jsx
<GripVertical className="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity" />
```

---

## Alpine.js + React Coordination

The dashboard sidebar toggle uses Alpine.js state at the `<body>` level. The React workflow editor adapts to available space automatically since it's in a flex container:

```blade
<body x-data="{ sidebarOpen: true }">
    <div class="flex">
        {{-- Alpine-controlled sidebar --}}
        <aside x-show="sidebarOpen" class="w-60 fixed">...</aside>

        {{-- Content area adjusts with margin --}}
        <div :class="{ 'lg:ml-60': sidebarOpen }" class="flex-1">
            {{-- React editor fills available space --}}
            <div id="admin-app" class="h-full"></div>
        </div>
    </div>
</body>
```

The React editor doesn't need to know about sidebar state - it simply fills its container.

---

## Drag and Drop

### Drag Start Handler

```jsx
const onDragStart = (event, nodeType) => {
    event.dataTransfer.setData("application/reactflow", nodeType);
    event.dataTransfer.effectAllowed = "move";
};

// In sidebar item
<div
    draggable
    onDragStart={(e) => onDragStart(e, nodeKey)}
    className="cursor-grab active:cursor-grabbing"
>
```

### Drop Handler (in WorkflowEditor)

```jsx
const onDrop = useCallback((event) => {
    event.preventDefault();
    const nodeType = event.dataTransfer.getData("application/reactflow");

    const position = screenToFlowPosition({
        x: event.clientX,
        y: event.clientY,
    });

    const newNode = {
        id: `${nodeType}_${Date.now()}`,
        type: nodeType,
        position,
        data: { ...nodeTypeConfig[nodeType] },
    };

    setNodes((nodes) => [...nodes, newNode]);
}, [screenToFlowPosition, setNodes]);
```

---

## Vite Configuration

```javascript
// vite.config.js
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.jsx"],
            refresh: true,
        }),
        react(),
    ],
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
});
```

---

## Troubleshooting

### React Not Rendering

1. Check that `#admin-app` element exists in HTML
2. Verify `npm run build` or `npm run dev` has run
3. Check browser console for errors

### Sidebar Toggle Not Working

The toggle uses Alpine.js state on `<body>`. Ensure:
- `x-data="{ sidebarOpen: true }"` is on body
- Toggle button uses `@click="sidebarOpen = !sidebarOpen"`
- Content area uses `:class="{ 'lg:ml-60': sidebarOpen }"`

### Scroll Indicator Not Showing

The indicator only appears when:
1. Content overflows the container
2. User hasn't scrolled to the bottom
3. Initial 100ms delay has passed (for content to render)

Check that the `nav` container has a fixed height constraint (via `h-full` in a flex parent with `overflow-hidden`).
