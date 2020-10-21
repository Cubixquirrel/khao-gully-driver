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

function generateDriverId($length = 7) {
    $chars = '1234567890';
    $token = '';
    while(strlen($token) < $length) {
        $token .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return $token;
}

if (
    ($_POST['driverName'] != '') && 
    ($_POST['driverAddress'] != '') && 
    ($_POST['pincode'] != '') && 
    ($_POST['emailId'] != '') && 
    ($_POST['mobileNumber'] != '') && 
    ($_POST['aadhaarCardValue'] != '') && 
    ($_POST['chequePassbookValue'] != '') && 
    ($_POST['driverPhotoValue'] != '') && 
    ($_POST['drivingLicenceValue'] != '')
) {
    $driver_name = ucwords($_POST['driverName']);
    $driver_address = ucwords($_POST['driverAddress']);
    $pincode = $_POST['pincode'];
    $email_id = strtolower($_POST['emailId']);
    $mobile_number = $_POST['mobileNumber'];
    $driver_id = generateDriverId(10);

    // $aadhaar_card = explode('/', $_POST['aadhaarCardValue']);
    $aadhaar_card_name = $_POST['aadhaarCardValue'];

    // $cheque_passbook = explode('/', $_POST['chequePassbookValue']);
    $cheque_passbook_name = $_POST['chequePassbookValue'];

    // $driver_photo = explode('/', $_POST['driverPhotoValue']);
    $driver_photo_name = $_POST['driverPhotoValue'];

    // $driving_licence = explode('/', $_POST['drivingLicenceValue']);
    $driving_licence_name = $_POST['drivingLicenceValue'];

    $sql_insert_driver = 
    '
    INSERT INTO driver (
        driver_id,
        type,
        rating,
        total_delivery,
        image,
        name,
        address,
        pincode,
        email_id,
        contact,
        aadhaar_card,
        cheque_passbook,
        driver_photo,
        driving_licence
    ) VALUES (
        "'.$driver_id.'",
        "free",
        "0",
        "0",
        "",
        "'.$driver_name.'",
        "'.$driver_address.'",
        "'.$pincode.'",
        "'.$email_id.'",
        "'.$mobile_number.'",
        "'.$aadhaar_card_name.'",
        "'.$cheque_passbook_name.'",
        "'.$driver_photo_name.'",
        "'.$driving_licence_name.'"
    )
    ';
    $result_insert_driver = $conn->query($sql_insert_driver);
    $id = $conn->insert_id;
    
    if ($result_insert_driver) {
        $user_auth = generateToken(80);
        $user_status = 'true';

        $sql_insert_status = 
        '
        INSERT INTO driver_users_login (
            user_id,
            user_auth,
            user_status
        ) VALUES (
            "'.$id.'",
            "'.$user_auth.'",
            "'.$user_status.'"
        )
        ';
        $result_insert_status = $conn->query($sql_insert_status);

        if ($result_insert_status) {
            setcookie('user_auth', $user_auth, time() + (10 * 365 * 24 *60 * 60), '/');
            setcookie('user_status', $user_status, time() + (10 * 365 * 24 *60 * 60), '/');

            echo $user_status;
        }
    }
}

?>