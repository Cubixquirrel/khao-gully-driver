function pageBack() {
    window.history.back();
}

function updateOrderStatus(orderId, userId, orderStatus) {
    if (orderStatus == 'Cooking Finished') {
        var buttonNewText = 'Mark As Delivered';
        var newOrderStatus = 'Out For Delivery';
    }
    else if (orderStatus == 'Out For Delivery') {
        var buttonNewText = 'Completed';
        var newOrderStatus = 'Delivered';
    }
    
    var updateStatusButton = event.currentTarget;

    updateStatusButton.innerHTML = 'Please Wait';
    updateStatusButton.removeAttribute('onclick');

    var http = new XMLHttpRequest();
    var url = '../requests/update-order-status.php';
    var params = 
    'orderId='+orderId+
    '&userId='+userId+
    '&orderStatus='+orderStatus+
    '&newOrderStatus='+newOrderStatus
    ;

    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            // console.log(http.responseText);
            if(http.responseText == 'true') {
                setTimeout(function() {
                    updateStatusButton.innerHTML = buttonNewText;
                    updateStatusButton.previousElementSibling.innerHTML = newOrderStatus;
                    if (orderStatus == 'Cooking Finished') {
                        updateStatusButton.setAttribute('onclick', 'updateOrderStatus("'+orderId+'", "'+userId+'", "'+newOrderStatus+'")');
                    } else if (orderStatus == 'Out For Delivery') {
                        updateStatusButton.setAttribute('class', 'update-status-button active');
                    }
                }, 2000);
            }
        }
    }
    http.send(params);
}