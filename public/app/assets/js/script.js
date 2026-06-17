const bars = document.querySelector('nav .bars');
const closeMenu = document.querySelector('header .navbar-responsive .close-menu');
const header = document.querySelector('header');
const searchIcon = document.querySelector('.search-icon');
const searchBox = document.querySelector('.search-box');
const categoryOneLis = document.querySelectorAll('header .navbar-responsive .category-one>li');
const categoryTwos = document.querySelectorAll('header .navbar-responsive .category-two');
const navbarResponsive = document.querySelector('header .navbar-responsive');
const overlay = document.querySelector('.overlay');
const body = document.querySelector('body');
const serviceTitles = document.querySelectorAll('.services-title li');
const serviceMains = document.querySelectorAll('.services-main li');
const callUs = document.querySelector('.call-us');
const bodyScrollHeight = body.scrollHeight;
const bodyClientHeight = window.innerHeight;
const profileHeader = document.querySelector('.profile-header');



// -----------------------------------------------------------------------------------------------

window.onscroll = function() {
    if (scrollY * 100 / (bodyScrollHeight - bodyClientHeight) > 80) {
        callUs.classList.add('hide');
    } else {
        callUs.classList.remove('hide');
    }
    singleProductInfoHeadChanger();
}

bars.addEventListener('click', menoResponsiveToggle);
closeMenu.addEventListener('click', menoResponsiveToggle);


searchIcon.onclick = function() {
    searchBox.classList.toggle('active');
    searchResult.classList.remove('active');
}

function removeActiveCategoryOneLi() {
    for (let j = 0; j < categoryOneLis.length; j++) {
        categoryOneLis[j].classList.remove('active');
    }
}


for (let i = 0; i < categoryOneLis.length; i++) {
    categoryOneLis[i].onclick = function() {

        categoryOneLis[i].classList.toggle('active');
        let categoryTwo = categoryOneLis[i].querySelector('.category-two');

        if (categoryOneLis[i].classList.contains('active')) {
            categoryTwo.style.height = categoryTwo.scrollHeight + 'px';
        } else {
            categoryTwo.style.height = '0';
        }
    }
}


function menoResponsiveToggle() {
    header.classList.toggle('active');
    navbarResponsive.classList.toggle('active');
    overlay.classList.toggle('active');
    overlay.classList.toggle('deactive');

    if (header.classList.contains('active')) {
        body.style.overflowY = 'hidden';
    } else {
        body.style.overflowY = 'auto';

    }

}


for (let i = 0; i < serviceTitles.length; i++) {
    if (i == 0) {
        serviceTitles[i].classList.add('active');
        serviceMains[i].classList.add('active');
    }
    serviceTitles[i].onclick = function() {

        serviceTitles.forEach(serviceTitle => {
            serviceTitle.classList.remove('active');
        });

        serviceMains.forEach(serviceMain => {
            serviceMain.classList.remove('active');
        });

        serviceTitles[i].classList.add('active');
        serviceMains[i].classList.add('active');

    }
}

// -----------------------------------------------------------------------------------------------
const searchBoxInput = document.querySelector('.search-box input');
const searchResult = document.querySelector('.search-result');

searchBoxInput.onclick = function() {
    if (searchBox.classList.contains('active')) {
        searchResult.classList.add('active');
        removeSearchResult();
    } else {
        searchResult.classList.remove('active');
    }
}

function removeSearchResult() {
    if (searchResult.classList.contains('active')) {
        window.onclick = function(e) {
            if (e.target != searchBox && e.target != searchResult && e.target != searchBoxInput && e.target != searchResult.querySelector('li') && e.target != searchResult.querySelector('a')) {
                searchResult.classList.remove('active');
            } else {

            }
        }
    }
}


// -----------------------------------------------------------------------------------------------



const products = document.querySelector('.products');
const nextProduct = document.querySelector('.next-product');
const prevProduct = document.querySelector('.prev-product');
const productItems = document.querySelectorAll('.product-item');
const productItemWidth = productItems[1].clientWidth;
let productIndex = 0;
let productCheck = 0;
const productsMaxScroll = products.scrollWidth - products.clientWidth;

nextProduct.onclick = function() {
    productsSlider('next');
}

prevProduct.onclick = function() {
    productsSlider('prev');
}

function productsSlider(direction) {
    if (direction == 'next') {
        productIndex++;

        for (let i = 0; i < productItems.length; i++) {
            productItems[i].style.transform = `translateX(${-productIndex*productItemWidth}px)`;
            checkProductsTransform();
        }

    } else {
        productIndex--;

        for (let i = 0; i < productItems.length; i++) {
            productItems[i].style.transform = `translateX(${-productIndex*productItemWidth}px)`;
            checkProductsTransform();
        }
    }
}


function checkProductsTransform() {

    if (productsMaxScroll < productIndex * productItemWidth) {
        productIndex = productsMaxScroll / productItemWidth;
        productCheck++;
    }


    if (productIndex * productItemWidth <= 0) {
        resetProductsSlider()
    }

    if (productCheck == 2) {
        productCheck = 0;
        resetProductsSlider()
    }
}


function resetProductsSlider() {
    productIndex = 0;
    for (let i = 0; i < productItems.length; i++) {
        productItems[i].style.transform = `translateX(${-productIndex*productItemWidth}px)`;
    }
}

let productSliderTimer = setInterval(runProductsSlider, 2000)

function runProductsSlider() {
    productsSlider('next');
}

for (let i = 0; i < productItems.length; i++) {
    productItems[i].onmouseover = function() {
        clearInterval(productSliderTimer);
    }

    productItems[i].onmouseout = function() {
        productSliderTimer = setInterval(runProductsSlider, 2000)

    }
}


// -----------------------------------------------------------------------------------------------

const partner = document.querySelector('.partner');
const partnerItems = document.querySelectorAll('.partner-item');

let partnerIndex = 0;

function partnerSlider() {
    partnerIndex++;
    partner.scrollLeft = partnerIndex;

    if (partnerIndex >= partner.scrollWidth - partner.clientWidth) {
        partnerIndex = 0;
    }
}

let partnerTimer = setInterval(partnerSlider, 30);

for (let i = 0; i < partnerItems.length; i++) {
    partnerItems[i].onmouseover = function() {
        clearInterval(partnerTimer);
    }

    partnerItems[i].onmouseout = function() {
        partnerTimer = setInterval(partnerSlider, 30);
    }
}






// -----------------------------------------------------------------------------------------------