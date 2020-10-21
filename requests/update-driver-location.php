<?php

include_once('../config/db.php');
include_once('../classes/login-status.php');

if (($_POST['lat'] != '') && ($_POST['lng'] != '')) {
    $driver_lat = $_POST['lat'];
    $driver_lng = $_POST['lng'];
    $sql_update_driver_id = 'UPDATE driver SET driver_lat = "'.$driver_lat.'", driver_lng = "'.$driver_lng.'" WHERE id = "'.$id.'"';
    $result_update_driver_id = $conn->query($sql_update_driver_id);
}

?>