import React from "react";
import ReactDOM from "react-dom/client";
import DashboardTable from "./components/DashboardTable";

if (document.getElementById("dashboard-table")) {
    ReactDOM.createRoot(document.getElementById("dashboard-table")).render(
        <DashboardTable />
    );
}