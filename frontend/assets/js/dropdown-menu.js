import { toggle } from './lib';
import { isDesktop } from './media-queries';

document.addEventListener('click', function(event) {
    if (
        !event.target.classList.contains('sub-menu-opener-inner') ||
        isDesktop()
    ) {
        return;
    }
    event.preventDefault();
    const wrapper = event.target.closest('.menu-item');
    const subMenu = wrapper.querySelector('.sub-menu-wrapper');
    toggle(subMenu, wrapper, 'children-opened');
}, false);
