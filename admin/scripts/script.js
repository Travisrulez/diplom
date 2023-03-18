const menuBtn = document.querySelector('.menu');
const navbar = document.querySelector('.navbar');
const container = document.querySelector('.container');
const menuLine = document.querySelector('header .menu .line');

const navbarWidth = navbar.clientWidth;
menuBtn.addEventListener('click', () => {
    if (!navbar.classList.contains('active')) {
        menuLine.classList.add('active-arrow');
        navbar.classList.add('active');
        container.style.transform = `translateX(${navbarWidth}px)`;
        document.documentElement.style.overflowX = 'hidden';
    } else {
        menuLine.classList.remove('active-arrow');
        navbar.classList.remove('active');
        container.style.transform = ``;
        document.documentElement.style.overflowX = '';
    }
});