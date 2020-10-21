var head = document.querySelector('.head');
var body = document.querySelector('.body');
var foot = document.querySelector('.foot');

function inputFocus() {
    head.style.height = '0%';
    body.style.height = '50%';
    foot.style.height = '50%';
}

function openEditProfile(link) {
    window.location.href = '../views/edit-profile.php?type='+link+'';
}

function validateInput() {
    var mobileNumber = document.querySelector('#mobile-number');
    var sendButton = document.querySelector('#send-button');

    if (mobileNumber.value.length != 10) {
        mobileNumber.style.borderBottom = '1px solid #FF5722';
        sendButton.style.background = '#dddddd';
        sendButton.style.color = '#999999';
    } else if (mobileNumber.value.length == 10) {
        mobileNumber.style.borderBottom = '1px solid #dddddd';
        sendButton.style.background = '#03a9f4';
        sendButton.style.color = '#ffffff';
    }
}

function validateOTP() {
    var otp = document.querySelector('#otp');
    var confirmButton = document.querySelector('#confirm-button');

    if (otp.value.length != 6) {
        otp.style.borderBottom = '1px solid #FF5722';
        confirmButton.style.background = '#dddddd';
        confirmButton.style.color = '#999999';
        confirmButton.setAttribute('disabled', 'disabled');
    } else if (otp.value.length == 6) {
        otp.style.borderBottom = '1px solid #dddddd';
        confirmButton.style.background = '#03a9f4';
        confirmButton.style.color = '#ffffff';
        confirmButton.removeAttribute('disabled');
    }
}

function sendOTP() {
    var mobileNumber = document.querySelector('#mobile-number');
    var sendButton = document.querySelector('#send-button');
    var warningText = document.querySelector('.warning-text');
    warningText.innerHTML = '';

    if (mobileNumber.value.length != 10) {
        mobileNumber.style.borderBottom = '1px solid #FF5722';
    } else if (mobileNumber.value.length == 10) {
        mobileNumber.style.borderBottom = '1px solid #dddddd';
        sendButton.style.background = '#dddddd';
        sendButton.style.color = '#999999';
        sendButton.removeAttribute('onclick');
        sendButton.setAttribute('disabled', 'disabled');
        sendButton.value = 'Sending';

        var http = new XMLHttpRequest();
        var url = '../requests/send-otp.php';
        var params = 'mobileNumber='+mobileNumber.value;

        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                // console.log(http.responseText)
                setTimeout(function() {
                    if (http.responseText == 'true') {
                        var headText = document.querySelector('.head-text');
                        headText.innerHTML = 'We have sent an OTP to +91-'+mobileNumber.value;
                        sendButton.value = 'OTP Sent';
                        sendButton.setAttribute('onclick', 'confirmOTP("'+mobileNumber.value+'")');
                        
                        mobileNumber.setAttribute('placeholder', 'Enter OTP');
                        mobileNumber.value = '';

                        setTimeout(function() {
                            mobileNumber.setAttribute('minlength', '6');
                            mobileNumber.setAttribute('maxlength', '6');
                            mobileNumber.setAttribute('onkeyup', 'validateOTP()');
                            mobileNumber.setAttribute('id', 'otp');                            

                            sendButton.setAttribute('id', 'confirm-button');
                            sendButton.value = 'Confirm';
                        }, 1000);
                    } else {
                        setTimeout(() => {
                            sendButton.value = 'Incorrect Mobile Number';
                            sendButton.style.background = '#f44336';
                            sendButton.style.color = '#ffffff';
    
                            setTimeout(() => {
                                sendButton.value = 'Resend OTP';
                                sendButton.style.background = '#03a9f4';
                                sendButton.style.color = '#ffffff';
                                sendButton.removeAttribute('disabled');
                                sendButton.setAttribute('onclick', 'sendOTP()');
                            }, 1000);
                        }, 1000);
                    }
                }, 2000);
            }
        }
        http.send(params);
    }
}

function confirmOTP(mobileNumber) {
    var otp = document.querySelector('#otp');
    var confirmButton = document.querySelector('#confirm-button');
    var warningText = document.querySelector('.warning-text');
    warningText.innerHTML = '';
    
    confirmButton.setAttribute('disabled', 'disabled');
    confirmButton.value = 'Verifying';
    confirmButton.style.background = '#dddddd';
    confirmButton.style.color = '#999999';

    var http = new XMLHttpRequest();
    var url = '../requests/confirm-otp.php';
    var params = 'mobile='+mobileNumber+'&otp='+otp.value;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            setTimeout(function() {
                if (http.responseText == 'true') {
                    confirmButton.value = 'Confirmed';
                    confirmButton.style.background = '#03a9f4';
                    confirmButton.style.color = '#ffffff';

                    window.location.href = '../views/dashboard.php';
                } else if (http.responseText == 'false') {
                    warningText.innerHTML = 'Incorrect OTP';                    
                    confirmButton.value = 'Confirm';
                    otp.style.borderBottom = '1px solid #FF5722';
                }
            }, 2000);
        }
    }
    http.send(params);
}