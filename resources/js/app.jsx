import React from "react";
import { createRoot } from "react-dom/client";
import "./bootstrap";
import AdminApp from "./components/AdminApp";
import WorkflowsApp from "./components/WorkflowsApp";
import { ToastProvider } from "./components/ui/toast";

const adminContainer = document.getElementById("admin-app");
if (adminContainer) {
    const root = createRoot(adminContainer);
    root.render(
        <ToastProvider>
            <AdminApp />
        </ToastProvider>,
    );
}

const workflowsContainer = document.getElementById("workflows-app");
if (workflowsContainer) {
    const root = createRoot(workflowsContainer);
    root.render(
        <ToastProvider>
            <WorkflowsApp />
        </ToastProvider>,
    );
}
