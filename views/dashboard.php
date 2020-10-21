<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Dashboard';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="dashboard-header">
        <div class="header-left">
            <span><?php echo $driver_name; ?></span>
            <span>Driver ID: <?php echo $driver_id; ?></span>
            
            <?php
            if ($row_select_data['driver_login_status'] == '') {
                ?>
                <span class="default online-active" onclick="setLoginStatus('<?php echo $id; ?>', 'online')">Online</span>
                <span class="default" onclick="setLoginStatus('<?php echo $id; ?>', 'offline')">Offline</span>
                <?php
            } else if ($row_select_data['driver_login_status'] == 'false') {
                ?>
                <span class="default" onclick="setLoginStatus('<?php echo $id; ?>', 'online')">Online</span>
                <span class="default offline-active" onclick="setLoginStatus('<?php echo $id; ?>', 'offline')">Offline</span>
                <?php
            }
            ?>
        </div>

        <div class="header-right">
            <span><?php echo strtoupper($driver_name[0]); ?></span>
        </div>
    </div>

    <div class="banner-main">
        <?php
        $sql_select_banners = 'SELECT * FROM banners WHERE id = "1"';
        $result_select_banners = $conn->query($sql_select_banners);
        $row_select_banners = $result_select_banners->fetch_assoc();
        ?>

        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['driversBanner1']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['driversBanner2']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['driversBanner3']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['driversBanner4']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['driversBanner5']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['driversBanner6']; ?>">
    </div>

    <div class="dashboard-menu">
        <div class="menu-first">
            <div class="dashboard-menu-list" onclick="openManageDeliveries()"><span>Manage Deliveries</span><i class="fas fa-chevron-right"></i></div>
            <!-- <div class="dashboard-menu-list" onclick="openReports()"><span>Reports</span><i class="fas fa-chevron-right"></i></div> -->            
            <div class="dashboard-menu-list" onclick="logout()"><span>Log Out</span><i class="fas fa-chevron-right"></i></div>
        </div>  
        <!-- <div class="menu-second">
            <div class="dashboard-menu-list" onclick="logout()"><span>Log Out</span><i class="fas fa-chevron-right"></i></div>
        </div> -->
    </div>
    
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/driver-location.js"></script>
</body>
</html>