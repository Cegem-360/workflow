import React, { useState, useEffect, useMemo, useRef } from "react";
import { OUTPUT_NODE_TYPES, getNodeTypeLabel } from "../../constants/nodeTypes";

// Target field labels for email
const TARGET_FIELD_LABELS = {
    subject: "Subject",
    recipients: "Recipients",
    customData: "Custom Data",
};

// Simple Dynamic Field Component for Email Action
const DynamicField = ({
    label,
    value,
    onChange,
    type = "text",
    placeholder,
    isDynamic,
    onDynamicChange,
    availableInputs = [],
    rows,
}) => {
    const hasMatchingInput = availableInputs.length > 0;

    // Insert placeholder at cursor position or replace value
    const insertPlaceholder = (placeholder) => {
        onChange(placeholder);
    };

    return (
        <div className="space-y-1">
            <div className="flex items-center justify-between">
                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {label}
                    {hasMatchingInput && !isDynamic && (
                        <span
                            className="ml-1 text-xs text-green-600 dark:text-green-400"
                            title="Connected input available"
                        >
                            (input available)
                        </span>
                    )}
                </label>
                {hasMatchingInput && (
                    <button
                        type="button"
                        onClick={() => onDynamicChange(!isDynamic)}
                        className={`text-xs px-2 py-0.5 rounded transition-colors ${
                            isDynamic
                                ? "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400"
                                : "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400"
                        }`}
                    >
                        {isDynamic ? "Dynamic" : "Static"}
                    </button>
                )}
            </div>

            {isDynamic && hasMatchingInput ? (
                <div className="space-y-2">
                    {/* Source selector chips */}
                    <div className="flex flex-wrap gap-1.5">
                        {availableInputs.map((input) => (
                            <button
                                key={input.nodeId}
                                type="button"
                                onClick={() =>
                                    insertPlaceholder(
                                        input.isActionOutput
                                            ? "{{{input}}}"
                                            : `{{{input.${input.targetField}}}}`,
                                    )
                                }
                                className="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs rounded-lg border transition-all bg-purple-50 border-purple-200 text-purple-700 hover:bg-purple-100 dark:bg-purple-900/20 dark:border-purple-700 dark:text-purple-400"
                            >
                                <svg
                                    className="w-3.5 h-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"
                                    />
                                </svg>
                                <span className="font-medium">{input.nodeLabel}</span>
                            </button>
                        ))}
                    </div>

                    {/* Current value display */}
                    <div className="p-2 bg-purple-50 dark:bg-purple-900/20 rounded border border-purple-200 dark:border-purple-700">
                        <p className="text-xs text-purple-600 dark:text-purple-400 mb-1">
                            Current value:
                        </p>
                        <code className="text-sm font-mono text-purple-800 dark:text-purple-300 break-all">
                            {value || "(not set)"}
                        </code>
                    </div>

                    {/* Manual input for complex expressions */}
                    {type === "textarea" ? (
                        <textarea
                            value={value}
                            onChange={(e) => onChange(e.target.value)}
                            rows={rows || 3}
                            className="w-full px-3 py-2 border border-purple-300 dark:border-purple-600 rounded text-sm font-mono bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder={placeholder}
                        />
                    ) : (
                        <input
                            type="text"
                            value={value}
                            onChange={(e) => onChange(e.target.value)}
                            className="w-full px-3 py-2 border border-purple-300 dark:border-purple-600 rounded text-sm font-mono bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder={placeholder}
                        />
                    )}
                </div>
            ) : type === "textarea" ? (
                <textarea
                    value={value}
                    onChange={(e) => onChange(e.target.value)}
                    rows={rows || 3}
                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder={placeholder}
                />
            ) : (
                <input
                    type="text"
                    value={value}
                    onChange={(e) => onChange(e.target.value)}
                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder={placeholder}
                />
            )}
        </div>
    );
};

