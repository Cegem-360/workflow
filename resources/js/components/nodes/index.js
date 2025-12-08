import ActionNode from './ActionNode';
import ConditionNode from './ConditionNode';
import ConstantNode from './ConstantNode';
import StartNode from './StartNode';
import EndNode from './EndNode';
import BranchNode from './BranchNode';
import JoinNode from './JoinNode';

export { ActionNode, ConditionNode, ConstantNode, StartNode, EndNode, BranchNode, JoinNode };

export const nodeTypes = {
    action: ActionNode,
    condition: ConditionNode,
    constant: ConstantNode,
    start: StartNode,
    end: EndNode,
    branch: BranchNode,
    join: JoinNode,
};

export default nodeTypes;
