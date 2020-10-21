<?php

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_driver_user = 'SELECT user_id FROM driver_users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'"';
    $result_select_driver_user = $conn->query($sql_select_driver_user);
    
    if ($result_select_driver_user->num_rows === 1) {
        $row_select_driver_user = $result_select_driver_user->fetch_assoc();

        $sql_select_data = 'SELECT * FROM driver WHERE id = "'.$row_select_driver_user["user_id"].'"';
        $result_select_data = $conn->query($sql_select_data);
        $row_select_data = $result_select_data->fetch_assoc();

        if ($row_select_data['driver_status'] == '') {
            header ('location: ../views/dashboard-pending.php');    
        } else {
            $id           = $row_select_data['id'];
            $driver_id    = $row_select_data['driver_id'];
            $driver_name  = $row_select_data['name'];
        }
    } else {
        header ('location: ../views/login.php');
    } 
} else {
    header ('location: ../views/login.php');
}

?>