function recheckStatus() {
    var recheckButton = document.querySelector('.dashboard-pending-button');
    recheckButton.removeAttribute('onclick');
    recheckButton.style.background = '#dddddd';
    recheckButton.style.color = '#999999';
    recheckButton.innerHTML = 'Please Wait';
    
    setTimeout(() => {
        window.location.reload();
    }, 2000);
}