const menu = document.querySelector('.menu-toggler');
const body = document.body;

menu.addEventListener('click', e => {
    e.preventDefault();
    let isMenuOpened = body.classList.contains('menu-opened');
    body.classList.toggle('menu-opened', !isMenuOpened);
    menu.classList.toggle('icon-cancel', !isMenuOpened);
    menu.classList.toggle('icon-menu', isMenuOpened);
});

const selectMenu = () => {
    let activeMenu = document.querySelector('li.selected');
    if (activeMenu === null) {
        return;
    }
    while (!activeMenu.classList.contains('page-menu')) {
        if (activeMenu.classList.contains('menu-item')) {
            activeMenu.classList.add('selected');
        }
        activeMenu = activeMenu.parentElement;
        if (activeMenu === null) {
            break;
        }
    }
}
selectMenu();