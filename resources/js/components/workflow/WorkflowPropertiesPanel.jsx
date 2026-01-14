import { useCallback } from "react";
import { nodeTypeConfig } from "@/constants/workflowConstants";
import StartNodeConfig from "../StartNodeConfig";
import ConstantNodeConfig from "../ConstantNodeConfig";
import ApiCallConfig from "../actions/ApiCallConfig";
import EmailActionConfig from "../actions/EmailActionConfig";
import DatabaseConfig from "../actions/DatabaseConfig";
import GoogleCalendarConfig from "../actions/GoogleCalendarConfig";
import GoogleDocsConfig from "../actions/GoogleDocsConfig";
import MergeNodeConfig from "../actions/MergeNodeConfig";
import TemplateNodeConfig from "../actions/TemplateNodeConfig";
import ConditionConfig from "../actions/ConditionConfig";
import WebhookTriggerConfig from "../actions/WebhookTriggerConfig";

const COLOR_STYLES = {
    blue: {
        container: "bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-700",
        title: "text-blue-800 dark:text-blue-400",
        description: "text-blue-600 dark:text-blue-500",
    },
    pink: {
        container: "bg-pink-50 dark:bg-pink-900/20 border-pink-200 dark:border-pink-700",
        title: "text-pink-800 dark:text-pink-400",
        description: "text-pink-600 dark:text-pink-500",
    },
    purple: {
        container: "bg-purple-50 dark:bg-purple-900/20 border-purple-200 dark:border-purple-700",
        title: "text-purple-800 dark:text-purple-400",
        description: "text-purple-600 dark:text-purple-500",
    },
    amber: {
        container: "bg-amber-50 dark:bg-amber-900/20 border-amber-200 dark:border-amber-700",
        title: "text-amber-800 dark:text-amber-400",
        description: "text-amber-600 dark:text-amber-500",
    },
    green: {
        container: "bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-700",
        title: "text-green-800 dark:text-green-400",
        description: "text-green-600 dark:text-green-500",
    },
};

const ConfigHeader = ({ color, icon, title, description }) => {
    const styles = COLOR_STYLES[color] || COLOR_STYLES.blue;
    return (
        <div className={`border rounded p-3 ${styles.container}`}>
            <h5 className={`font-semibold text-sm mb-2 ${styles.title}`}>
                {icon} {title}
            </h5>
            <p className={`text-xs ${styles.description}`}>{description}</p>
        </div>
    );
};

const ComingSoonPlaceholder = ({ color, message }) => {
    const styles = COLOR_STYLES[color] || COLOR_STYLES.blue;
    return (
        <div className={`border rounded p-3 ${styles.container}`}>
            <p className={`text-sm ${styles.title}`}>{message}</p>
        </div>
    );
};

