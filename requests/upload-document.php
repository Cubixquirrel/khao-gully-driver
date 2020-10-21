<?php

include_once('../config/db.php');

$target_dir = "../uploads/document/";

foreach ($_FILES as $key => $value) {
    $basename = $_FILES[$key]['name'];
    $tmp_name = $_FILES[$key]['tmp_name'];
    $target_file = rand('1000000', '9999999') . '_' . basename($basename);
}

if (move_uploaded_file($tmp_name, $target_dir . $target_file)) {
    echo $target_file;
}

?>