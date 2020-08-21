function scrollIntoView(location) {
    if (!location) {
        return;
    }
    console.log(location)
    const parts = location.split('#');
    if (parts < 2) {
        return;
    }
    const id = parts[1];
    const elem = document.getElementById(id);
    console.log(id, elem)
    if (!elem) {
        return;
    }
    elem.scrollIntoView({
        behavior: "smooth"
    });
}

function scrollIntoViewOnLoad() {
    scrollIntoView(window.location.hash);
}

function scrollIntoViewOnClick(event) {
    event.preventDefault();
    scrollIntoView(event.target.href);
}

const elem = document.querySelector('.article-header .article-comments-count');

if (elem) {
    elem.addEventListener('click', scrollIntoViewOnClick);
}
