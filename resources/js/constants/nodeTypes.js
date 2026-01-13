// Node types that can provide output data
export const OUTPUT_NODE_TYPES = [
    "apiAction",
    "googleCalendarAction",
    "googleDocsAction",
    "databaseAction",
    "scriptAction",
    "webhookAction",
];

// Display labels for node types
export const NODE_TYPE_LABELS = {
    apiAction: "API Response",
    googleCalendarAction: "Calendar Event",
    googleDocsAction: "Document",
    databaseAction: "Database Result",
    scriptAction: "Script Output",
    webhookAction: "Webhook Response",
    constant: "Constant",
};

// Get display name for node type
export const getNodeTypeLabel = (type) => NODE_TYPE_LABELS[type] || type;

// Type-based styling classes for badges/chips
export const TYPE_STYLE_CLASSES = {
    string: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400",
    number: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400",
    boolean: "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400",
    array: "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400",
    object: "bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400",
};

export const DEFAULT_TYPE_STYLE = "bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400";

export const getTypeStyleClass = (type) => TYPE_STYLE_CLASSES[type] || DEFAULT_TYPE_STYLE;

// Quick-add chip styles by type
export const CHIP_STYLE_CLASSES = {
    string: "bg-green-50 border-green-200 text-green-700 hover:bg-green-100 dark:bg-green-900/20 dark:border-green-700 dark:text-green-400",
    number: "bg-blue-50 border-blue-200 text-blue-700 hover:bg-blue-100 dark:bg-blue-900/20 dark:border-blue-700 dark:text-blue-400",
    boolean:
        "bg-purple-50 border-purple-200 text-purple-700 hover:bg-purple-100 dark:bg-purple-900/20 dark:border-purple-700 dark:text-purple-400",
};

export const getChipStyleClass = (type) => CHIP_STYLE_CLASSES[type] || CHIP_STYLE_CLASSES.string;
