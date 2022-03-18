<?php
require_once "../../settings/settings_db.php";
require_once "../functions.php";

$query_sql = query("SELECT COUNT(*) FROM request WHERE won_lost = 2");
confirm($query_sql);

$row = fetch_array($query_sql);

echo $row[0];