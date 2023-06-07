function toggleMenu() {
    const menu = document.querySelector('.navbar-menu');
    if (menu.classList.contains('active')) {
        menu.classList.remove('active');
        menu.classList.add('closed');
        menu.style.maxHeight = '0';
    } else {
        menu.classList.add('active');
        menu.style.maxHeight = menu.scrollHeight + 'px';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var item = document.querySelector('#aboutUs .content .item');
    item.classList.add('animate-shadow');
});