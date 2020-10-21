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

$page_title = "Let's get started";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/edit-profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="edit-profile-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="edit-profile-title">
        <span><?php echo $page_title; ?></span>

        <span class="subtext">Enter your basic details here:</span>
    </div>

    <div class="edit-profile-form">
        <div id="edit-profile-form">
            <div class="pb-10">
                <div class="label">
                    Driver name
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="driverName" id="driver-name" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                <div class="label mt-25">
                    Driver address
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="driverAddress" id="driver-address" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                <div class="label mt-25">
                    Pincode
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" minlength="6" maxlength="6" name="pincode" id="pincode" onkeyup="enableButton('1')">
                    </div>
                </div>
            
                <div class="label mt-25">
                    Email ID
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="emailId" id="email-id" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Mobile no.
                </div>

                <div class="input-group" style="margin: 20px 0;">
                    <img src="../assets/image/flag.png" width="24">

                    <div class="input-control-group">
                        <span>+91</span>
                        <input type="tel" minlength="10" maxlength="10" name="mobileNumber" id="mobile-number" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Uploads
                </div>

                <div class="input-group upload-main">                    
                    <div class="input-control-group uploads-box">
                        <span>Aadhaar card</span>
                        <span class="upload-button" onclick="selectUpload('aadhaar-card')">Upload</span>
                        <input type="file" name="aadhaarCard" id="aadhaar-card" onchange="validateUpload('aadhaar-card')">
                        <input type="hidden" id="aadhaar-card-value">
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Cancelled cheque / bank passbook</span>
                        <span class="upload-button" onclick="selectUpload('cheque-passbook')">Upload</span>
                        <input type="file" name="chequePassbook" id="cheque-passbook" onchange="validateUpload('cheque-passbook')">
                        <input type="hidden" id="cheque-passbook-value">
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Driver photo</span>
                        <span class="upload-button" onclick="selectUpload('driver-photo')">Upload</span>
                        <input type="file" name="driverPhoto" id="driver-photo" onchange="validateUpload('driver-photo')">
                        <input type="hidden" id="driver-photo-value">
                    </div>

                    <div class="input-control-group uploads-box">
                        <span>Driving licence</span>
                        <span class="upload-button" onclick="selectUpload('driving-licence')">Upload</span>
                        <input type="file" name="drivingLicence" id="driving-licence" onchange="validateUpload('driving-licence')">
                        <input type="hidden" id="driving-licence-value">
                    </div>
                </div>

                <div class="button">
                    <input type="button" value="Confirm" id="confirm-button" onclick="editProfile()">
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/edit-profile.js"></script>
    <script src="../assets/js/driver-location.js"></script>
</body>
</html>