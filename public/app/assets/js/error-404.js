const error404 = document.querySelector('.error-404');

window.onmousemove = function(e) {

    let x = e.clientX;
    let y = e.clientY;

    error404.style.backgroundPositionX = x / 5 + 'px';
    error404.style.backgroundPositionY = y / 5 + 'px';

    console.log();
}