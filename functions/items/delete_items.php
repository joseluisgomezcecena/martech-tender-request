<?php
require_once "../../settings/settings_db.php";
require_once "../functions.php";
$location = 'http://localhost/tender_request/index.php?page=tender_request_form#step_2';

if (isset($_GET['id'])) {
    $query = query("DELETE FROM item WHERE item_id = " . scape_string($_GET['id']) . "");
    confirm($query);

    redirect($location);
} else {
    redirect($location);
}