const EmailActionConfig = ({ config, onChange, nodeId, nodes = [], edges = [] }) => {
    // State declarations
    const [template, setTemplate] = useState(config.template || "");
    const [recipients, setRecipients] = useState(
        config.recipients ? config.recipients.join(", ") : "",
    );
    const [subject, setSubject] = useState(config.subject || "");
    const [customData, setCustomData] = useState(
        config.customData ? JSON.stringify(config.customData, null, 2) : "{}",
    );
    const [templates, setTemplates] = useState([]);
    const [loadingTemplates, setLoadingTemplates] = useState(true);
    const [selectedTemplateVariables, setSelectedTemplateVariables] = useState(null);
    const [dynamicFields, setDynamicFields] = useState(config.dynamicFields || {});

    // Track initialization to prevent re-syncing when editing
    const isInitializedRef = useRef(false);
    const prevNodeIdRef = useRef(nodeId);
    const prevConfigRef = useRef(null);

    // Toggle dynamic state for a field
    const toggleDynamic = (fieldName, isDynamic) => {
        setDynamicFields((prev) => ({ ...prev, [fieldName]: isDynamic }));
    };

    // Find connected nodes that can provide input
    const availableInputs = useMemo(() => {
        if (!nodeId || !edges.length || !nodes.length) return [];

        const incomingEdges = edges.filter((edge) => edge.target === nodeId);
        const inputs = [];

        incomingEdges.forEach((edge) => {
            const sourceNode = nodes.find((n) => n.id === edge.source);
            if (!sourceNode) return;

            const nodeType = sourceNode.data?.type;
            const nodeConfig = sourceNode.data?.config || {};

            // Handle Constant nodes with targetField
            if (nodeType === "constant") {
                const targetField = nodeConfig.targetField;
                if (targetField) {
                    inputs.push({
                        nodeId: sourceNode.id,
                        nodeLabel: sourceNode.data?.label || "Constant",
                        nodeType: "constant",
                        targetField,
                        targetFieldLabel: TARGET_FIELD_LABELS[targetField] || targetField,
                    });
                }
            }

            // Handle action nodes that produce output (API, Calendar, etc.)
            if (OUTPUT_NODE_TYPES.includes(nodeType)) {
                inputs.push({
                    nodeId: sourceNode.id,
                    nodeLabel: sourceNode.data?.label || getNodeTypeLabel(nodeType),
                    nodeType,
                    targetField: "input",
                    targetFieldLabel: getNodeTypeLabel(nodeType),
                    isActionOutput: true,
                });
            }

            // Handle webhookTrigger nodes
            if (nodeType === "webhookTrigger") {
                inputs.push({
                    nodeId: sourceNode.id,
                    nodeLabel: sourceNode.data?.label || "Webhook Trigger",
                    nodeType: "webhookTrigger",
                    targetField: "input",
                    targetFieldLabel: "Webhook Payload",
                    isActionOutput: true,
                });
            }
        });

        return inputs;
    }, [nodeId, nodes, edges]);

    // Sync local state with config prop - only on initial mount or when switching to a different node
    useEffect(() => {
        if (isInitializedRef.current && prevNodeIdRef.current === nodeId) {
            return;
        }

        isInitializedRef.current = true;
        prevNodeIdRef.current = nodeId;

        setTemplate(config.template || "");
        setRecipients(config.recipients ? config.recipients.join(", ") : "");
        setSubject(config.subject || "");
        setCustomData(config.customData ? JSON.stringify(config.customData, null, 2) : "{}");
        setDynamicFields(config.dynamicFields || {});
    }, [config, nodeId]);

    useEffect(() => {
        const fetchTemplates = async () => {
            try {
                setLoadingTemplates(true);
                const response = await fetch("/api/email-templates");
                if (response.ok) {
                    const data = await response.json();
                    setTemplates(data);
                }
            } catch (error) {
                console.error("Failed to fetch email templates:", error);
            } finally {
                setLoadingTemplates(false);
            }
        };

        fetchTemplates();
    }, []);

    // Update selected template variables when template changes
    useEffect(() => {
        const selectedTemplate = templates.find((t) => t.slug === template);
        setSelectedTemplateVariables(selectedTemplate?.variables || null);

        // Auto-fill subject from template if not already set
        if (selectedTemplate && !subject) {
            setSubject(selectedTemplate.subject);
        }
    }, [template, templates, subject]);

    // Propagate changes to parent component
    useEffect(() => {
        try {
            const recipientsList = recipients
                .split(",")
                .map((email) => email.trim())
                .filter((email) => email.length > 0);

            const parsedCustomData = JSON.parse(customData);

            const newConfig = {
                template,
                recipients: recipientsList,
                subject,
                customData: parsedCustomData,
                dynamicFields,
            };

            // Only call onChange if config actually changed
            const prevConfig = prevConfigRef.current;
            if (prevConfig && JSON.stringify(prevConfig) === JSON.stringify(newConfig)) {
                return;
            }

            prevConfigRef.current = newConfig;
            onChange(newConfig);
        } catch {
            // Invalid JSON, don't update
        }
    }, [template, recipients, subject, customData, dynamicFields, onChange]);

    return (
        <div className="space-y-3">
            <div>
                <label className="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
                    Email Template
                </label>
                <select
                    value={template}
                    onChange={(e) => setTemplate(e.target.value)}
                    disabled={loadingTemplates}
                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white disabled:opacity-50"
                >
                    <option value="">
                        {loadingTemplates ? "Loading templates..." : "Select template..."}
                    </option>
                    {templates.map((t) => (
                        <option key={t.id} value={t.slug}>
                            {t.name}
                        </option>
                    ))}
                </select>
                <p className="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Email templates are managed in Filament admin panel
                </p>
                {selectedTemplateVariables && Object.keys(selectedTemplateVariables).length > 0 && (
                    <div className="mt-2 p-2 bg-blue-50 dark:bg-blue-900/30 rounded border border-blue-200 dark:border-blue-700">
                        <p className="text-xs font-medium text-blue-700 dark:text-blue-300 mb-1">
                            Template variables:
                        </p>
                        <div className="flex flex-wrap gap-1">
                            {Object.keys(selectedTemplateVariables).map((varName) => (
                                <span
                                    key={varName}
                                    className="px-1.5 py-0.5 bg-blue-100 dark:bg-blue-800 text-blue-700 dark:text-blue-300 rounded text-xs font-mono"
                                >
                                    {`{{${varName}}}`}
                                </span>
                            ))}
                        </div>
                    </div>
                )}
            </div>

            <DynamicField
                label="Email Subject"
                value={subject}
                onChange={setSubject}
                placeholder="Email subject line"
                isDynamic={dynamicFields.subject}
                onDynamicChange={(isDynamic) => toggleDynamic("subject", isDynamic)}
                availableInputs={availableInputs}
            />

            <DynamicField
                label="Recipients (comma-separated)"
                value={recipients}
                onChange={setRecipients}
                type="textarea"
                rows={3}
                placeholder="user@example.com, admin@example.com"
                isDynamic={dynamicFields.recipients}
                onDynamicChange={(isDynamic) => toggleDynamic("recipients", isDynamic)}
                availableInputs={availableInputs}
            />

            <DynamicField
                label="Custom Data (JSON)"
                value={customData}
                onChange={setCustomData}
                type="textarea"
                rows={4}
                placeholder='{"userName": "John", "orderNumber": "12345"}'
                isDynamic={dynamicFields.customData}
                onDynamicChange={(isDynamic) => toggleDynamic("customData", isDynamic)}
                availableInputs={availableInputs}
            />

            <div className="bg-white dark:bg-gray-800 p-3 rounded border border-pink-300 dark:border-pink-600">
                <p className="text-xs font-medium text-pink-900 dark:text-pink-300 mb-1">
                    Email Preview:
                </p>
                <p className="text-sm text-pink-800 dark:text-pink-400 break-all">
                    <strong>Template:</strong>{" "}
                    {template
                        ? templates.find((t) => t.slug === template)?.name || template
                        : "(not selected)"}
                </p>
                <p className="text-sm text-pink-800 dark:text-pink-400 break-all">
                    <strong>Subject:</strong> {subject || "(no subject)"}
                </p>
                <p className="text-sm text-pink-800 dark:text-pink-400 break-all">
                    <strong>Recipients:</strong> {recipients || "(no recipients)"}
                </p>
            </div>
        </div>
    );
};

export default EmailActionConfig;
