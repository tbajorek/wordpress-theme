import { getChildrenByClass } from './lib';

document.addEventListener('click', function(event) {
    if (!event.target.classList.contains('open-reply')) {
        return;
    }
    event.preventDefault();
    // close other comments
    const currOpened = document.querySelector('.comment.reply-enabled');
    if (currOpened) {
        currOpened.classList.remove('reply-enabled');
    }
    // open this comment
    const comment = event.target.closest('.comment');
    comment.classList.add('reply-enabled');
    const replies = getChildrenByClass(comment, 'comment-replies');
    const userReply = getChildrenByClass(replies, 'comment-user-reply');
    const replyInput =  userReply.querySelector('.comment-input');
    replyInput.focus();
}, false);
