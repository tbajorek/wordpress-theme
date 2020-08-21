import debounce from 'debounce';

const fbPageWrapper = document.querySelector('.fb-page-wrapper');
const fbPage = fbPageWrapper.querySelector('.fb-page');

function initFb() {
    fbPage.dataset.width = fbPageWrapper.offsetWidth;
    FB.init({
        appId            : 3043504949002229,
        xfbml            : true,
        version          : 'v7.0'
    });
    window.addEventListener('resize', debounce(() => {
        fbPage.dataset.width = fbPageWrapper.offsetWidth;
        FB.XFBML.parse();
    }, 500));
};


if (typeof(FB) !== 'undefined') {
    initFb();
}
else {
    window.fbAsyncInit = initFb;
}
