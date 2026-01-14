import { useCallback, useState, useEffect, useRef } from "react";
import { useNodesState, useEdgesState, addEdge, useReactFlow } from "@xyflow/react";
import { nodeTypeConfig } from "@/constants/workflowConstants";
import { getLayoutedElements } from "@/utils/elkLayout";
import { useDarkMode } from "@/hooks/useDarkMode";
import axios from "axios";

// Map data types to React Flow node types
const DATA_TYPE_TO_REACT_FLOW = {
    googleCalendarAction: "googleCalendar",
    googleDocsAction: "googleDocs",
};

const ACTION_TYPES = new Set([
    "apiAction",
    "emailAction",
    "databaseAction",
    "scriptAction",
    "webhookAction",
    "action",
]);

const PASSTHROUGH_TYPES = new Set([
    "start",
    "end",
    "condition",
    "constant",
    "branch",
    "join",
    "merge",
    "template",
    "webhookTrigger",
]);

const getReactFlowNodeType = (dataType) => {
    if (DATA_TYPE_TO_REACT_FLOW[dataType]) {
        return DATA_TYPE_TO_REACT_FLOW[dataType];
    }
    if (ACTION_TYPES.has(dataType)) {
        return "action";
    }
    if (PASSTHROUGH_TYPES.has(dataType)) {
        return dataType;
    }
    return "action";
};

// Get default node dimensions based on type
const NODE_DIMENSIONS = {
    condition: { width: 120, height: 120 },
    start: { width: 120, height: 50 },
    end: { width: 120, height: 50 },
    webhookTrigger: { width: 120, height: 50 },
    constant: { width: 140, height: 60 },
    branch: { width: 220, height: 90 },
    join: { width: 220, height: 90 },
    merge: { width: 220, height: 90 },
    template: { width: 220, height: 90 },
    googleCalendar: { width: 240, height: 80 },
    googleDocs: { width: 240, height: 80 },
};

const DEFAULT_DIMENSIONS = { width: 180, height: 70 };

const getNodeDimensions = (nodeType) => NODE_DIMENSIONS[nodeType] || DEFAULT_DIMENSIONS;

// Default data for specific node types
const NODE_TYPE_DEFAULTS = {
    branch: { outputs: ["output-1", "output-2"] },
    join: { inputs: ["input-1", "input-2"] },
    merge: { inputs: ["input-1", "input-2"], config: { separator: "" } },
    template: { inputs: ["input-1", "input-2"], config: { template: "${input1} ${input2}" } },
};

// Helper to update a single node's data
const updateNodeData = (nodes, nodeId, dataUpdates) =>
    nodes.map((node) =>
        node.id === nodeId ? { ...node, data: { ...node.data, ...dataUpdates } } : node,
    );

// Helper to build axios config for API requests
const buildApiConfig = (config) => {
    const { method = "POST", url, requestBody = {}, headers = {} } = config;
    const lowerMethod = method.toLowerCase();

    const axiosConfig = {
        method: lowerMethod,
        url,
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            ...headers,
        },
    };

    if (["post", "put", "patch"].includes(lowerMethod)) {
        axiosConfig.data = requestBody;
    }

    return axiosConfig;
};

// Condition evaluation logic
const evaluateCondition = (operator, valueA, valueB) => {
    const numA = parseFloat(valueA);
    const numB = parseFloat(valueB);

    switch (operator) {
        case "equals":
            return valueA == valueB;
        case "strictEquals":
            return valueA === valueB;
        case "notEquals":
            return valueA != valueB;
        case "greaterThan":
            return numA > numB;
        case "lessThan":
            return numA < numB;
        case "greaterOrEqual":
            return numA >= numB;
        case "lessOrEqual":
            return numA <= numB;
        case "contains":
            return String(valueA).includes(String(valueB));
        case "isEmpty":
            return valueA === "" || valueA === null || valueA === undefined;
        case "isNotEmpty":
            return valueA !== "" && valueA !== null && valueA !== undefined;
        case "isTrue":
            return valueA === true || valueA === "true" || valueA === 1 || valueA === "1";
        case "isFalse":
            return valueA === false || valueA === "false" || valueA === 0 || valueA === "0";
        default:
            return false;
    }
};

