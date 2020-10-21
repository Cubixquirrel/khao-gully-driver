<?php

include_once('../config/db.php');

if (
    ($_POST['driverId'] != '') && 
    ($_POST['status'] != '')
) {
    $driver_id = $_POST['driverId'];
    $status = $_POST['status'];

    if ($status == 'online') {
        $sql_update_driver_id = 
        '
        UPDATE driver SET driver_login_status = "" WHERE id = "'.$driver_id.'"
        ';        
    } else if ($status == 'offline') {
        $sql_update_driver_id = 
        '
        UPDATE driver SET driver_login_status = "false" WHERE id = "'.$driver_id.'"
        ';
    }
    $result_update_driver_id = $conn->query($sql_update_driver_id);
    
    if ($result_update_driver_id) {
        echo $status;
    }
}

?>