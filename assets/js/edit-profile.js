function pageBack() {
    window.history.back();
}

var editProfileForm = document.getElementById('edit-profile-form');
var driverName = document.querySelector('#driver-name');
var driverAddress = document.querySelector('#driver-address');
var pincode = document.querySelector('#pincode');
var emailId = document.querySelector('#email-id');
var mobileNumber = document.querySelector('#mobile-number');
var confirmButton = document.querySelector('#confirm-button');
var allInput = document.querySelectorAll('input');
var allLabel = document.querySelectorAll('.label');

function enableButton(number) {    
    var aadhaarCardValue = document.querySelector('#aadhaar-card-value');
    var chequePassbookValue = document.querySelector('#cheque-passbook-value');
    var driverPhotoValue = document.querySelector('#driver-photo-value');
    var drivingLicenceValue = document.querySelector('#driving-licence-value');

    if (number == '1') {
        if (
            (driverName.value.length >= 1) && 
            (driverAddress.value.length >= 1) && 
            (pincode.value.length == 6) && 
            (emailId.value.length >= 1) && 
            (mobileNumber.value.length == 10) && 
            (aadhaarCardValue.value.length >= 1) && 
            (chequePassbookValue.value.length >= 1) && 
            (driverPhotoValue.value.length >= 1) && 
            (drivingLicenceValue.value.length >= 1) 
        ) {
            confirmButton.style.background = '#03a9f4';
            confirmButton.style.color = '#ffffff';
        } else {
            confirmButton.style.background = '#dddddd';
            confirmButton.style.color = '#999999';
        }
    }
}

function selectUpload(id) {
    document.querySelector('#'+id).click();
}

function validateUpload(id) {
    var upload = document.querySelector('#'+id);
    var uploadName = upload.getAttribute('name');

    if (upload.files.length === 0) {
    } else {
        upload.previousElementSibling.innerHTML = 'Uploading...';
        upload.previousElementSibling.removeAttribute('onclick');
        confirmButton.setAttribute('disabled', 'disabled');

        var http = new XMLHttpRequest();
        var formData = new FormData();
        formData.append(uploadName, upload.files[0]);
        var url = '../requests/upload-document.php';
        http.open('POST', url, true);
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {                
                // console.log(http.responseText);
                if(http.responseText != '') {
                    document.querySelector('#'+id+'-value').value = http.responseText;
                    setTimeout(function() {
                        upload.previousElementSibling.innerHTML = 'Uploaded';

                        setTimeout(() => {
                            confirmButton.removeAttribute('disabled');
                            upload.previousElementSibling.setAttribute('onclick', 'selectUpload("'+id+'")');
                            upload.previousElementSibling.innerHTML = 'Re-upload';
                            enableButton('1');
                        }, 2000);
                    }, 2000);
                }
            }
        }
        http.send(formData);
    }
}

function editProfile() {
    var aadhaarCardValue = document.querySelector('#aadhaar-card-value');
    var chequePassbookValue = document.querySelector('#cheque-passbook-value');
    var driverPhotoValue = document.querySelector('#driver-photo-value');
    var drivingLicenceValue = document.querySelector('#driving-licence-value');

    confirmButton.value = 'Please Wait';
    confirmButton.setAttribute('disabled', 'disabled');
    confirmButton.style.background = '#dddddd';
    confirmButton.style.color = '#999999';

    if (
        (driverName.value.length >= 1) && 
        (driverAddress.value.length >= 1) && 
        (pincode.value.length == 6) && 
        (emailId.value.length >= 1) && 
        (mobileNumber.value.length == 10) && 
        (aadhaarCardValue.value.length >= 1) && 
        (chequePassbookValue.value.length >= 1) && 
        (driverPhotoValue.value.length >= 1) && 
        (drivingLicenceValue.value.length >= 1)
    ) {
        for (var i = 0; i < 6; i++) {
            allLabel[i].style.color = '#0f0f0f';
        }

        var http = new XMLHttpRequest();
        var url = '../requests/edit-profile.php';
        var params = 
        'driverName='+driverName.value+
        '&driverAddress='+driverAddress.value+
        '&pincode='+pincode.value+
        '&emailId='+emailId.value+
        '&mobileNumber='+mobileNumber.value+
        '&aadhaarCardValue='+aadhaarCardValue.value+
        '&chequePassbookValue='+chequePassbookValue.value+
        '&driverPhotoValue='+driverPhotoValue.value+
        '&drivingLicenceValue='+drivingLicenceValue.value
        ;

        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                if(http.responseText == 'true') {
                    setTimeout(function() {
                        confirmButton.value = 'Confirmed';
                        confirmButton.style.background = '#03a9f4';
                        confirmButton.style.color = '#ffffff';

                        setTimeout(() => {
                            window.location.href = '../views/dashboard.php';
                        }, 1000);
                    }, 2000);
                }
            }
        }
        http.send(params);
    } else {
        setTimeout(function() {
            confirmButton.value = 'Confirm';
            confirmButton.removeAttribute('disabled');

            if (driverName.value == '') {
                allLabel[0].style.color = '#FF5722';
            } else {
                allLabel[0].style.color = '#0f0f0f';
            }

            if (driverAddress.value == '') {
                allLabel[1].style.color = '#FF5722';
            } else {
                allLabel[1].style.color = '#0f0f0f';
            }

            if (pincode.value.length != 6) {
                allLabel[2].style.color = '#FF5722';
            } else {
                allLabel[2].style.color = '#0f0f0f';
            }

            if (emailId.value == '') {
                allLabel[3].style.color = '#FF5722';
            } else {
                allLabel[3].style.color = '#0f0f0f';
            }

            if (mobileNumber.value.length != 10) {
                allLabel[4].style.color = '#FF5722';
            } else {
                allLabel[4].style.color = '#0f0f0f';
            }

            if (aadhaarCardValue.value == '') {
                document.querySelector('#aadhaar-card').previousElementSibling.previousElementSibling.style.color = '#FF5722';
            } else {
                document.querySelector('#aadhaar-card').previousElementSibling.previousElementSibling.style.color = '#0f0f0f';
            }
            
            if (chequePassbookValue.value == '') {
                document.querySelector('#cheque-passbook').previousElementSibling.previousElementSibling.style.color = '#FF5722';
            } else {
                document.querySelector('#cheque-passbook').previousElementSibling.previousElementSibling.style.color = '#0f0f0f';
            }

            if (driverPhotoValue.value == '') {
                document.querySelector('#driver-photo').previousElementSibling.previousElementSibling.style.color = '#FF5722';
            } else {
                document.querySelector('#driver-photo').previousElementSibling.previousElementSibling.style.color = '#0f0f0f';
            }

            if (drivingLicenceValue.value == '') {
                document.querySelector('#driving-licence').previousElementSibling.previousElementSibling.style.color = '#FF5722';
            } else {
                document.querySelector('#driving-licence').previousElementSibling.previousElementSibling.style.color = '#0f0f0f';
            }
        }, 1000);
    }
}