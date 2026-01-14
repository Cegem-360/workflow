import {
    Calendar,
    CircleCheck,
    Code,
    Database,
    FileText,
    GitBranch,
    GitMerge,
    GripVertical,
    Layers,
    LayoutGrid,
    Mail,
    Network,
    Settings,
    Sparkles,
    SquareStack,
    Webhook,
    Zap,
} from "lucide-react";
import { nodeTypeConfig } from "@/constants/workflowConstants";
import { Separator } from "@/components/ui/separator";

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
    template: LayoutGrid,
    end: CircleCheck,
};

const WorkflowSidebar = ({ onDragStart, onSettingsClick }) => {
    return (
        <div className="w-64 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm flex flex-col">
            <div className="p-4 pb-3">
                <div className="flex items-center gap-2">
                    <LayoutGrid className="w-5 h-5 text-gray-600 dark:text-gray-400" />
                    <h3 className="font-semibold text-gray-900 dark:text-white">Workflow Editor</h3>
                </div>
            </div>

            <Separator />

            <div className="flex-1 p-2 space-y-1 overflow-y-auto">
                {Object.entries(nodeTypeConfig).map(([key, { label }]) => {
                    const Icon = nodeIcons[key];
                    return (
                        <div
                            key={key}
                            draggable
                            onDragStart={(e) => onDragStart(e, key)}
                            className="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-grab active:cursor-grabbing hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group"
                        >
                            {Icon && <Icon className="w-5 h-5 text-gray-600 dark:text-gray-400" />}
                            <span className="flex-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                                {label}
                            </span>
                            <GripVertical className="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity" />
                        </div>
                    );
                })}
            </div>

            <Separator />

            <div className="p-2">
                <button
                    onClick={onSettingsClick}
                    className="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                >
                    <Settings className="w-5 h-5 text-gray-600 dark:text-gray-400" />
                    <span className="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Settings
                    </span>
                </button>
            </div>
        </div>
    );
};

export default WorkflowSidebar;
