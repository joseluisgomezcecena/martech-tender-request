<?php
require_once "../../settings/settings_db.php";
require_once "../../functions/functions.php";

$query = "SELECT COUNT(won_lost) as perdidas, (SELECT COUNT(won_lost) as ganancias FROM request WHERE won_lost = 1) as ganancias  FROM request WHERE won_lost = 2 ";
$result = mysqli_query($connection, $query);

$data = array();
foreach($result as $row) {
    $data[0]['ganancias'] = $row["ganancias"];
    $data[1]['perdidas'] = $row["perdidas"];
}
echo json_encode($data);
?>
