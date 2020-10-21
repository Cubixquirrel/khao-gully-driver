<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Reports';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/reports.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="reports-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="reports-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="reports-menu">
        <div class="menu-first">
            <div class="reports-menu-list">
                <span>No report found</span>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/reports.js"></script>
    <script src="../assets/js/driver-location.js"></script>
</body>
</html>