export const useWorkflowEditor = (initialNodes = [], initialEdges = []) => {
    const { screenToFlowPosition } = useReactFlow();
    const isDarkMode = useDarkMode();
    const colorMode = isDarkMode ? "dark" : "light";

    const [nodes, setNodes, onNodesChange] = useNodesState(initialNodes);
    const [edges, setEdges, onEdgesChange] = useEdgesState(initialEdges);
    const [selectedNode, setSelectedNode] = useState(null);
    const [selectedEdge, setSelectedEdge] = useState(null);
    const [nodeLabel, setNodeLabel] = useState("");
    const [nodeDescription, setNodeDescription] = useState("");
    const [nodeConfig, setNodeConfig] = useState("");
    const [snapToGrid, setSnapToGrid] = useState(true);

    const handleNodeDelete = useCallback(
        (nodeId) => {
            setNodes((nds) => nds.filter((node) => node.id !== nodeId));
            setEdges((eds) =>
                eds.filter((edge) => edge.source !== nodeId && edge.target !== nodeId),
            );
            setSelectedNode(null);
        },
        [setNodes, setEdges],
    );

    // Update branch node outputs
    const handleUpdateOutputs = useCallback(
        (nodeId, outputs) => {
            setNodes((nds) =>
                nds.map((node) => {
                    if (node.id === nodeId) {
                        const updatedNode = {
                            ...node,
                            data: { ...node.data, outputs },
                        };
                        // Also update selectedNode if it's the same node
                        setSelectedNode((prev) => {
                            if (prev && prev.id === nodeId) {
                                return updatedNode;
                            }
                            return prev;
                        });
                        return updatedNode;
                    }
                    return node;
                }),
            );
        },
        [setNodes],
    );

    // Update join node inputs
    const handleUpdateInputs = useCallback(
        (nodeId, inputs) => {
            setNodes((nds) =>
                nds.map((node) => {
                    if (node.id === nodeId) {
                        const updatedNode = {
                            ...node,
                            data: { ...node.data, inputs },
                        };
                        // Also update selectedNode if it's the same node
                        setSelectedNode((prev) => {
                            if (prev && prev.id === nodeId) {
                                return updatedNode;
                            }
                            return prev;
                        });
                        return updatedNode;
                    }
                    return node;
                }),
            );
        },
        [setNodes],
    );

    const handleNodeTrigger = useCallback(
        async (nodeId, nodeData) => {
            setNodes((nds) => updateNodeData(nds, nodeId, { status: "loading" }));

            try {
                const nodeType = nodeData.type;

                // Handle different action node types
                switch (nodeType) {
                    case "action":
                        // Backwards compatibility: old 'action' nodes with actionType config
                        if (nodeData.config?.url) {
                            const response = await axios(buildApiConfig(nodeData.config));
                            setNodes((nds) =>
                                updateNodeData(nds, nodeId, {
                                    status: "success",
                                    lastResponse: response.data,
                                }),
                            );
                        } else {
                            throw new Error(
                                "Legacy action node - please update to new action types",
                            );
                        }
                        break;

                    case "apiAction":
                        if (nodeData.config?.url) {
                            const response = await axios(buildApiConfig(nodeData.config));
                            setNodes((nds) =>
                                updateNodeData(nds, nodeId, {
                                    status: "success",
                                    lastResponse: response.data,
                                }),
                            );
                        } else {
                            throw new Error("API Action requires a URL");
                        }
                        break;

                    case "emailAction":
                        if (nodeData.config) {
                            const {
                                template,
                                recipients = [],
                                subject,
                                customData = {},
                            } = nodeData.config;

                            // TODO: Implement actual email sending via Laravel backend
                            // For now, simulate the action
                            const emailPayload = {
                                template,
                                recipients,
                                subject,
                                data: customData,
                            };

                            const response = await axios.post(
                                "/api/workflows/actions/email",
                                emailPayload,
                            );
                            setNodes((nds) =>
                                updateNodeData(nds, nodeId, {
                                    status: "success",
                                    lastResponse: response.data,
                                }),
                            );
                        } else {
                            throw new Error("Email Action requires configuration");
                        }
                        break;

                    case "databaseAction":
                        throw new Error("Database action is not yet implemented");

                    case "scriptAction":
                        throw new Error("Script action is not yet implemented");

                    case "webhookAction":
                        throw new Error("Webhook action is not yet implemented");

                    case "condition": {
                        const { operator = "equals", valueA, valueB } = nodeData.config || {};
                        const result = evaluateCondition(operator, valueA, valueB);

                        setNodes((nds) =>
                            updateNodeData(nds, nodeId, {
                                status: "success",
                                conditionResult: result,
                                lastEvaluation: { valueA, valueB, operator, result },
                            }),
                        );
                        break;
                    }

                    default:
                        // Fallback for non-action nodes (start, constant, end)
                        await new Promise((resolve) => setTimeout(resolve, 1000));
                        setNodes((nds) => updateNodeData(nds, nodeId, { status: "success" }));
                        break;
                }
            } catch (error) {
                const errorMessage = error.response?.data || error.message;
                setNodes((nds) =>
                    updateNodeData(nds, nodeId, { status: "error", lastError: errorMessage }),
                );
                console.error("Failed to execute action:", errorMessage);
            }
        },
        [setNodes],
    );

    useEffect(() => {
        setNodes((nds) =>
            nds.map((node) => ({
                ...node,
                data: {
                    ...node.data,
                    onTrigger: handleNodeTrigger,
                    onDelete: handleNodeDelete,
                    onUpdateOutputs: handleUpdateOutputs,
                    onUpdateInputs: handleUpdateInputs,
                    status: node.data.status || "initial",
                },
            })),
        );
    }, [handleNodeTrigger, handleNodeDelete, handleUpdateOutputs, handleUpdateInputs, setNodes]);

    const onConnect = useCallback(
        (params) => {
            setEdges((eds) => {
                const oppositeConnectionIndex = eds.findIndex(
                    (edge) => edge.source === params.target && edge.target === params.source,
                );

                if (oppositeConnectionIndex !== -1) {
                    const newEdges = eds.filter((_, index) => index !== oppositeConnectionIndex);
                    return addEdge(params, newEdges);
                }

                const duplicateExists = eds.some(
                    (edge) => edge.source === params.source && edge.target === params.target,
                );

                if (duplicateExists) {
                    return eds;
                }

                // Check if the specific target handle already has a connection
                // Exception: Some nodes can accept multiple connections to specific handles
                const targetNode = nodes.find((n) => n.id === params.target);
                const isMultiInputHandle =
                    // Google Calendar and Google Docs nodes can accept multiple connections to their top-target handle
                    ((targetNode?.type === "googleCalendar" || targetNode?.type === "googleDocs") &&
                        params.targetHandle === "top-target") ||
                    // Condition nodes can accept multiple connections to their input handle
                    (targetNode?.type === "condition" && params.targetHandle === "input");

                if (!isMultiInputHandle) {
                    const targetHandleHasInput = eds.some(
                        (edge) =>
                            edge.target === params.target &&
                            edge.targetHandle === params.targetHandle,
                    );

                    if (targetHandleHasInput) {
                        alert("This input already has a connection.");
                        return eds;
                    }
                }

                return addEdge(params, eds);
            });
        },
        [setEdges, nodes],
    );

    const onDragStart = useCallback((event, nodeType) => {
        event.dataTransfer.setData("application/reactflow", nodeType);
        event.dataTransfer.effectAllowed = "move";
    }, []);

    const onDragOver = useCallback((event) => {
        event.preventDefault();
        event.dataTransfer.dropEffect = "move";
    }, []);

    const onDrop = useCallback(
        (event) => {
            event.preventDefault();

            const dataType = event.dataTransfer.getData("application/reactflow");
            if (!dataType) return;

            const position = screenToFlowPosition({
                x: event.clientX,
                y: event.clientY,
            });

            const nodeTypeInfo = nodeTypeConfig[dataType];
            const reactFlowType = getReactFlowNodeType(dataType);
            const dimensions = getNodeDimensions(dataType);

            const typeDefaults = NODE_TYPE_DEFAULTS[dataType] || {};
            const nodeData = {
                label: `${nodeTypeInfo.label} Node`,
                type: dataType,
                description: "",
                config: {},
                status: "initial",
                onTrigger: handleNodeTrigger,
                onDelete: handleNodeDelete,
                onUpdateOutputs: handleUpdateOutputs,
                onUpdateInputs: handleUpdateInputs,
                ...typeDefaults,
            };

            const newNode = {
                id: `node-${Date.now()}`,
                type: reactFlowType,
                position,
                data: nodeData,
                style: dimensions,
            };

            setNodes((nds) => [...nds, newNode]);
        },
        [
            screenToFlowPosition,
            setNodes,
            handleNodeTrigger,
            handleNodeDelete,
            handleUpdateOutputs,
            handleUpdateInputs,
        ],
    );

    const onNodeClick = useCallback((event, node) => {
        setSelectedNode(node);
        setSelectedEdge(null);
        setNodeLabel(node.data.label || "");
        setNodeDescription(node.data.description || "");
        setNodeConfig(JSON.stringify(node.data.config || {}, null, 2));
    }, []);

    const onEdgeClick = useCallback((event, edge) => {
        setSelectedEdge(edge);
        setSelectedNode(null);
    }, []);

    // Auto-update node when config changes (debounced)
    const autoUpdateTimeoutRef = useRef(null);
    useEffect(() => {
        if (!selectedNode || !nodeConfig) {
            return;
        }

        if (autoUpdateTimeoutRef.current) {
            clearTimeout(autoUpdateTimeoutRef.current);
        }

        autoUpdateTimeoutRef.current = setTimeout(() => {
            try {
                const parsedConfig = JSON.parse(nodeConfig || "{}");
                setNodes((nds) =>
                    updateNodeData(nds, selectedNode.id, {
                        label: nodeLabel,
                        description: nodeDescription,
                        config: parsedConfig,
                    }),
                );
            } catch {
                // Invalid JSON, skip auto-update
            }
        }, 300);

        return () => {
            if (autoUpdateTimeoutRef.current) {
                clearTimeout(autoUpdateTimeoutRef.current);
            }
        };
    }, [selectedNode?.id, nodeConfig, nodeLabel, nodeDescription, setNodes]);

    const updateSelectedNode = useCallback(() => {
        if (!selectedNode) {
            return;
        }

        let parsedConfig;
        try {
            parsedConfig = JSON.parse(nodeConfig || "{}");
        } catch {
            alert("Invalid JSON in configuration");
            return;
        }

        setNodes((nds) =>
            updateNodeData(nds, selectedNode.id, {
                label: nodeLabel,
                description: nodeDescription,
                config: parsedConfig,
            }),
        );
    }, [selectedNode, nodeLabel, nodeDescription, nodeConfig, setNodes]);

    const deleteSelectedNode = useCallback(() => {
        if (!selectedNode) return;

        setNodes((nds) => nds.filter((node) => node.id !== selectedNode.id));
        setEdges((eds) =>
            eds.filter(
                (edge) => edge.source !== selectedNode.id && edge.target !== selectedNode.id,
            ),
        );
        setSelectedNode(null);
    }, [selectedNode, setNodes, setEdges]);

    const deleteSelectedEdge = useCallback(() => {
        if (!selectedEdge) return;
        setEdges((eds) => eds.filter((edge) => edge.id !== selectedEdge.id));
        setSelectedEdge(null);
    }, [selectedEdge, setEdges]);

    const deleteNodeConnections = useCallback(() => {
        if (!selectedNode) return;

        setEdges((eds) =>
            eds.filter(
                (edge) => edge.source !== selectedNode.id && edge.target !== selectedNode.id,
            ),
        );
    }, [selectedNode, setEdges]);

    useEffect(() => {
        const handleKeyDown = (event) => {
            if (event.key === "Delete" || event.key === "Backspace") {
                // Don't trigger when typing in input fields
                if (event.target.tagName === "INPUT" || event.target.tagName === "TEXTAREA") {
                    return;
                }

                // Don't trigger when in contenteditable elements (e.g., TipTap/RichTextEditor)
                if (
                    event.target.isContentEditable ||
                    event.target.closest('[contenteditable="true"]')
                ) {
                    return;
                }

                // Don't trigger when a modal is open (check for modal backdrop or container)
                if (
                    document.querySelector('[data-modal-open="true"]') ||
                    event.target.closest('[data-modal-open="true"]')
                ) {
                    return;
                }

                event.preventDefault();

                // Priority: delete selected node first, then edge
                if (selectedNode) {
                    deleteSelectedNode();
                } else if (selectedEdge) {
                    deleteSelectedEdge();
                }
            }
        };

        window.addEventListener("keydown", handleKeyDown);
        return () => window.removeEventListener("keydown", handleKeyDown);
    }, [selectedNode, selectedEdge, deleteSelectedNode, deleteSelectedEdge]);

    const handleSave = useCallback(
        (onSave) => {
            const workflowData = {
                nodes: nodes.map((node) => ({
                    id: node.id,
                    type: node.data.type || "action",
                    position: node.position,
                    data: node.data,
                })),
                connections: edges.map((edge) => ({
                    id: edge.id,
                    source: edge.source,
                    target: edge.target,
                    sourceHandle: edge.sourceHandle,
                    targetHandle: edge.targetHandle,
                })),
            };
            onSave(workflowData);
        },
        [nodes, edges],
    );

    const toggleSnapToGrid = useCallback(() => {
        setSnapToGrid((prev) => !prev);
    }, []);

    const autoLayoutNodes = useCallback(async () => {
        if (nodes.length === 0) return;

        try {
            const { nodes: layoutedNodes } = await getLayoutedElements(nodes, edges, "DOWN");
            setNodes(layoutedNodes);
        } catch (error) {
            console.error("Auto-layout failed:", error);
        }
    }, [nodes, edges, setNodes]);

    return {
        nodes,
        edges,
        setNodes,
        setEdges,
        selectedNode,
        selectedEdge,
        nodeLabel,
        nodeDescription,
        nodeConfig,
        colorMode,
        snapToGrid,
        onNodesChange,
        onEdgesChange,
        onConnect,
        onDragStart,
        onDragOver,
        onDrop,
        onNodeClick,
        onEdgeClick,
        setSelectedNode,
        setSelectedEdge,
        setNodeLabel,
        setNodeDescription,
        setNodeConfig,
        updateSelectedNode,
        deleteSelectedNode,
        deleteSelectedEdge,
        deleteNodeConnections,
        handleSave,
        toggleSnapToGrid,
        autoLayoutNodes,
        handleNodeTrigger,
        handleNodeDelete,
        handleUpdateOutputs,
        handleUpdateInputs,
    };
};
