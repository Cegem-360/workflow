import CustomNode from "./CustomNode";

const WebhookTriggerNode = ({ data, selected, id }) => {
    return (
        <CustomNode
            id={id}
            data={{ ...data, label: data.label || "Webhook Trigger" }}
            selected={selected}
            nodeType="webhookTrigger"
            showInput={false}
            showOutput={true}
        />
    );
};

export default WebhookTriggerNode;
