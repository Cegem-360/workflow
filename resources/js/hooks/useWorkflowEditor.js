import { useCallback, useState, useEffect } from 'react';
import { useNodesState, useEdgesState, addEdge, useReactFlow } from '@xyflow/react';
import { nodeTypeConfig } from '@/constants/workflowConstants';
import axios from 'axios';

export const useWorkflowEditor = (initialNodes = [], initialEdges = []) => {
    const { screenToFlowPosition } = useReactFlow();
    const [nodes, setNodes, onNodesChange] = useNodesState(initialNodes);
    const [edges, setEdges, onEdgesChange] = useEdgesState(initialEdges);
    const [selectedNode, setSelectedNode] = useState(null);
    const [selectedEdge, setSelectedEdge] = useState(null);
    const [nodeLabel, setNodeLabel] = useState('');
    const [nodeDescription, setNodeDescription] = useState('');
    const [nodeConfig, setNodeConfig] = useState('');
    const [colorMode, setColorMode] = useState(
        document.documentElement.classList.contains('dark') ? 'dark' : 'light'
    );
    const [snapToGrid, setSnapToGrid] = useState(true);
    const [layoutMode, setLayoutMode] = useState('horizontal'); // 'horizontal' or 'vertical'

    const handleNodeTrigger = useCallback(async (nodeId, nodeData) => {
        console.log('Node trigger event:', nodeId, nodeData);

        setNodes((nds) =>
            nds.map((node) => {
                if (node.id === nodeId) {
                    return {
                        ...node,
                        data: { ...node.data, status: 'loading' },
                    };
                }
                return node;
            })
        );

        try {
            const nodeType = nodeData.type;

            // Handle different action node types
            switch (nodeType) {
                case 'action':
                    // Backwards compatibility: old 'action' nodes with actionType config
                    console.log('[Legacy Action] Old action node detected - treating as API Action');
                    if (nodeData.config && nodeData.config.url) {
                        const { method = 'POST', url, requestBody = {}, headers = {} } = nodeData.config;

                        console.log(`[Legacy API Action] Making ${method} request to ${url}`);

                        const config = {
                            method: method.toLowerCase(),
                            url: url,
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                ...headers,
                            },
                        };

                        // Add data for POST, PUT, PATCH requests
                        if (['post', 'put', 'patch'].includes(method.toLowerCase())) {
                            config.data = requestBody;
                        }

                        const response = await axios(config);

                        setNodes((nds) =>
                            nds.map((node) => {
                                if (node.id === nodeId) {
                                    return {
                                        ...node,
                                        data: {
                                            ...node.data,
                                            status: 'success',
                                            lastResponse: response.data,
                                        },
                                    };
                                }
                                return node;
                            })
                        );
                        console.log('[Legacy API Action] Success:', response.data);
                    } else {
                        console.log('[Legacy Action] Please update this node to use new action types (API Action, Email Action, etc.)');
                        throw new Error('Legacy action node - please update to new action types');
                    }
                    break;

                case 'apiAction':
                    if (nodeData.config && nodeData.config.url) {
                        const { method = 'POST', url, requestBody = {}, headers = {} } = nodeData.config;

                        console.log(`[API Action] Making ${method} request to ${url}`);

                        const config = {
                            method: method.toLowerCase(),
                            url: url,
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                ...headers,
                            },
                        };

                        // Add data for POST, PUT, PATCH requests
                        if (['post', 'put', 'patch'].includes(method.toLowerCase())) {
                            config.data = requestBody;
                        }

                        const response = await axios(config);

                        setNodes((nds) =>
                            nds.map((node) => {
                                if (node.id === nodeId) {
                                    return {
                                        ...node,
                                        data: {
                                            ...node.data,
                                            status: 'success',
                                            lastResponse: response.data,
                                        },
                                    };
                                }
                                return node;
                            })
                        );
                        console.log('[API Action] Success:', response.data);
                    } else {
                        throw new Error('API Action requires a URL');
                    }
                    break;

                case 'emailAction':
                    if (nodeData.config) {
                        const { template, recipients = [], subject, customData = {} } = nodeData.config;

                        console.log(`[Email Action] Sending email with template: ${template}`);
                        console.log(`[Email Action] Recipients:`, recipients);

                        // TODO: Implement actual email sending via Laravel backend
                        // For now, simulate the action
                        const emailPayload = {
                            template,
                            recipients,
                            subject,
                            data: customData,
                        };

                        // Simulate API call to backend
                        const response = await axios.post('/api/workflows/actions/email', emailPayload);

                        setNodes((nds) =>
                            nds.map((node) => {
                                if (node.id === nodeId) {
                                    return {
                                        ...node,
                                        data: {
                                            ...node.data,
                                            status: 'success',
                                            lastResponse: response.data,
                                        },
                                    };
                                }
                                return node;
                            })
                        );
                        console.log('[Email Action] Success:', response.data);
                    } else {
                        throw new Error('Email Action requires configuration');
                    }
                    break;

                case 'databaseAction':
                    console.log('[Database Action] Not yet implemented');
                    throw new Error('Database action is not yet implemented');

                case 'scriptAction':
                    console.log('[Script Action] Not yet implemented');
                    throw new Error('Script action is not yet implemented');

                case 'webhookAction':
                    console.log('[Webhook Action] Not yet implemented');
                    throw new Error('Webhook action is not yet implemented');

                default:
                    // Fallback for non-action nodes (start, condition, constant, end)
                    console.log(`[${nodeType}] Node triggered (no action logic)`);
                    await new Promise((resolve) => setTimeout(resolve, 1000));
                    setNodes((nds) =>
                        nds.map((node) => {
                            if (node.id === nodeId) {
                                return {
                                    ...node,
                                    data: { ...node.data, status: 'success' },
                                };
                            }
                            return node;
                        })
                    );
                    break;
            }
        } catch (error) {
            setNodes((nds) =>
                nds.map((node) => {
                    if (node.id === nodeId) {
                        return {
                            ...node,
                            data: {
                                ...node.data,
                                status: 'error',
                                lastError: error.response?.data || error.message,
                            },
                        };
                    }
                    return node;
                })
            );
            console.error('Failed to execute action:', error.response?.data || error.message);
        }
    }, [setNodes]);

    useEffect(() => {
        setNodes((nds) =>
            nds.map((node) => ({
                ...node,
                data: {
                    ...node.data,
                    onTrigger: handleNodeTrigger,
                    status: node.data.status || 'initial',
                    layoutMode: layoutMode,
                },
            }))
        );
    }, [handleNodeTrigger, layoutMode, setNodes]);

    useEffect(() => {
        const observer = new MutationObserver(() => {
            const isDark = document.documentElement.classList.contains('dark');
            setColorMode(isDark ? 'dark' : 'light');
        });

        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class'],
        });

        return () => observer.disconnect();
    }, []);

    const onConnect = useCallback(
        (params) => {
            console.log('=== New Connection ===');
            console.log('Source Node:', params.source, '| Handle:', params.sourceHandle);
            console.log('Target Node:', params.target, '| Handle:', params.targetHandle);

            setEdges((eds) => {
                const oppositeConnectionIndex = eds.findIndex(edge =>
                    edge.source === params.target && edge.target === params.source
                );

                if (oppositeConnectionIndex !== -1) {
                    console.log('Reversing existing connection direction');
                    const newEdges = eds.filter((_, index) => index !== oppositeConnectionIndex);
                    return addEdge(params, newEdges);
                }

                const duplicateExists = eds.some(edge =>
                    edge.source === params.source && edge.target === params.target
                );

                if (duplicateExists) {
                    console.log('Duplicate connection - ignoring');
                    return eds;
                }

                const targetHasInput = eds.some(edge => edge.target === params.target);

                if (targetHasInput) {
                    console.log('Target node already has an incoming connection');
                    alert('This node already has an incoming connection. Each node can only have one input.');
                    return eds;
                }

                return addEdge(params, eds);
            });
        },
        [setEdges]
    );

    const onDragStart = useCallback((event, nodeType) => {
        event.dataTransfer.setData('application/reactflow', nodeType);
        event.dataTransfer.effectAllowed = 'move';
    }, []);

    const onDragOver = useCallback((event) => {
        event.preventDefault();
        event.dataTransfer.dropEffect = 'move';
    }, []);

    const onDrop = useCallback((event) => {
        event.preventDefault();

        const nodeType = event.dataTransfer.getData('application/reactflow');
        if (!nodeType) return;

        const position = screenToFlowPosition({
            x: event.clientX,
            y: event.clientY,
        });

        const nodeTypeInfo = nodeTypeConfig[nodeType];
        const newNode = {
            id: `node-${Date.now()}`,
            type: 'custom',
            position,
            data: {
                label: `${nodeTypeInfo.label} Node`,
                type: nodeType,
                description: '',
                config: {},
                status: 'initial',
                onTrigger: handleNodeTrigger,
                layoutMode: layoutMode,
            },
            style: {
                width: 180,
                height: 70,
            },
        };

        setNodes((nds) => [...nds, newNode]);
    }, [screenToFlowPosition, setNodes, handleNodeTrigger]);

    const onNodeClick = useCallback((event, node) => {
        setSelectedNode(node);
        setSelectedEdge(null);
        setNodeLabel(node.data.label || '');
        setNodeDescription(node.data.description || '');
        setNodeConfig(JSON.stringify(node.data.config || {}, null, 2));
    }, []);

    const onEdgeClick = useCallback((event, edge) => {
        setSelectedEdge(edge);
        setSelectedNode(null);
    }, []);

    const updateSelectedNode = useCallback(() => {
        if (!selectedNode) return;

        let parsedConfig = {};
        try {
            parsedConfig = JSON.parse(nodeConfig || '{}');
        } catch (e) {
            alert('Invalid JSON in configuration');
            return;
        }

        setNodes((nds) =>
            nds.map((node) => {
                if (node.id === selectedNode.id) {
                    return {
                        ...node,
                        data: {
                            ...node.data,
                            label: nodeLabel,
                            description: nodeDescription,
                            config: parsedConfig,
                        },
                    };
                }
                return node;
            })
        );
    }, [selectedNode, nodeLabel, nodeDescription, nodeConfig, setNodes]);

    const deleteSelectedNode = useCallback(() => {
        if (!selectedNode) return;
        if (!confirm('Are you sure you want to delete this node?')) return;

        setNodes((nds) => nds.filter((node) => node.id !== selectedNode.id));
        setEdges((eds) =>
            eds.filter(
                (edge) =>
                    edge.source !== selectedNode.id && edge.target !== selectedNode.id
            )
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
        if (!confirm('Delete all connections for this node?')) return;

        setEdges((eds) =>
            eds.filter(
                (edge) =>
                    edge.source !== selectedNode.id && edge.target !== selectedNode.id
            )
        );
    }, [selectedNode, setEdges]);

    useEffect(() => {
        const handleKeyDown = (event) => {
            if (event.key === 'Delete' || event.key === 'Backspace') {
                if (selectedEdge &&
                    event.target.tagName !== 'INPUT' &&
                    event.target.tagName !== 'TEXTAREA') {
                    event.preventDefault();
                    deleteSelectedEdge();
                }
            }
        };

        window.addEventListener('keydown', handleKeyDown);
        return () => window.removeEventListener('keydown', handleKeyDown);
    }, [selectedEdge, deleteSelectedEdge]);

    const handleSave = useCallback((onSave) => {
        const workflowData = {
            nodes: nodes.map((node) => ({
                id: node.id,
                type: node.data.type || 'action',
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
    }, [nodes, edges]);

    const toggleSnapToGrid = useCallback(() => {
        setSnapToGrid((prev) => !prev);
    }, []);

    const autoLayoutNodes = useCallback((currentLayoutMode) => {
        setNodes((nds) => {
            if (nds.length === 0) return nds;

            // Build adjacency map from edges
            const outgoing = new Map();
            const incoming = new Map();

            edges.forEach(edge => {
                if (!outgoing.has(edge.source)) outgoing.set(edge.source, []);
                if (!incoming.has(edge.target)) incoming.set(edge.target, []);
                outgoing.get(edge.source).push(edge.target);
                incoming.get(edge.target).push(edge.source);
            });

            // Find root nodes (no incoming edges)
            const roots = nds.filter(node => !incoming.has(node.id));

            // If no roots found, use all nodes as potential starts
            const startNodes = roots.length > 0 ? roots : nds;

            // BFS to assign levels
            const levels = new Map();
            const visited = new Set();
            const queue = startNodes.map(node => ({ id: node.id, level: 0 }));

            while (queue.length > 0) {
                const { id, level } = queue.shift();
                if (visited.has(id)) continue;

                visited.add(id);
                levels.set(id, level);

                const children = outgoing.get(id) || [];
                children.forEach(childId => {
                    if (!visited.has(childId)) {
                        queue.push({ id: childId, level: level + 1 });
                    }
                });
            }

            // Assign unvisited nodes to level 0
            nds.forEach(node => {
                if (!levels.has(node.id)) {
                    levels.set(node.id, 0);
                }
            });

            // Group nodes by level
            const nodesByLevel = new Map();
            nds.forEach(node => {
                const level = levels.get(node.id);
                if (!nodesByLevel.has(level)) {
                    nodesByLevel.set(level, []);
                }
                nodesByLevel.get(level).push(node);
            });

            // Layout constants
            const NODE_SPACING = 200;
            const LEVEL_SPACING = 250;

            // Position nodes based on layout mode
            return nds.map(node => {
                const level = levels.get(node.id);
                const nodesInLevel = nodesByLevel.get(level);
                const indexInLevel = nodesInLevel.findIndex(n => n.id === node.id);

                let x, y;
                if (currentLayoutMode === 'horizontal') {
                    // Horizontal: levels go left to right
                    x = level * LEVEL_SPACING;
                    y = indexInLevel * NODE_SPACING;
                } else {
                    // Vertical: levels go top to bottom
                    x = indexInLevel * NODE_SPACING;
                    y = level * LEVEL_SPACING;
                }

                return {
                    ...node,
                    position: { x, y }
                };
            });
        });
    }, [edges, setNodes]);

    const toggleLayoutMode = useCallback(() => {
        setLayoutMode((prev) => {
            const newMode = prev === 'horizontal' ? 'vertical' : 'horizontal';
            // Auto-layout nodes when switching modes
            setTimeout(() => autoLayoutNodes(newMode), 0);
            return newMode;
        });
    }, [autoLayoutNodes]);

    return {
        nodes,
        edges,
        selectedNode,
        selectedEdge,
        nodeLabel,
        nodeDescription,
        nodeConfig,
        colorMode,
        snapToGrid,
        layoutMode,
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
        toggleLayoutMode,
    };
};
