import React, { useState } from "react";

const WebhookTriggerConfig = ({
    config,
    onChange,
    webhookUrl,
    webhookEnabled,
    onGenerateToken,
}) => {
    const [copied, setCopied] = useState(false);

    const handleCopy = () => {
        if (webhookUrl) {
            navigator.clipboard.writeText(webhookUrl);
            setCopied(true);
            setTimeout(() => setCopied(false), 2000);
        }
    };

    const handleOutputPathChange = (e) => {
        onChange({
            ...config,
            outputPath: e.target.value,
        });
    };

    return (
        <div className="space-y-4">
            <div className="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded p-3">
                <h5 className="font-semibold text-sm text-orange-800 dark:text-orange-400 mb-2">
                    Webhook Trigger
                </h5>
                <p className="text-xs text-orange-600 dark:text-orange-500">
                    This node is triggered when an external system sends a POST request to the
                    webhook URL. The JSON payload will be passed to connected nodes.
                </p>
            </div>

            {webhookEnabled && webhookUrl ? (
                <div className="space-y-2">
                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Webhook URL
                    </label>
                    <div className="flex gap-2">
                        <input
                            type="text"
                            value={webhookUrl}
                            readOnly
                            className="flex-1 px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded text-sm font-mono text-gray-900 dark:text-white"
                        />
                        <button
                            onClick={handleCopy}
                            className="px-3 py-2 text-sm bg-orange-500 text-white rounded hover:bg-orange-600 transition-colors"
                        >
                            {copied ? "Copied!" : "Copy"}
                        </button>
                    </div>
                    <p className="text-xs text-gray-500 dark:text-gray-400">
                        Send a POST request with JSON body to this URL to trigger the workflow.
                    </p>
                </div>
            ) : webhookEnabled && !webhookUrl ? (
                <div className="space-y-2">
                    <div className="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded p-3">
                        <p className="text-sm text-yellow-800 dark:text-yellow-400">
                            No webhook token generated yet.
                        </p>
                    </div>
                    {onGenerateToken && (
                        <button
                            onClick={onGenerateToken}
                            className="w-full px-3 py-2 text-sm bg-orange-500 text-white rounded hover:bg-orange-600 transition-colors"
                        >
                            Generate Webhook URL
                        </button>
                    )}
                </div>
            ) : (
                <div className="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded p-3">
                    <p className="text-sm text-yellow-800 dark:text-yellow-400">
                        Enable webhooks in workflow settings to generate a URL.
                    </p>
                </div>
            )}

            <div className="space-y-2">
                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Output Path (optional)
                </label>
                <input
                    type="text"
                    value={config.outputPath || ""}
                    onChange={handleOutputPathChange}
                    placeholder="e.g., data.user or leave empty for full payload"
                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                />
                <p className="text-xs text-gray-500 dark:text-gray-400">
                    Specify a dot-notation path to extract a specific field from the payload. Leave
                    empty to pass the entire JSON payload.
                </p>
            </div>

            <div className="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded p-2">
                <p className="text-xs text-blue-800 dark:text-blue-400">
                    <strong>Usage:</strong> The incoming JSON payload will be available to
                    downstream nodes. Access fields using{" "}
                    <code className="bg-blue-100 dark:bg-blue-800 px-1 rounded">
                        {"{{{input.fieldName}}}"}
                    </code>{" "}
                    syntax.
                </p>
            </div>
        </div>
    );
};

export default WebhookTriggerConfig;
