import React from 'react';
import { MarkerType, ReactFlowProvider } from '@xyflow/react';
import WorkflowEditor from '../WorkflowEditor';
import WorkflowForm from './WorkflowForm';

const WorkflowEditorView = ({
    selectedWorkflow,
    workflowName,
    workflowDescription,
    onNameChange,
    onDescriptionChange,
    onSave,
    onClose,
    loading,
}) => {
    const initialNodes = selectedWorkflow?.nodes?.map((node) => ({
        id: node.node_id,
        type: 'custom',
        position: node.position || { x: 0, y: 0 },
        data: {
            ...node.data,
            label: node.data?.label || node.label,
            type: node.data?.type || node.type || 'action',
        },
        style: node.style || {
            width: 180,
            height: 70,
        },
    })) || [];

    const initialEdges = selectedWorkflow?.connections?.map((conn) => ({
        id: conn.connection_id,
        type: 'floating',
        source: conn.source_node_id,
        target: conn.target_node_id,
        sourceHandle: conn.source_handle,
        targetHandle: conn.target_handle,
        markerEnd: {
            type: MarkerType.ArrowClosed,
            width: 20,
            height: 20,
        },
    })) || [];

    return (
        <div className="space-y-4">
            <WorkflowForm
                workflowName={workflowName}
                workflowDescription={workflowDescription}
                selectedWorkflow={selectedWorkflow}
                onNameChange={onNameChange}
                onDescriptionChange={onDescriptionChange}
            />

            <ReactFlowProvider>
                <WorkflowEditor
                    initialNodes={initialNodes}
                    initialEdges={initialEdges}
                    onSave={onSave}
                />
            </ReactFlowProvider>

            <div className="flex gap-2">
                <button
                    onClick={onClose}
                    className="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                    disabled={loading}
                >
                    Close Editor
                </button>
                <p className="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                    Workflow will stay open after saving
                </p>
            </div>
        </div>
    );
};

export default WorkflowEditorView;
