<?php

include_once('../config/db.php');

function generateToken($length = 7) {
    $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $token = '';
    while(strlen($token) < $length) {
        $token .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return $token;
}

if (isset($_POST['driverId']) && ($_POST['driverId'] != '')) {
    $driver_id = $_POST['driverId'];

    $sql_select_driver = 'SELECT * FROM driver WHERE driver_id = "'.$driver_id.'" ORDER BY id DESC LIMIT 1';
    $result_select_driver = $conn->query($sql_select_driver);
    // echo $sql_select_driver;

    if ($result_select_driver->num_rows === 1) {
        $row_select_driver = $result_select_driver->fetch_assoc();
        $id = $row_select_driver['id'];
        $user_auth = generateToken(80);
        $user_status = 'true';

        $sql_update_status = 
        '
        UPDATE driver_users_login SET
        user_auth = "'.$user_auth.'",
        user_status = "'.$user_status.'"
        WHERE user_id = "'.$id.'"
        ';
        $result_update_status = $conn->query($sql_update_status);

        if ($result_update_status) {
            setcookie('user_auth', $user_auth, time() + (10 * 365 * 24 *60 * 60), '/');
            setcookie('user_status', $user_status, time() + (10 * 365 * 24 *60 * 60), '/');

            echo $user_status;
        }
    }
}

?>