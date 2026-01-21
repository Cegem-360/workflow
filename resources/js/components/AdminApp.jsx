import React from "react";
import WorkflowList from "./admin/WorkflowList";
import WorkflowEditorView from "./admin/WorkflowEditorView";
import { useWorkflowAdmin } from "@/hooks/useWorkflowAdmin";
import { useToast } from "@/components/ui/toast";

const AdminApp = ({ workflowId = null }) => {
    const toast = useToast();
    const {
        workflows,
        selectedWorkflow,
        isCreating,
        workflowName,
        workflowDescription,
        isScheduled,
        scheduleCron,
        loading,
        teamId,
        teams,
        scheduleOptions,
        webhookEnabled,
        setWorkflowName,
        setWorkflowDescription,
        setIsScheduled,
        setScheduleCron,
        setTeamId,
        setWebhookEnabled,
        handleSaveWorkflow,
        handleEditWorkflow,
        handleDeleteWorkflow,
        handleNewWorkflow,
        handleCloseEditor,
        handleGenerateToken,
    } = useWorkflowAdmin(toast, workflowId);

    // Dashboard mode: show only the editor without admin chrome
    const isDashboardMode = !!workflowId;

    if (isDashboardMode) {
        return (
            <div className="h-full">
                {isCreating ? (
                    <WorkflowEditorView
                        selectedWorkflow={selectedWorkflow}
                        workflowName={workflowName}
                        workflowDescription={workflowDescription}
                        isScheduled={isScheduled}
                        scheduleCron={scheduleCron}
                        teamId={teamId}
                        teams={teams}
                        scheduleOptions={scheduleOptions}
                        onNameChange={setWorkflowName}
                        onDescriptionChange={setWorkflowDescription}
                        onScheduledChange={setIsScheduled}
                        onScheduleCronChange={setScheduleCron}
                        onTeamChange={setTeamId}
                        onSave={handleSaveWorkflow}
                        onClose={handleCloseEditor}
                        loading={loading}
                        webhookEnabled={webhookEnabled}
                        onWebhookEnabledChange={setWebhookEnabled}
                        onGenerateToken={handleGenerateToken}
                        dashboardMode={true}
                    />
                ) : (
                    <div className="flex items-center justify-center h-full">
                        <div className="text-center">
                            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-violet-600 mx-auto mb-4"></div>
                            <p className="text-gray-500 dark:text-gray-400">Loading workflow...</p>
                        </div>
                    </div>
                )}
            </div>
        );
    }

    // Standalone admin mode: show full admin interface
    return (
        <div className="container mx-auto p-6">
            <div className="flex justify-between items-center mb-6">
                <h1 className="text-3xl font-bold text-gray-900 dark:text-white">Workflow Admin</h1>
                <button
                    onClick={handleNewWorkflow}
                    className="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                    disabled={loading}
                >
                    New Workflow
                </button>
            </div>

            {isCreating ? (
                <WorkflowEditorView
                    selectedWorkflow={selectedWorkflow}
                    workflowName={workflowName}
                    workflowDescription={workflowDescription}
                    isScheduled={isScheduled}
                    scheduleCron={scheduleCron}
                    teamId={teamId}
                    teams={teams}
                    scheduleOptions={scheduleOptions}
                    onNameChange={setWorkflowName}
                    onDescriptionChange={setWorkflowDescription}
                    onScheduledChange={setIsScheduled}
                    onScheduleCronChange={setScheduleCron}
                    onTeamChange={setTeamId}
                    onSave={handleSaveWorkflow}
                    onClose={handleCloseEditor}
                    loading={loading}
                    webhookEnabled={webhookEnabled}
                    onWebhookEnabledChange={setWebhookEnabled}
                    onGenerateToken={handleGenerateToken}
                    dashboardMode={false}
                />
            ) : (
                <WorkflowList
                    workflows={workflows}
                    loading={loading}
                    onEdit={handleEditWorkflow}
                    onDelete={handleDeleteWorkflow}
                />
            )}
        </div>
    );
};

export default AdminApp;
