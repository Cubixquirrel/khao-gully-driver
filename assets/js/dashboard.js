function openManageDeliveries() {
    window.location.href = '../views/manage-deliveries.php';
}

function openReports() {
    window.location.href = '../views/reports.php';
}

function logout() {
    var http = new XMLHttpRequest();
    var url = '../requests/logout.php';
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            window.location.href = '../views/login.php';
        }
    }
    http.send();
}

function setLoginStatus(driverId, status) {
    var allStatusButton = document.querySelectorAll('.default');
    var currentStatusButton = event.currentTarget;
    currentStatusButton.innerHTML = 'Please Wait';
    currentStatusButton.style.background = '#dddddd';
    currentStatusButton.style.border = '1px solid #dddddd';
    currentStatusButton.style.color = '#999999';

    var http = new XMLHttpRequest();
    var url = '../requests/update-driver-login-status.php';
    var params = 
    'driverId='+driverId+
    '&status='+status
    ;

    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            console.log(http.responseText);
            if(http.responseText == 'online') {
                setTimeout(function() {
                    for (var i = 0; i < allStatusButton.length; i++) {
                        allStatusButton[i].style.background = '#fefefe';
                        allStatusButton[i].style.border = '1px solid #dddddd';
                        allStatusButton[i].style.color = '#000000';
                    }

                    currentStatusButton.innerHTML = 'Online';
                    currentStatusButton.style.background = '#FF5722';
                    currentStatusButton.style.border = '1px solid #FF5722';
                    currentStatusButton.style.color = '#ffffff';
                }, 2000);
            } else if(http.responseText == 'offline') {
                setTimeout(function() {
                    for (var i = 0; i < allStatusButton.length; i++) {
                        allStatusButton[i].style.background = '#fefefe';
                        allStatusButton[i].style.border = '1px solid #dddddd';
                        allStatusButton[i].style.color = '#000000';
                    }

                    currentStatusButton.innerHTML = 'Offline';
                    currentStatusButton.style.background = '#dddddd';
                    currentStatusButton.style.border = '1px solid #dddddd';
                    currentStatusButton.style.color = '#999999';
                }, 2000);
            }
        }
    }
    http.send(params);
}