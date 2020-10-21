<?php

include_once('../config/db.php');

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_driver_user = 'SELECT user_id FROM driver_users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'"';
    $result_select_driver_user = $conn->query($sql_select_driver_user);
    
    if ($result_select_driver_user->num_rows === 1) {
        $row_select_driver_user = $result_select_driver_user->fetch_assoc();

        $sql_select_data = 'SELECT * FROM driver WHERE id = "'.$row_select_driver_user["user_id"].'"';
        $result_select_data = $conn->query($sql_select_data);
        $row_select_data = $result_select_data->fetch_assoc();

        if ($row_select_data['driver_status'] == 'true') {
            header ('location: ../views/dashboard.php');    
        } else {
            // echo 'Hello Dashboard Pending !!';
            $page_title = 'Dashboard Pending';

            if (isset($_SERVER['HTTP_REFERER'])) {
                $http_referer = explode('/', $_SERVER['HTTP_REFERER']);
                if ($http_referer[5] == 'dashboard-pending.php') {
                    ?>
                    <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var recheckButton = document.querySelector('.dashboard-pending-button');
                        recheckButton.innerHTML = 'Approval Pending';
                        recheckButton.removeAttribute('onclick');

                        setTimeout(() => {
                            recheckButton.setAttribute('onclick', 'recheckStatus()');
                            recheckButton.innerHTML = 'Recheck Status';
                        }, 2000);
                    });
                    </script>
                    <?php
                }
            }
        }
    } else {
        header ('location: ../views/login.php');
    } 
} else {
    header ('location: ../views/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/dashboard-pending.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="dashboard-pending-main">
        <div class="dashboard-pending-main-inner">
            <i class="fas fa-user-clock"></i>
            <span class="dashboard-pending-title">Approval Pending</span>
            <span class="dashboard-pending-subtitle">Currently your account is in under verification. On approval, you will 
            be logged in to your main dashboard.</span>
            <button class="dashboard-pending-button" onclick="recheckStatus()">Recheck Status</button>
        </div>
    </div>

    <script src="../assets/js/dashboard-pending.js"></script>
</body>
</html>