import enquire from 'enquire.js';

const body = document.body;

enquire.register("only screen and (min-width: 840px)", {

    match() {
        body.classList.add('desktop');
    },

    unmatch() {
        body.classList.remove('desktop');
    }
});

export function isDesktop() {
    return body.classList.contains('desktop');
}
