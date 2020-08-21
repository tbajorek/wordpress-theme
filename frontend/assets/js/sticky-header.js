const pageBeforeMain = document.querySelector('.page-before-main');
const body = document.body;

function cb() {
    body.classList.toggle(
        'header-not-visible',
        pageBeforeMain.getBoundingClientRect().top < 50
    );
}

window.addEventListener('scroll', cb, { passive: true });
cb();
