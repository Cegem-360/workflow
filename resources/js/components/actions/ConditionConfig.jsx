import React, { useMemo, useCallback, useState } from "react";
import { OUTPUT_NODE_TYPES } from "../../constants/nodeTypes";

const OPERATORS = [
    {
        value: "equals",
        label: "Equals (==)",
        symbol: "=",
        description: "Loose equality comparison",
    },
    {
        value: "strictEquals",
        label: "Strict Equals (===)",
        symbol: "===",
        description: "Strict equality comparison",
    },
    {
        value: "notEquals",
        label: "Not Equals (!=)",
        symbol: "≠",
        description: "Loose inequality comparison",
    },
    {
        value: "greaterThan",
        label: "Greater Than (>)",
        symbol: ">",
        description: "A is greater than B",
    },
    {
        value: "lessThan",
        label: "Less Than (<)",
        symbol: "<",
        description: "A is less than B",
    },
    {
        value: "greaterOrEqual",
        label: "Greater or Equal (>=)",
        symbol: "≥",
        description: "A is greater than or equal to B",
    },
    {
        value: "lessOrEqual",
        label: "Less or Equal (<=)",
        symbol: "≤",
        description: "A is less than or equal to B",
    },
    {
        value: "contains",
        label: "Contains",
        symbol: "∈",
        description: "A contains B (string or array)",
    },
    {
        value: "isEmpty",
        label: "Is Empty",
        symbol: "∅",
        description: "A is empty (ignores B)",
    },
    {
        value: "isNotEmpty",
        label: "Is Not Empty",
        symbol: "∃",
        description: "A is not empty (ignores B)",
    },
    {
        value: "isTrue",
        label: "Is Truthy",
        symbol: "?T",
        description: "A is truthy (ignores B)",
    },
    {
        value: "isFalse",
        label: "Is Falsy",
        symbol: "?F",
        description: "A is falsy (ignores B)",
    },
];

