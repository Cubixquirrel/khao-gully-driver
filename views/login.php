<?php

include_once('../config/db.php');

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_user = 
    '
    SELECT user_id FROM driver_users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'" 
    ';
    $result_select_user = $conn->query($sql_select_user);
    
    if ($result_select_user->num_rows === 1) {
        header ('location: ../views/dashboard.php');
    }
}

$page_title = 'Login';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="head">
        <div class="logo">
            <img src="../assets/image/logo.png" width="140" class="logo-image">
            <div class="logo-text">
                <span class="dash"></span>
                <span class="center-text">driver</span>
                <span class="dash"></span>
            </div>
        </div>

        <div class="banner">
            <img src="../assets/image/delivery.png" class="banner-image">
        </div>

        <div class="description">
            <span class="text">Manage your Khao Gully delivery in a breeze.<br>Happy driving!</span>
        </div>
    </div>

    <div class="body">
        <div class="login">
            <span class="head-text">Login</span>
            <input type="tel" class="field" placeholder="Enter mobile number" id="mobile-number" minlength="10" maxlength="10" onfocusin="inputFocus()" onkeyup="validateInput()">
            <span class="warning-text"></span>
        </div>
    </div>

    <div class="foot">
        <div class="action">
            <input type="submit" value="Send OTP" class="main-button" id="send-button" onclick="sendOTP()">
            <div class="secondary-button">
                <span class="left-text">Not registered with us?</span>
                <span class="link" onclick="openEditProfile('free')">Sign up</span>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/login.js"></script>
</body>
</html>