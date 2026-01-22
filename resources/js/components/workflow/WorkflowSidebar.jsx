import { useState, useRef, useEffect } from "react";
import {
    Calendar,
    ChevronDown,
    CircleCheck,
    Code,
    Database,
    FileText,
    GitBranch,
    GitMerge,
    GripVertical,
    Layers,
    Mail,
    Network,
    Settings,
    Sparkles,
    SquareStack,
    Webhook,
    Zap,
    LayoutTemplate,
} from "lucide-react";
import { nodeTypeConfig } from "@/constants/workflowConstants";

const nodeIcons = {
    start: Sparkles,
    webhookTrigger: Zap,
    apiAction: Network,
    emailAction: Mail,
    databaseAction: Database,
    scriptAction: Code,
    webhookAction: Webhook,
    googleCalendarAction: Calendar,
    googleDocsAction: FileText,
    condition: GitBranch,
    constant: SquareStack,
    branch: GitBranch,
    join: GitMerge,
    merge: Layers,
    template: LayoutTemplate,
    end: CircleCheck,
};

// Categorize nodes for better organization
const nodeCategories = {
    triggers: {
        label: "Triggers",
        nodes: ["start", "webhookTrigger"],
    },
    actions: {
        label: "Actions",
        nodes: ["apiAction", "emailAction", "databaseAction", "scriptAction", "webhookAction"],
    },
    integrations: {
        label: "Integrations",
        nodes: ["googleCalendarAction", "googleDocsAction"],
    },
    logic: {
        label: "Logic",
        nodes: ["condition", "constant", "template", "merge", "branch", "join"],
    },
    flow: {
        label: "Flow",
        nodes: ["end"],
    },
};

const WorkflowSidebar = ({ onDragStart, onSettingsClick }) => {
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
        <div className="w-60 bg-gray-200 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col rounded-r-xl shadow-lg overflow-hidden">
            {/* Header */}
            <div className="h-14 flex items-center px-4 border-b border-gray-200 dark:border-gray-700">
                <div className="flex items-center gap-2">
                    <div className="w-8 h-8 rounded-lg bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center">
                        <Layers className="w-4 h-4 text-violet-600 dark:text-violet-400" />
                    </div>
                    <span className="text-sm font-semibold text-gray-900 dark:text-white">
                        Node Palette
                    </span>
                </div>
            </div>

            {/* Node categories with scroll indicator */}
            <div className="flex-1 relative overflow-hidden">
                <nav ref={navRef} className="h-full overflow-y-auto py-4 px-3 space-y-6">
                    {Object.entries(nodeCategories).map(([categoryKey, { label, nodes }]) => (
                        <div key={categoryKey}>
                            <h3 className="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                                {label}
                            </h3>
                            <ul className="space-y-1">
                                {nodes.map((nodeKey) => {
                                    const config = nodeTypeConfig[nodeKey];
                                    if (!config) return null;
                                    const Icon = nodeIcons[nodeKey];
                                    return (
                                        <li key={nodeKey}>
                                            <div
                                                draggable
                                                onDragStart={(e) => onDragStart(e, nodeKey)}
                                                className="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium cursor-grab active:cursor-grabbing text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition group"
                                            >
                                                {Icon && (
                                                    <Icon
                                                        className={`w-5 h-5 ${
                                                            categoryKey === "triggers"
                                                                ? "text-violet-500"
                                                                : categoryKey === "actions"
                                                                  ? "text-blue-500"
                                                                  : categoryKey === "integrations"
                                                                    ? "text-green-500"
                                                                    : categoryKey === "logic"
                                                                      ? "text-amber-500"
                                                                      : "text-gray-500"
                                                        }`}
                                                    />
                                                )}
                                                <span className="flex-1">{config.label}</span>
                                                <GripVertical className="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity" />
                                            </div>
                                        </li>
                                    );
                                })}
                            </ul>
                        </div>
                    ))}
                </nav>

                {/* Scroll indicator */}
                {canScrollDown && (
                    <div className="absolute bottom-0 left-0 right-0 h-16 bg-linear-to-t from-gray-200 via-gray-200/80 dark:from-gray-800 dark:via-gray-800/80 to-transparent pointer-events-none flex items-end justify-center pb-2">
                        <ChevronDown className="w-4 h-4 text-gray-500 dark:text-gray-400 animate-bounce" />
                    </div>
                )}
            </div>

            {/* Settings button */}
            <div className="border-t border-gray-200 dark:border-gray-700 p-3">
                <button
                    onClick={onSettingsClick}
                    className="flex items-center gap-3 w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                >
                    <Settings className="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    <span>Workflow Settings</span>
                </button>
            </div>
        </div>
    );
};

export default WorkflowSidebar;