const ConditionConfig = ({ config, onChange, nodeId, nodes, edges }) => {
    const operator = config.operator || "equals";
    const passWhen = config.passWhen || "true";

    // Value A settings
    const valueAMode = config.valueAMode || "static"; // "static" or "dynamic"
    const valueAStatic = config.valueAStatic || "";
    const valueAPath = config.valueAPath || "";

    // Value B settings
    const valueBMode = config.valueBMode || "static"; // "static" or "dynamic"
    const valueBStatic = config.valueBStatic || "";
    const valueBPath = config.valueBPath || "";

    const [showPathDropdownA, setShowPathDropdownA] = useState(false);
    const [showPathDropdownB, setShowPathDropdownB] = useState(false);

    const updateConfig = useCallback(
        (updates) => {
            onChange({
                operator,
                passWhen,
                valueAMode,
                valueAStatic,
                valueAPath,
                valueBMode,
                valueBStatic,
                valueBPath,
                ...updates,
            });
        },
        [
            onChange,
            operator,
            passWhen,
            valueAMode,
            valueAStatic,
            valueAPath,
            valueBMode,
            valueBStatic,
            valueBPath,
        ],
    );

    // Get all connected input nodes and their available fields
    const connectedInputs = useMemo(() => {
        if (!edges || !nodes) return [];

        // Find all edges connected to the "input" handle
        const inputEdges = edges.filter((e) => e.target === nodeId && e.targetHandle === "input");
        if (inputEdges.length === 0) return [];

        const inputs = [];

        inputEdges.forEach((inputEdge) => {
            const inputNode = nodes.find((n) => n.id === inputEdge.source);
            if (!inputNode) return;

            const nodeType = inputNode.data?.type;
            const nodeConfig = inputNode.data?.config || {};
            const paths = [];

            // For action nodes, get discoveredPaths and responseMapping
            if (OUTPUT_NODE_TYPES.includes(nodeType)) {
                // Add discovered paths from API test
                if (nodeConfig.discoveredPaths?.length > 0) {
                    nodeConfig.discoveredPaths.forEach((p) => {
                        paths.push({
                            path: p.path,
                            type: p.type,
                            preview: p.preview,
                            source: "discovered",
                            nodeId: inputNode.id,
                        });
                    });
                }

                // Add mapped fields
                if (nodeConfig.responseMapping?.length > 0) {
                    nodeConfig.responseMapping.forEach((m) => {
                        if (m.alias) {
                            paths.push({
                                path: `_mapped.${m.alias}`,
                                type: "mapped",
                                preview: `→ ${m.path}`,
                                source: "mapping",
                                nodeId: inputNode.id,
                            });
                        }
                    });
                }
            }

            // For constant nodes, add a simple value indicator
            if (nodeType === "constant") {
                const valueType = nodeConfig.valueType || "text";
                const previewValue =
                    nodeConfig.value !== undefined ? String(nodeConfig.value).substring(0, 30) : "";
                paths.push({
                    path: `$constant:${inputNode.id}`, // Special path format for constants
                    type: valueType,
                    preview: previewValue || "(empty)",
                    source: "constant",
                    nodeId: inputNode.id,
                    displayLabel: `value: ${previewValue || "(empty)"}`,
                });
            }

            inputs.push({
                id: inputNode.id,
                label: inputNode.data?.label || inputNode.id,
                type: nodeType,
                paths,
                isActionOutput: OUTPUT_NODE_TYPES.includes(nodeType),
                isConstant: nodeType === "constant",
            });
        });

        return inputs;
    }, [edges, nodes, nodeId]);

    // Flatten all paths from all connected inputs with node labels
    const allAvailablePaths = useMemo(() => {
        const paths = [];
        connectedInputs.forEach((input) => {
            input.paths.forEach((p) => {
                paths.push({
                    ...p,
                    nodeLabel: input.label,
                    fullPath: input.paths.length > 0 ? p.path : "",
                });
            });
        });
        return paths;
    }, [connectedInputs]);

    const selectedOperator = OPERATORS.find((op) => op.value === operator);
    const isUnaryOperator = ["isEmpty", "isNotEmpty", "isTrue", "isFalse"].includes(operator);

    // Render a value configuration section (for A or B)
    const renderValueConfig = (
        label,
        mode,
        staticValue,
        pathValue,
        onModeChange,
        onStaticChange,
        onPathChange,
        showDropdown,
        setShowDropdown,
        colorClass,
    ) => (
        <div className="space-y-2">
            <div className="flex items-center gap-2">
                <span className={`font-mono font-semibold ${colorClass}`}>{label}:</span>
            </div>

            {/* Mode selector - radio buttons */}
            <div className="flex gap-4 ml-4">
                <label className="flex items-center gap-1.5 cursor-pointer">
                    <input
                        type="radio"
                        name={`mode-${label}`}
                        checked={mode === "static"}
                        onChange={() => onModeChange("static")}
                        className="w-4 h-4 text-blue-600"
                    />
                    <span className="text-sm text-gray-700 dark:text-gray-300">Static</span>
                </label>
                <label
                    className={`flex items-center gap-1.5 cursor-pointer ${connectedInputs.length === 0 ? "opacity-50" : ""}`}
                >
                    <input
                        type="radio"
                        name={`mode-${label}`}
                        checked={mode === "dynamic"}
                        onChange={() => onModeChange("dynamic")}
                        disabled={connectedInputs.length === 0}
                        className="w-4 h-4 text-purple-600"
                    />
                    <span className="text-sm text-gray-700 dark:text-gray-300">
                        Dynamic (from input)
                    </span>
                </label>
            </div>

            {/* Value input based on mode */}
            <div className="ml-4">
                {mode === "static" ? (
                    <input
                        type="text"
                        value={staticValue}
                        onChange={(e) => onStaticChange(e.target.value)}
                        placeholder="Enter static value..."
                        className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    />
                ) : (
                    <div className="relative">
                        <input
                            type="text"
                            value={pathValue}
                            onChange={(e) => onPathChange(e.target.value)}
                            onFocus={() => setShowDropdown(true)}
                            onBlur={() => setTimeout(() => setShowDropdown(false), 200)}
                            placeholder={
                                allAvailablePaths.length > 0
                                    ? "Select or type field path..."
                                    : "e.g., data.status"
                            }
                            className="w-full px-3 py-2 border border-purple-300 dark:border-purple-600 rounded text-sm font-mono bg-purple-50 dark:bg-purple-900/20 text-gray-900 dark:text-white"
                        />
                        {showDropdown && allAvailablePaths.length > 0 && (
                            <div className="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded shadow-lg max-h-60 overflow-y-auto">
                                <button
                                    type="button"
                                    onClick={() => {
                                        onPathChange("");
                                        setShowDropdown(false);
                                    }}
                                    className={`w-full text-left px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 ${
                                        !pathValue ? "bg-purple-50 dark:bg-purple-900/30" : ""
                                    }`}
                                >
                                    <span className="font-medium">(Full output)</span>
                                </button>
                                {connectedInputs.map((input) => (
                                    <React.Fragment key={input.id}>
                                        {connectedInputs.length > 1 && (
                                            <div className="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 border-t border-gray-200 dark:border-gray-600">
                                                {input.label}
                                            </div>
                                        )}
                                        {input.paths.map((item, idx) => (
                                            <button
                                                key={`${input.id}-${idx}`}
                                                type="button"
                                                onClick={() => {
                                                    onPathChange(item.path);
                                                    setShowDropdown(false);
                                                }}
                                                className={`w-full text-left px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 flex justify-between items-center ${
                                                    pathValue === item.path
                                                        ? "bg-purple-50 dark:bg-purple-900/30"
                                                        : ""
                                                }`}
                                            >
                                                <span className="font-mono text-gray-800 dark:text-gray-200 truncate">
                                                    {item.displayLabel ||
                                                        item.path ||
                                                        "(full output)"}
                                                </span>
                                                <span
                                                    className={`text-xs px-1.5 py-0.5 rounded ml-2 flex-shrink-0 ${
                                                        item.source === "constant"
                                                            ? "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400"
                                                            : item.source === "mapping"
                                                              ? "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400"
                                                              : item.type === "string"
                                                                ? "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400"
                                                                : item.type === "number"
                                                                  ? "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400"
                                                                  : "bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400"
                                                    }`}
                                                >
                                                    {item.source === "constant"
                                                        ? `const:${item.type}`
                                                        : item.type}
                                                </span>
                                            </button>
                                        ))}
                                    </React.Fragment>
                                ))}
                            </div>
                        )}
                        {connectedInputs.length === 0 && (
                            <p className="text-xs text-amber-600 dark:text-amber-400 mt-1">
                                Connect an input node to use dynamic values
                            </p>
                        )}
                        {connectedInputs.length > 0 && allAvailablePaths.length === 0 && (
                            <p className="text-xs text-amber-600 dark:text-amber-400 mt-1">
                                Tip: Test the API in the source node to see available fields
                            </p>
                        )}
                    </div>
                )}
            </div>
        </div>
    );

    return (
        <div className="space-y-4">
            {/* Connected Inputs Info */}
            {connectedInputs.length > 0 && (
                <div className="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded p-2">
                    <p className="text-xs text-green-700 dark:text-green-400">
                        <strong>Inputs ({connectedInputs.length}):</strong>{" "}
                        {connectedInputs.map((input, idx) => (
                            <span key={input.id}>
                                {idx > 0 && ", "}
                                {input.label}
                                {input.paths.length > 0 && (
                                    <span className="text-green-600 dark:text-green-500">
                                        {" "}
                                        ({input.paths.length})
                                    </span>
                                )}
                            </span>
                        ))}
                    </p>
                </div>
            )}

            {connectedInputs.length === 0 && (
                <div className="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded p-2">
                    <p className="text-xs text-amber-700 dark:text-amber-400">
                        No input connected. Connect action or constant nodes to use dynamic values.
                        Multiple inputs are supported.
                    </p>
                </div>
            )}

            {/* Operator Selection */}
            <div>
                <label className="block text-sm font-medium mb-1.5 text-gray-700 dark:text-gray-300">
                    Operator
                </label>
                <select
                    value={operator}
                    onChange={(e) => updateConfig({ operator: e.target.value })}
                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                >
                    {OPERATORS.map((op) => (
                        <option key={op.value} value={op.value}>
                            {op.label}
                        </option>
                    ))}
                </select>
                {selectedOperator && (
                    <p className="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {selectedOperator.description}
                    </p>
                )}
            </div>

            {/* Value A Configuration */}
            <div className="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded p-3">
                {renderValueConfig(
                    "A",
                    valueAMode,
                    valueAStatic,
                    valueAPath,
                    (mode) => updateConfig({ valueAMode: mode }),
                    (val) => updateConfig({ valueAStatic: val }),
                    (path) => updateConfig({ valueAPath: path }),
                    showPathDropdownA,
                    setShowPathDropdownA,
                    "text-blue-600 dark:text-blue-400",
                )}
            </div>

            {/* Value B Configuration (if not unary operator) */}
            {!isUnaryOperator && (
                <div className="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded p-3">
                    {renderValueConfig(
                        "B",
                        valueBMode,
                        valueBStatic,
                        valueBPath,
                        (mode) => updateConfig({ valueBMode: mode }),
                        (val) => updateConfig({ valueBStatic: val }),
                        (path) => updateConfig({ valueBPath: path }),
                        showPathDropdownB,
                        setShowPathDropdownB,
                        "text-purple-600 dark:text-purple-400",
                    )}
                </div>
            )}

            {/* Condition Preview */}
            <div className="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded p-3">
                <h5 className="font-medium text-sm text-amber-800 dark:text-amber-400 mb-2">
                    Condition Preview
                </h5>
                <div className="font-mono text-sm text-center py-2 bg-white dark:bg-gray-700 rounded border border-amber-200 dark:border-amber-600">
                    <span className="text-blue-600 dark:text-blue-400">
                        {valueAMode === "static"
                            ? `"${valueAStatic || "..."}"`
                            : `input.${valueAPath || "*"}`}
                    </span>
                    <span className="mx-2 text-amber-600 dark:text-amber-400">
                        {selectedOperator?.symbol || "?"}
                    </span>
                    {!isUnaryOperator && (
                        <span className="text-purple-600 dark:text-purple-400">
                            {valueBMode === "static"
                                ? `"${valueBStatic || "..."}"`
                                : `input.${valueBPath || "*"}`}
                        </span>
                    )}
                </div>
            </div>

            {/* Pass When Selection */}
            <div>
                <label className="block text-sm font-medium mb-1.5 text-gray-700 dark:text-gray-300">
                    Continue to output when
                </label>
                <div className="flex gap-2">
                    <button
                        type="button"
                        onClick={() => updateConfig({ passWhen: "true" })}
                        className={`flex-1 px-4 py-2.5 rounded-lg border-2 transition-all font-medium text-sm ${
                            passWhen === "true"
                                ? "border-green-500 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400"
                                : "border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 hover:border-gray-400"
                        }`}
                    >
                        <span className="block text-lg mb-0.5">✓</span>
                        TRUE
                    </button>
                    <button
                        type="button"
                        onClick={() => updateConfig({ passWhen: "false" })}
                        className={`flex-1 px-4 py-2.5 rounded-lg border-2 transition-all font-medium text-sm ${
                            passWhen === "false"
                                ? "border-red-500 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400"
                                : "border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 hover:border-gray-400"
                        }`}
                    >
                        <span className="block text-lg mb-0.5">✗</span>
                        FALSE
                    </button>
                </div>
            </div>

            {/* Tips */}
            <div className="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded p-2">
                <p className="text-xs text-blue-800 dark:text-blue-400">
                    <strong>Tip:</strong> Use static for fixed values, dynamic for values from
                    connected nodes. The workflow continues when the condition result matches your
                    "pass when" setting.
                </p>
            </div>
        </div>
    );
};

export default ConditionConfig;
