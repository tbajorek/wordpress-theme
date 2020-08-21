function getElemMaxTransitionDuration(elem) {
    const val = getComputedStyle(elem).getPropertyValue('transition-duration');
    return val.split(', ').reduce(function(ms_max, v) {
        var parts = /^(.+)(m?s)$/.exec(v);
        if (parts) {
            var ms_val = parseFloat(parts[1]) * (parts[2] === 's' ? 1E3 : 1);
            if (ms_val > ms_max) {
                return ms_val;
            }
        }
        return ms_max;
    }, 0);
}

class Timeout {

    constructor(fn, ms) {
        this.finished = false;
        this._fn = fn;
        this._id = setTimeout(() => {
            this._fn(true);
            this.finished = true;
        }, ms);
    }

    finish() {
        if (!this.finished) {
            clearTimeout(this._id);
            this._fn(false);
        }
    }
}

function showHideWrapper(fn) {
    return (elem, ...rest) => {
        var ms = getElemMaxTransitionDuration(elem) + 10;
        if (elem.timeout && !elem.timeout.finished) {
            return;
            // elem.timeout.finish();
        }
        const cb = fn(elem, ...rest);
        elem.timeout = new Timeout(cb, ms);
    }
};

const show = showHideWrapper((elem, statusElem, statusElemVisibleClass) => {
    // Get the natural height of the element
    elem.style.display = 'block'; // Make it visible
    var height = elem.scrollHeight + 'px'; // Get it's height
    elem.style.display = ''; //  Hide it again
    
    statusElem.classList.add(statusElemVisibleClass); // Make the element visible
    elem.style.height = height; // Update the max-height

    return () => {
        elem.style.height = '';
    }
});

const hide = showHideWrapper((elem, statusElem, statusElemVisibleClass) => {
    // Give the element a height to change from
    elem.style.height = elem.scrollHeight + 'px';

    // Set the height back to 0
    requestAnimationFrame(() => {
        elem.style.height = '0';
    });

    return () => {
        statusElem.classList.remove(statusElemVisibleClass);
        elem.style.height = '';
    }
});

export function toggle(elem, statusElem, statusElemVisibleClass) {
    const isVisible = statusElem.classList.contains(statusElemVisibleClass);
    const fn = isVisible ? hide : show;
    fn(elem, statusElem, statusElemVisibleClass);
}

export function getChildrenByClass(doc, className) {
    for (let i = 0; i < doc.children.length; i++) {
        if (doc.children[i].classList.contains(className)) {
            return doc.children[i];
        }        
    }
}