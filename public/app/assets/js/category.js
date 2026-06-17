const categoryProducts = document.querySelector('.category-products').children;
const categoryItems = 4;
const pages = Math.ceil(categoryProducts.length / categoryItems);
const categoryNumber = document.querySelector('.category-controlls h6');
const categoryNext = document.querySelector('.category-next');
const categoryprev = document.querySelector('.category-prev');
let categoryIndex = 1;



function categoryNumberRun() {
    categoryNumber.innerHTML = `صفحه ${pages} / ${categoryIndex}`;

}

window.addEventListener('load', categoryNumberRun);

if (pages > 1) {
    categoryNext.classList.add('active');
}

categoryNext.onclick = function() {
    categoryPagination('next');
}

categoryprev.onclick = function() {
    categoryPagination('prev');
}

function categoryPagination(direction) {
    if (direction == 'next') {
        categoryIndex++;
        if (categoryIndex == pages) {
            categoryNext.classList.remove('active');
        }
        categoryprev.classList.add('active');

        categoryNumberRun();
    } else {
        categoryIndex--;
        if (categoryIndex == 1) {
            categoryprev.classList.remove('active');
        }
        categoryNext.classList.add('active');
        categoryNumberRun();

    }

    RunCategoryPagination();
}


RunCategoryPagination();

function RunCategoryPagination() {
    for (let i = 0; i < categoryProducts.length; i++) {

        if (i >= ((categoryIndex * categoryItems) - categoryItems) && i < categoryIndex * categoryItems) {
            categoryProducts[i].classList.add('active');

        } else {
            categoryProducts[i].classList.remove('active');
        }

    }
}