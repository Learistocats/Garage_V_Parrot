window.onload = function () {

    const menu_btn = document.querySelector('.hamburger');
    const mobile_menu = document.querySelector('.mobile-nav');
    const loginBtn = document.getElementById('login-btn');
    const loginBtnMobile = document.getElementById('login-btn-mobile');
    const loginFormContainer = document.getElementById('login-form-container');
    const closeBtn = document.getElementById('close-btn');


    menu_btn.addEventListener('click', function () {
        menu_btn.classList.toggle('is-active');
        mobile_menu.classList.toggle('is-active');
    });

    loginBtn.addEventListener('click', function() {
        loginFormContainer.style.display = 'block';
    });

    loginBtnMobile.addEventListener('click', function() {
        loginFormContainer.style.display = 'block';
    });

    closeBtn.addEventListener('click', function() {
        loginFormContainer.style.display = 'none';
    });
}