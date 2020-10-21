<?php

include_once('../config/db.php');

date_default_timezone_set('Asia/Kolkata');
$current_time = date("d-m-Y H:i:s");

if (
    ($_POST['orderId'] != '') && 
    ($_POST['userId'] != '')
) {
    $order_id = $_POST['orderId'];
    $user_id = $_POST['userId'];
    $order_status = $_POST['orderStatus'];
    $new_order_status = $_POST['newOrderStatus'];

    $sql_update_order_id = 
    '
    UPDATE order_id SET order_status = "'.$new_order_status.'" WHERE id = "'.$order_id.'"
    ';
    $result_update_order_id = $conn->query($sql_update_order_id);
    
    if ($result_update_order_id) {
        if (($_POST['orderStatus'] == 'Cooking Finished') && ($_POST['newOrderStatus'] == 'Out For Delivery')) {
            $notification_description = 'Your Khao Gully Valet is on his way to deliver you order.';
        }
        else if (($_POST['orderStatus'] == 'Out For Delivery') && ($_POST['newOrderStatus'] == 'Delivered')) {
            $notification_description = 'Your order delivered successfully.';
        }
        $notification_name = $new_order_status;
        $notification_created_on = $current_time;

        $sql_insert_notification = 
        '
        INSERT INTO notification (
            user_id, 
            notification_name, notification_description, notification_created_on
        ) VALUES (
            "'.$user_id.'", 
            "'.$notification_name.'", "'.$notification_description.'", "'.$notification_created_on.'"
        )
        ';
        $result_insert_notification = $conn->query($sql_insert_notification);
        
        if ($result_insert_notification) {
            echo 'true';
        }
    }
}

?>