<?php
require_once "../../settings/settings_db.php";

$query = "SELECT DISTINCT `Routing identifier` FROM items";
$result = mysqli_query($connection,$query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<option  value="' . $row['0'] . '"></option>';
    }
} else {
    echo '<option value="">Item Number invalid</option>';
}
