const body = document.body;
const goTopButton = document.querySelector('.go-top');

function updateScrolledDownStatus() {
    const vh = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    body.classList.toggle('scrolled-down', window.scrollY >= vh);
}

window.addEventListener('scroll', updateScrolledDownStatus);
window.addEventListener('resize', updateScrolledDownStatus);
updateScrolledDownStatus();

goTopButton.addEventListener('click', e => {
    e.preventDefault();
    body.scrollIntoView({
        behavior: "smooth"
    })
});
