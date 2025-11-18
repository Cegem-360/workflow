import React, { useState } from 'react';
import { getActionTypesList, getActionTypeById } from '@/constants/actionTypes';
import ApiCallConfig from '@/components/actions/ApiCallConfig';
import DatabaseConfig from '@/components/actions/DatabaseConfig';

// Map action types to their config components
const actionConfigComponents = {
    apiCall: ApiCallConfig,
    database: DatabaseConfig,
    // Add more action type components here as they are implemented
};

const ActionNodeConfig = ({ config, onChange }) => {
    const [actionType, setActionType] = useState(config.actionType || 'apiCall');
    const actionTypesList = getActionTypesList();
    const currentActionType = getActionTypeById(actionType);

    const handleActionTypeChange = (newType) => {
        setActionType(newType);
        onChange({
            actionType: newType,
            // Reset config when changing action type
            ...{},
        });
    };

    const handleActionConfigChange = (actionConfig) => {
        onChange({
            actionType,
            ...actionConfig,
        });
    };

    // Get the appropriate config component for the selected action type
    const ActionConfigComponent = actionConfigComponents[actionType] || ApiCallConfig;

    return (
        <div className="space-y-4">
            <div className="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded p-3">
                <h5 className="font-semibold text-sm text-blue-800 dark:text-blue-400 mb-2">
                    Action Configuration
                </h5>
                <p className="text-xs text-blue-600 dark:text-blue-500">
                    Configure what this action node will do
                </p>
            </div>

            <div>
                <label className="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
                    Action Type
                </label>
                <select
                    value={actionType}
                    onChange={(e) => handleActionTypeChange(e.target.value)}
                    className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                >
                    {actionTypesList.map((type) => (
                        <option key={type.id} value={type.id}>
                            {type.icon} {type.label}
                        </option>
                    ))}
                </select>
                <p className="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    {currentActionType.description}
                </p>
            </div>

            <div className="border-t border-gray-200 dark:border-gray-700 pt-3">
                <ActionConfigComponent
                    config={config}
                    onChange={handleActionConfigChange}
                />
            </div>

            <div className="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded p-2">
                <p className="text-xs text-yellow-800 dark:text-yellow-400">
                    <strong>💡 Tip:</strong> Use the trigger button (▶) on the node to test this action.
                    The node will show loading, success, or error states.
                </p>
            </div>
        </div>
    );
};

export default ActionNodeConfig;
