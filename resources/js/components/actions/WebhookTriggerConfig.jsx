import React, { useState } from "react";

const WebhookTriggerConfig = ({
    config,
    onChange,
    webhookUrl,
    webhookEnabled,
    onGenerateToken,
}) => {
    const [copied, setCopied] = useState(false);
    const [showTest, setShowTest] = useState(false);
    const [testPayload, setTestPayload] = useState(
        '{\n  "event": "test",\n  "data": {\n    "message": "Test payload"\n  }\n}',
    );
    const [testResult, setTestResult] = useState(null);
    const [isTesting, setIsTesting] = useState(false);

    const handleTest = async () => {
        if (!webhookUrl) return;

        setIsTesting(true);
        setTestResult(null);

        try {
            // Parse JSON to validate it
            const payload = JSON.parse(testPayload);

            const response = await fetch(webhookUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json();

            setTestResult({
                success: response.ok,
                status: response.status,
                data: data,
            });
        } catch (error) {
            setTestResult({
                success: false,
                error: error.message,
            });
        } finally {
            setIsTesting(false);
        }
    };

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

    const renderWebhookStatus = () => {
        if (webhookEnabled && webhookUrl) {
            return (
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
            );
        }

        if (webhookEnabled) {
            return (
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
            );
        }

        return (
            <div className="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded p-3">
                <p className="text-sm text-yellow-800 dark:text-yellow-400">
                    Enable webhooks in workflow settings to generate a URL.
                </p>
            </div>
        );
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

            {renderWebhookStatus()}

            {/* Test Section */}
            {webhookEnabled && webhookUrl && (
                <div className="border border-gray-200 dark:border-gray-700 rounded overflow-hidden">
                    <button
                        onClick={() => setShowTest(!showTest)}
                        className="w-full flex items-center justify-between px-3 py-2 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    >
                        <span className="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-2">
                            <svg
                                className="w-4 h-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                            >
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                            </svg>
                            Webhook tesztelése
                        </span>
                        <svg
                            className={`w-4 h-4 text-gray-500 transition-transform ${showTest ? "rotate-180" : ""}`}
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                        >
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>

                    {showTest && (
                        <div className="p-3 space-y-3">
                            <div className="space-y-1">
                                <label className="block text-xs font-medium text-gray-600 dark:text-gray-400">
                                    Test Payload (JSON)
                                </label>
                                <textarea
                                    value={testPayload}
                                    onChange={(e) => setTestPayload(e.target.value)}
                                    rows={6}
                                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm font-mono bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                    placeholder='{"event": "test", "data": {}}'
                                />
                            </div>

                            <button
                                onClick={handleTest}
                                disabled={isTesting}
                                className="w-full px-3 py-2 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                            >
                                {isTesting ? (
                                    <>
                                        <svg
                                            className="w-4 h-4 animate-spin"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            strokeWidth="2"
                                        >
                                            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                                        </svg>
                                        Küldés...
                                    </>
                                ) : (
                                    <>
                                        <svg
                                            className="w-4 h-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            strokeWidth="2"
                                        >
                                            <line x1="22" y1="2" x2="11" y2="13" />
                                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                        </svg>
                                        Test küldése
                                    </>
                                )}
                            </button>

                            {testResult && (
                                <div
                                    className={`p-3 rounded text-sm ${
                                        testResult.success
                                            ? "bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700"
                                            : "bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700"
                                    }`}
                                >
                                    <div className="flex items-center gap-2 mb-2">
                                        {testResult.success ? (
                                            <>
                                                <svg
                                                    className="w-4 h-4 text-green-600 dark:text-green-400"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    strokeWidth="2"
                                                >
                                                    <path d="M20 6L9 17l-5-5" />
                                                </svg>
                                                <span className="font-medium text-green-800 dark:text-green-300">
                                                    Sikeres! (HTTP {testResult.status})
                                                </span>
                                            </>
                                        ) : (
                                            <>
                                                <svg
                                                    className="w-4 h-4 text-red-600 dark:text-red-400"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    strokeWidth="2"
                                                >
                                                    <circle cx="12" cy="12" r="10" />
                                                    <line x1="15" y1="9" x2="9" y2="15" />
                                                    <line x1="9" y1="9" x2="15" y2="15" />
                                                </svg>
                                                <span className="font-medium text-red-800 dark:text-red-300">
                                                    Hiba
                                                    {testResult.status
                                                        ? ` (HTTP ${testResult.status})`
                                                        : ""}
                                                </span>
                                            </>
                                        )}
                                    </div>
                                    <pre className="text-xs overflow-auto max-h-32 p-2 bg-white/50 dark:bg-black/20 rounded">
                                        {testResult.error ||
                                            JSON.stringify(testResult.data, null, 2)}
                                    </pre>
                                </div>
                            )}
                        </div>
                    )}
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
