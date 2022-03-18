<?php
require_once("src/includes/header.php");
include_once("src/includes/topbar.php");
include_once("src/includes/sidebar.php");
//include_once("views/dashboard/dashboard.php");
$dashboard = 'dashboard';

if (!empty($page)) {

    switch ($page) {
        case "tender_request_form":
            include("src/views/tender_request/wizard/tender_request_form.php");
            break;

        case "tender_request_table":
            include("src/views/tender_request/tender_request_table.php");
            break;

        case "delete_item":
            include("functions/items/delete_items.php");
            break;

        case "report_lost_won":
            include("src/views/reports/lost_won_report.php");
            break;

        case "request_detail":
            include("src/views/reports/request_detail.php");
            break;
    
        default:
            include("src/views/dashboard/dashboard.php");
            break;
    }

} else {
    include("src/views/dashboard/dashboard.php");
}


include_once("src/includes/footer.php");
?>
