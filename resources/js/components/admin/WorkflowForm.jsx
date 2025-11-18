import React from 'react';

const WorkflowForm = ({
    workflowName,
    workflowDescription,
    selectedWorkflow,
    onNameChange,
    onDescriptionChange,
}) => {
    return (
        <div className="bg-white dark:bg-gray-800 p-4 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <h2 className="text-xl font-bold mb-4 text-gray-900 dark:text-white">
                {selectedWorkflow ? 'Edit Workflow' : 'Create New Workflow'}
            </h2>
            <div className="space-y-3">
                <div>
                    <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                        Name
                    </label>
                    <input
                        type="text"
                        value={workflowName}
                        onChange={(e) => onNameChange(e.target.value)}
                        className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        placeholder="Workflow name"
                    />
                </div>
                <div>
                    <label className="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">
                        Description
                    </label>
                    <textarea
                        value={workflowDescription}
                        onChange={(e) => onDescriptionChange(e.target.value)}
                        className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        placeholder="Workflow description"
                        rows="3"
                    />
                </div>
            </div>
        </div>
    );
};

export default WorkflowForm;
