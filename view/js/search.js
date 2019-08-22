var i;
i = document.getElementsByClassName('nav-item');

window.onload = function () {
    i[0].classList.remove('active');
    i[2].classList.remove('active');
    i[1].classList.add('active');
};