const menuToggler = document.querySelector('.menu-toggler');
const body = document.body;

menuToggler.addEventListener('click', e => {
    e.preventDefault();
    let isMenuOpened = body.classList.contains('menu-opened');
    body.classList.toggle('menu-opened', !isMenuOpened);
    menuToggler.classList.toggle('icon-cancel', !isMenuOpened);
    menuToggler.classList.toggle('icon-menu', isMenuOpened);
});
