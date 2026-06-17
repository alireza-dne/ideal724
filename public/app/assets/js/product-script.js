const singleProductImage = document.querySelector('.single-product-image-box img');
const singleProductGallery = document.querySelectorAll('.single-product-gallery li');

window.onload = function() {
    singleProductGallery[0].classList.add('active');
}

for (let i = 0; i < singleProductGallery.length; i++) {
    singleProductGallery[i].onclick = function() {
        singleProductGallery.forEach(singleProductGaller => {
            singleProductGaller.classList.remove('active');
        });
        singleProductGallery[i].classList.add('active');

        singleProductImage.src = singleProductGallery[i].querySelector('img').src;
    }
}



// -------------------------------------------------------------------------------------------
const singleProductInfo = document.querySelector('#single-product-info');
const singleProductInfoHead = document.querySelector('.single-product-info-head');

function singleProductInfoHeadChanger() {
    if (scrollY > singleProductInfo.offsetTop) {
        singleProductInfoHead.style.width = singleProductInfo.clientWidth + 'px';

        singleProductInfoHead.classList.add('active');
    } else {
        singleProductInfoHead.classList.remove('active');

    }
}