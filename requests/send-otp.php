<?php

include_once('../config/db.php');

if ((isset($_POST['mobileNumber'])) && ($_POST['mobileNumber'] != '')) {
    $mobile_number = $_POST['mobileNumber'];

    $sql_select_driver = 'SELECT * FROM driver WHERE contact = "'.$mobile_number.'"';
    $result_select_driver = $conn->query($sql_select_driver);

    if ($result_select_driver->num_rows > 0) {
        $otp = rand('100000', '999999');

        $sql_insert_otp = 'INSERT INTO otp (mobile, otp) VALUES ("'.$_POST['mobileNumber'].'", "'.$otp.'")';
        $result_insert_otp = $conn->query($sql_insert_otp);
        
        if ($result_insert_otp) {
            $post = [
                'authkey'   => '', // key
                'mobiles'   => $_POST['mobileNumber'],
                'message'   => ''.$otp.' is your Khao Gully verification code. Enjoy :-)',
                'sender'    => 'KHGULY',
                'route'     => '1',
                'country'   => '+91'
            ];

            $ch = curl_init('http://mysms.insightinfosystem.com/api/sendhttp.php');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);

            echo 'true';
        }
    } else {
        echo 'false';
    }
}

?>