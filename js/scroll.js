//scroll
var scrollDiv = document.querySelector(".comments")
let scroollBtn = document.querySelector('.scrooll_comments');
scroollBtn.addEventListener('click', () => {
    scrollDiv.scrollIntoView({
        behavior: 'smooth'
    });
})