const WorkflowPropertiesPanel = ({
    selectedNode,
    selectedEdge,
    nodeLabel,
    nodeDescription,
    nodeConfig,
    setSelectedNode,
    setSelectedEdge,
    setNodeLabel,
    setNodeDescription,
    setNodeConfig,
    updateSelectedNode,
    deleteSelectedNode,
    deleteNodeConnections,
    deleteSelectedEdge,
    teamId,
    nodes = [],
    edges = [],
    onUpdateNodeInputs,
    webhookUrl,
    webhookEnabled,
    onGenerateWebhookToken,
}) => {
    const getConnectedNodeTypes = useCallback(
        (nodeId) => {
            const outgoingEdges = edges.filter((edge) => edge.source === nodeId);
            const connectedTypes = outgoingEdges
                .map((edge) => {
                    const targetNode = nodes.find((n) => n.id === edge.target);
                    return targetNode?.data?.type || targetNode?.type;
                })
                .filter(Boolean);
            return [...new Set(connectedTypes)];
        },
        [edges, nodes],
    );

    const handleInputsChange = useCallback(
        (newInputs) => {
            if (onUpdateNodeInputs && selectedNode) {
                onUpdateNodeInputs(selectedNode.id, newInputs);
            }
        },
        [onUpdateNodeInputs, selectedNode],
    );

    const renderNodeConfig = () => {
        if (!selectedNode) return null;

        const nodeType = selectedNode.data.type;
        const parsedConfig = JSON.parse(nodeConfig || "{}");
        const configChangeHandler = (newConfig) =>
            setNodeConfig(JSON.stringify(newConfig, null, 2));
        const defaultInputs = selectedNode.data?.inputs || ["input-1", "input-2"];

        switch (nodeType) {
            case "start":
                return <StartNodeConfig config={parsedConfig} onChange={configChangeHandler} />;

            case "webhookTrigger":
                return (
                    <WebhookTriggerConfig
                        config={parsedConfig}
                        onChange={configChangeHandler}
                        webhookUrl={webhookUrl}
                        webhookEnabled={webhookEnabled}
                        onGenerateToken={onGenerateWebhookToken}
                    />
                );

            case "constant":
                return (
                    <ConstantNodeConfig
                        config={parsedConfig}
                        onChange={configChangeHandler}
                        connectedNodeTypes={getConnectedNodeTypes(selectedNode.id)}
                        nodes={nodes}
                        currentNodeId={selectedNode.id}
                    />
                );

            case "apiAction":
                return (
                    <div className="space-y-4">
                        <ConfigHeader
                            color="blue"
                            icon="🌐"
                            title="API Action Configuration"
                            description="Configure HTTP API requests to external services"
                        />
                        <ApiCallConfig
                            config={parsedConfig}
                            onChange={configChangeHandler}
                            nodeId={selectedNode.id}
                            nodes={nodes}
                            edges={edges}
                        />
                    </div>
                );

            case "emailAction":
                return (
                    <div className="space-y-4">
                        <ConfigHeader
                            color="pink"
                            icon="📧"
                            title="Email Action Configuration"
                            description="Send emails using templates from Filament admin panel"
                        />
                        <EmailActionConfig
                            config={parsedConfig}
                            onChange={configChangeHandler}
                            nodeId={selectedNode.id}
                            nodes={nodes}
                            edges={edges}
                        />
                    </div>
                );

            case "databaseAction":
                return (
                    <div className="space-y-4">
                        <ConfigHeader
                            color="purple"
                            icon="🗄️"
                            title="Database Action Configuration"
                            description="Execute database queries directly from the workflow"
                        />
                        <DatabaseConfig config={parsedConfig} onChange={configChangeHandler} />
                    </div>
                );

            case "scriptAction":
                return (
                    <div className="space-y-4">
                        <ConfigHeader
                            color="amber"
                            icon="⚡"
                            title="Script Action Configuration"
                            description="Execute custom PHP or JavaScript code"
                        />
                        <ComingSoonPlaceholder
                            color="amber"
                            message="🚧 Script execution configuration coming soon..."
                        />
                    </div>
                );

            case "webhookAction":
                return (
                    <div className="space-y-4">
                        <ConfigHeader
                            color="green"
                            icon="🔔"
                            title="Webhook Action Configuration"
                            description="Trigger external webhooks with custom payloads"
                        />
                        <ComingSoonPlaceholder
                            color="green"
                            message="🚧 Webhook configuration coming soon..."
                        />
                    </div>
                );

            case "googleCalendarAction":
                return (
                    <div className="space-y-4">
                        <ConfigHeader
                            color="blue"
                            icon="📅"
                            title="Google Calendar Configuration"
                            description="Create, update, list, or delete Google Calendar events"
                        />
                        <GoogleCalendarConfig
                            config={parsedConfig}
                            onChange={configChangeHandler}
                            teamId={teamId}
                            nodeId={selectedNode.id}
                            nodes={nodes}
                            edges={edges}
                        />
                    </div>
                );

            case "googleDocsAction":
                return (
                    <div className="space-y-4">
                        <ConfigHeader
                            color="blue"
                            icon="📄"
                            title="Google Docs Configuration"
                            description="Create, read, update, or list Google Documents"
                        />
                        <GoogleDocsConfig
                            config={parsedConfig}
                            onChange={configChangeHandler}
                            teamId={teamId}
                            nodeId={selectedNode.id}
                            nodes={nodes}
                            edges={edges}
                        />
                    </div>
                );

            case "merge":
                return (
                    <MergeNodeConfig
                        config={parsedConfig}
                        onChange={configChangeHandler}
                        inputs={defaultInputs}
                        onInputsChange={handleInputsChange}
                    />
                );

            case "template":
                return (
                    <TemplateNodeConfig
                        config={parsedConfig}
                        onChange={configChangeHandler}
                        inputs={defaultInputs}
                        onInputsChange={handleInputsChange}
                        connectedNodeTypes={getConnectedNodeTypes(selectedNode.id)}
                    />
                );

            case "condition":
                return (
                    <div className="space-y-4">
                        <ConfigHeader
                            color="amber"
                            icon=""
                            title="Condition Configuration"
                            description="Compare two inputs and route to TRUE or FALSE output"
                        />
                        <ConditionConfig
                            config={parsedConfig}
                            onChange={configChangeHandler}
                            nodeId={selectedNode.id}
                            nodes={nodes}
                            edges={edges}
                        />
                    </div>
                );

            default:
                return (
                    <div>
                        <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                            Configuration (JSON)
                        </label>
                        <textarea
                            value={nodeConfig}
                            onChange={(e) => setNodeConfig(e.target.value)}
                            className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm font-mono bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder='{"key": "value"}'
                            rows="6"
                        />
                        <p className="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Add custom properties as JSON
                        </p>
                    </div>
                );
        }
    };

    return (
        <div className="w-80 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg p-4 h-[600px] overflow-y-auto">
            {selectedNode ? (
                <div className="space-y-4">
                    <div className="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                        <h3 className="font-bold text-lg text-gray-900 dark:text-white">
                            Node Properties
                        </h3>
                        <button
                            onClick={() => setSelectedNode(null)}
                            className="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                        >
                            ✕
                        </button>
                    </div>

                    <div>
                        <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                            Type
                        </label>
                        <div className="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded text-sm text-gray-900 dark:text-white">
                            {nodeTypeConfig[selectedNode.data.type]?.label || "Unknown"}
                        </div>
                    </div>

                    <div>
                        <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                            Label
                        </label>
                        <input
                            type="text"
                            value={nodeLabel}
                            onChange={(e) => setNodeLabel(e.target.value)}
                            className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="Node label"
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                            Description
                        </label>
                        <textarea
                            value={nodeDescription}
                            onChange={(e) => setNodeDescription(e.target.value)}
                            className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="Node description"
                            rows="3"
                        />
                    </div>

                    {renderNodeConfig()}

                    <div className="flex gap-2">
                        <button
                            onClick={updateSelectedNode}
                            className="flex-1 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm"
                        >
                            Update Node
                        </button>
                        <button
                            onClick={deleteSelectedNode}
                            className="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-sm"
                        >
                            Delete
                        </button>
                    </div>

                    <div className="border-t pt-2">
                        <button
                            onClick={deleteNodeConnections}
                            className="w-full px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 text-sm"
                        >
                            Delete All Connections
                        </button>
                    </div>

                    <div className="text-xs text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-2">
                        <p>
                            <strong>Node ID:</strong> {selectedNode.id}
                        </p>
                    </div>
                </div>
            ) : selectedEdge ? (
                <div className="space-y-4">
                    <div className="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                        <h3 className="font-bold text-lg text-gray-900 dark:text-white">
                            Connection Properties
                        </h3>
                        <button
                            onClick={() => setSelectedEdge(null)}
                            className="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                        >
                            ✕
                        </button>
                    </div>

                    <div>
                        <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                            Source Node
                        </label>
                        <div className="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded text-sm font-mono text-gray-900 dark:text-white">
                            {selectedEdge.source}
                        </div>
                    </div>

                    <div>
                        <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                            Target Node
                        </label>
                        <div className="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded text-sm font-mono text-gray-900 dark:text-white">
                            {selectedEdge.target}
                        </div>
                    </div>

                    {selectedEdge.sourceHandle && (
                        <div>
                            <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                                Source Handle
                            </label>
                            <div className="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded text-sm text-gray-900 dark:text-white">
                                {selectedEdge.sourceHandle}
                            </div>
                        </div>
                    )}

                    {selectedEdge.targetHandle && (
                        <div>
                            <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                                Target Handle
                            </label>
                            <div className="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded text-sm text-gray-900 dark:text-white">
                                {selectedEdge.targetHandle}
                            </div>
                        </div>
                    )}

                    <button
                        onClick={deleteSelectedEdge}
                        className="w-full px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-sm"
                    >
                        Delete Connection
                    </button>

                    <div className="text-xs text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-2">
                        <p>
                            <strong>Connection ID:</strong> {selectedEdge.id}
                        </p>
                    </div>

                    <div className="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700 rounded p-2">
                        <p className="text-xs text-blue-800 dark:text-blue-300">
                            Click on another connection to delete it, or click on a node to edit its
                            properties.
                        </p>
                    </div>
                </div>
            ) : (
                <div className="flex items-center justify-center h-full text-gray-400 dark:text-gray-500 text-sm">
                    Click on a node or connection to edit its properties
                </div>
            )}
        </div>
    );
};

export default WorkflowPropertiesPanel;
