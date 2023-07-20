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

const slider = document.querySelector('.slider');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

let currentIndex = 0;

function showImage(index) {
    const images = slider.querySelectorAll('img');
    images.forEach((image, i) => {
        image.style.display = i === index ? 'block' : 'none';
    });
}

function prevImage() {
    currentIndex = (currentIndex - 1 + slider.children.length) % slider.children.length;
    showImage(currentIndex);
}

function nextImage() {
    currentIndex = (currentIndex + 1) % slider.children.length;
    showImage(currentIndex);
}

prevBtn.addEventListener('click', prevImage);
nextBtn.addEventListener('click', nextImage);

showImage(currentIndex);