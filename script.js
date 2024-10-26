function openLogin() {
    document.querySelector('.login').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

function openRegister() {
    document.querySelector('.register').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

function closeLogin() {
    document.querySelector('.login').style.display = 'none';
    closeOverlay();
}

function closeRegister() {
    document.querySelector('.register').style.display = 'none';
    closeOverlay();
}

function closeAll() {
    closeLogin();
    closeRegister();
}

function closeOverlay() {
    document.getElementById('overlay').style.display = 'none';
}
