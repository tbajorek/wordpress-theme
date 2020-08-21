import { isDesktop } from './media-queries';

const pageHeaderParallax = document.querySelector('.page-header-parallax');
const headerContent = pageHeaderParallax.querySelector('.header-content');
const headerContentInner = headerContent.querySelector('.header-content-inner');
const body = document.body;

function parallax() {
    const headerTranslation = window.scrollY / 2;

    const headerContentRect = headerContentInner.getBoundingClientRect();
    let headerContentHidden;
    if (isDesktop()) {
        headerContentHidden = headerContent.offsetHeight - headerContentRect.height - headerContentRect.top - 2 * headerTranslation < 40;
    }
    else {
        headerContentHidden = headerContentRect.top < 40;
    }

    body.classList.toggle('header-content-hidden', headerContentHidden);
    pageHeaderParallax.style.transform = `translateY(${headerTranslation}px)`;

    window.requestAnimationFrame(parallax);
}

window.requestAnimationFrame(parallax);
