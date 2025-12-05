import { Handle, Position, NodeResizer } from '@xyflow/react';
import { NodeStatusIndicator } from './node-status-indicator';
import { useDarkMode } from '@/hooks/useDarkMode';
import { getNodeTypeStyles } from '@/constants/nodeStyles';
import NodeTriggerButton from '@/components/node/NodeTriggerButton';

const CustomNode = ({ data, selected, id }) => {
    const nodeType = data.type || 'apiAction';
    const nodeStatus = data.status || 'initial';
    const statusVariant = data.statusVariant || 'border';
    const layoutMode = data.layoutMode || 'horizontal'; // 'horizontal' or 'vertical'
    const isDark = useDarkMode();

    const handleTrigger = (e) => {
        e.stopPropagation();
        if (data.onTrigger) {
            data.onTrigger(id, data);
        }
    };

    const typeStyles = getNodeTypeStyles(isDark);
    // Fallback to apiAction style for backwards compatibility with old 'action' nodes
    const style = typeStyles[nodeType] || typeStyles.apiAction || {
        bg: isDark ? '#1e3a8a' : '#dbeafe',
        border: '#3b82f6',
        icon: '⚙',
        textColor: isDark ? '#93c5fd' : '#1e40af'
    };

    return (
        <NodeStatusIndicator status={nodeStatus} variant={statusVariant}>
            <NodeResizer
                color={style.border}
                isVisible={selected}
                minWidth={150}
                minHeight={60}
                handleStyle={{
                    width: '12px',
                    height: '12px',
                    borderRadius: '2px',
                }}
                lineStyle={{
                    borderWidth: '2px',
                }}
            />
            <div
                style={{
                    background: style.bg,
                    border: `2px solid ${selected ? (isDark ? '#fff' : '#000') : style.border}`,
                    borderRadius: '8px',
                    padding: '12px',
                    width: '100%',
                    height: '100%',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '14px',
                    fontWeight: '500',
                    color: style.textColor,
                    position: 'relative',
                }}
            >
            {/* Top Handles - Target (Input) */}
            {nodeType !== 'constant' && (
                <Handle
                    type="target"
                    position={Position.Top}
                    id="top-target"
                    style={{
                        background: style.border,
                        width: '10px',
                        height: '10px',
                        border: `2px solid ${style.bg}`,
                        opacity: layoutMode === 'vertical' ? 1 : 0,
                        pointerEvents: layoutMode === 'vertical' ? 'auto' : 'none',
                    }}
                />
            )}

            {/* Right Handles - Source (Output) */}
            <Handle
                type="source"
                position={Position.Right}
                id="right-source"
                style={{
                    background: style.border,
                    width: '10px',
                    height: '10px',
                    border: `2px solid ${style.bg}`,
                    opacity: layoutMode === 'horizontal' ? 1 : 0,
                    pointerEvents: layoutMode === 'horizontal' ? 'auto' : 'none',
                }}
            />

            {/* Bottom Handles - Source (Output) */}
            <Handle
                type="source"
                position={Position.Bottom}
                id="bottom-source"
                style={{
                    background: style.border,
                    width: '10px',
                    height: '10px',
                    border: `2px solid ${style.bg}`,
                    opacity: layoutMode === 'vertical' ? 1 : 0,
                    pointerEvents: layoutMode === 'vertical' ? 'auto' : 'none',
                }}
            />

            {/* Left Handles - Target (Input) */}
            {nodeType !== 'constant' && (
                <Handle
                    type="target"
                    position={Position.Left}
                    id="left-target"
                    style={{
                        background: style.border,
                        width: '10px',
                        height: '10px',
                        border: `2px solid ${style.bg}`,
                        opacity: layoutMode === 'horizontal' ? 1 : 0,
                        pointerEvents: layoutMode === 'horizontal' ? 'auto' : 'none',
                    }}
                />
            )}

            {/* Trigger Button - Top Right Corner */}
            <NodeTriggerButton style={style} isDark={isDark} onTrigger={handleTrigger} />

            <div style={{ display: 'flex', alignItems: 'center', gap: '8px', width: '100%' }}>
                <span style={{ fontSize: '18px' }}>{style.icon}</span>
                <div style={{ flex: 1 }}>
                    <div style={{ fontWeight: '600' }}>{data.label}</div>
                    {data.description && (
                        <div
                            style={{
                                fontSize: '11px',
                                color: isDark ? '#9ca3af' : '#6b7280',
                                marginTop: '4px'
                            }}
                        >
                            {data.description}
                        </div>
                    )}
                </div>
            </div>
        </div>
        </NodeStatusIndicator>
    );
};

export default CustomNode;
