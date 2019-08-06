var scroll_up = document.getElementById('scroll_up');
scroll_up.onclick = function () {
    return up();
};

function up() {
    var top = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
    if (top > 0) {
        window.scrollBy(0, ((top + 100) / -10));
        t = setTimeout('up()', 20);
    } else clearTimeout(t);
    return false;
}

window.onscroll = function () {
    var scrolled = window.pageYOffset || document.documentElement.scrollTop;
    if (scrolled > 0) {
        scroll_up.style.display = "block"
    } else scroll_up.style.display = "none";
};


