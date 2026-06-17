const titleTableSearchers = document.querySelectorAll('.title-table-searcher');
const tableSearcherOutput = document.querySelector('.table-searcher-output');
let targetUrl;
let baseUrl;
let posts;
var ajaxDeleteSearcher;
var statusChangerSearcher;

titleTableSearchers.forEach(titleTableSearcher => {

    titleTableSearcher.oninput = function() {
        targetUrl = titleTableSearcher.getAttribute('targetUrl');
        baseUrl = titleTableSearcher.getAttribute('baseUrl');

        tableSearcherOutput.innerHTML = '';
        titleSearch(titleTableSearcher)
    }
});



function titleSearch(titleTableSearcher) {


    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var jsonData = JSON.parse(xmlHttp.responseText);

            let documents = jsonData;
            console.log(documents);

            if (targetUrl == baseUrl + 'admin/content/post/title-search') {
                addItemToFindPosts(documents, titleTableSearcher);
            } else if (targetUrl == baseUrl + 'admin/user/user/title-search') {
                addItemToFindUsers(documents, titleTableSearcher);
            } else if (targetUrl == baseUrl + 'admin/market/product/title-search') {
                addItemToFindProducts(documents, titleTableSearcher);
            } else if (targetUrl == baseUrl + 'admin/market/store/title-search') {
                addItemToFindStores(documents, titleTableSearcher);
            } else if (targetUrl == baseUrl + 'admin/market/category-attribute/title-search') {
                addItemToFindCategoryAttributes(documents, titleTableSearcher);
            } else if (targetUrl == baseUrl + 'admin/market/discount/title-search-code') {
                addItemToFindDiscountCode(documents, titleTableSearcher);
            } else if (targetUrl == baseUrl + 'admin/market/discount/title-search-user') {
                addItemToFindDiscountUser(documents, titleTableSearcher);
            } else if (targetUrl == baseUrl + 'admin/market/order/title-search') {
                addItemToFindOrder(documents, titleTableSearcher);
            }

        }
    }
    xmlHttp.open('POST', targetUrl, true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    let data = { "value": titleTableSearcher.value };
    data = JSON.stringify(data)
    xmlHttp.send(data);
}


function addItemToFindPosts(posts, titleTableSearcher) {

    posts.forEach(post => {

        let status;
        let commentable;

        if (post.status == 1) {
            status = 'checked';
        } else {
            status = ''
        }

        if (post.commentable == 1) {
            commentable = 'checked';
        } else {
            commentable = ''
        }

        if (titleTableSearcher.value == '') {
            tableSearcherOutput.innerHTML = '';

        } else {
            tableSearcherOutput.insertAdjacentHTML("afterbegin", `
            <tr class="ajax-delete">
                                        <th scope="row">${post.id}</th>
                                        <td>${post.name}</td>
                                        <td><img class="table-image" src="${baseUrl+post.image}" alt="">
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <h6 class="me-2">فعال</h6>
                                                <div class="checkbox-wrapper-40">
                                                    <label>
                                                        <input targetUrl="${baseUrl}admin/content/post/change-status" data-status="${post.id}" type="checkbox" class="checkboxStatus cursor-pointer status-changer" ${status}>
                                                        <span class="checkbox"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex ">
                                                <h6 class="me-2">فعال</h6>
                                                 <div class="checkbox-wrapper-40">
                                                    <label>
                                                        <input targetUrl="${baseUrl}admin/content/post/change-commentable"
                                                            data-status="${post.id}" type="checkbox"
                                                            class="checkboxStatus cursor-pointer status-changer" ${commentable}>
                                                        <span class="checkbox"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="${baseUrl}admin/content/post/delete/${post.id}"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="${baseUrl}admin/content/post/edit/${post.id}"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
    `);
            // const ajaxDeleteSearcher = document.querySelectorAll('.ajax-delete');
            // for (let i = 0; i < ajaxDeleteSearcher.length; i++) {
            //     ajaxDeleteSearcher[i].querySelector('.btn-ajax-delete').onclick = function() {
            //         console.log(ajaxDeleteSearcher[i]);
            //         if (confirm('از حذف این ردیف اطمینان دارید؟؟')) {
            //             runAjaxDelete(i);
            //         }

            //     }
            // }
        }


    });

    ajaxDeleteSearcher = document.querySelectorAll('.ajax-delete');
    startAjaxDelete(ajaxDeleteSearcher);

    statusChangerSearcher = document.querySelectorAll('.status-changer');
    startStatusChanger(statusChangerSearcher);

}







function addItemToFindUsers(users, titleTableSearcher) {
    console.log(users);

    users.forEach(user => {


        if (titleTableSearcher.value == '') {
            tableSearcherOutput.innerHTML = '';

        } else {
            tableSearcherOutput.insertAdjacentHTML("afterbegin", `
            <tr class="ajax-delete">
                                    <th scope="row">${user.id}</th>
                                    <td>${user.username}</td>
                                    <td>${user.email}</td>
                                    <td>
                                        <div>

                                            <a href="${baseUrl}admin/user/user/edit/${user.id}" class="text-warning mx-2"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
    `);
        }
    });

}





function addItemToFindProducts(products, titleTableSearcher) {

    products.forEach(product => {


        if (titleTableSearcher.value == '') {
            tableSearcherOutput.innerHTML = '';

        } else {

            product.price = new Intl.NumberFormat('en-US', { style: "decimal" }).format(product.price);
            console.log(product.price);
            tableSearcherOutput.insertAdjacentHTML("afterbegin", `
           <tr class="ajax-delete">
                                    <th scope="row">${product.id}</th>
                                    <td>${product.name}</td>
                                    <td><img class="table-image" src="${baseUrl+product.image}" alt="">
                                    </td>
                                    <td>${product.price}</td>

                                    <td>
                                        <div>
                                            <button class="text-danger btn btn-sm btn-ajax-delete"
                                                targetUrl="${baseUrl}admin/market/product/delete/${product.id}"><i
                                                    class="fas fa-trash"></i></button>

                                            <a href="${baseUrl}admin/market/product/edit/${product.id}"
                                                class="text-warning mx-2"><i class="fas fa-edit"></i></a>

                                                <a href="${baseUrl}admin/market/product/show/${product.id}"
                                                class="text-primary mx-2"><i class="fas fa-eye"></i></a>

                                                <a href="${baseUrl}admin/market/product/table/${product.id}"
                                                    class="text-success mx-2"><i class="fas fa-table"></i></a>

                                                <a href="${baseUrl}admin/market/product/${product.id}/gallery"
                                                    class="text-black mx-2"><i class="fas fa-image"></i></a>
                                        </div>
                                    </td>
                                </tr>
    `);
        }
    });


    ajaxDeleteSearcher = document.querySelectorAll('.ajax-delete');
    startAjaxDelete(ajaxDeleteSearcher);

}








function addItemToFindStores(products, titleTableSearcher) {

    products.forEach(product => {


        if (titleTableSearcher.value == '') {
            tableSearcherOutput.innerHTML = '';

        } else {

            product.marketable_number = new Intl.NumberFormat('en-US', { style: "decimal" }).format(product.marketable_number);
            product.sold_number = new Intl.NumberFormat('en-US', { style: "decimal" }).format(product.sold_number);
            tableSearcherOutput.insertAdjacentHTML("afterbegin", `

                                    <tr class="ajax-delete">
                                        <th scope="row">${product.id}</th>
                                        <td>${product.name}</td>
                                        <td><img class="table-image" src="${baseUrl+product.image}" alt="">
                                        </td>
                                        <td>${product.marketable_number}</td>
                                        <td>${product.sold_number}</td>

                                        <td>
                                            <div>

                                                <a href="${baseUrl}admin/market/store/edit/${product.id}"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>


                                                <a href="${baseUrl}admin/market/store/add-form/${product.id}"
                                                    class="text-primary mx-2"><i class="fas fa-plus"></i></a>
                                            </div>
                                        </td>
                                    </tr>
    `);
        }
    });

}






function addItemToFindCategoryAttributes(categoryAttributes, titleTableSearcher) {

    categoryAttributes.forEach(categoryAttribute => {


        if (titleTableSearcher.value == '') {
            tableSearcherOutput.innerHTML = '';

        } else {


            if (categoryAttribute.unite == null) {
                categoryAttribute.unite = '-';
            }

            tableSearcherOutput.insertAdjacentHTML("afterbegin", `

                                                                        <tr class="ajax-delete">
                                        <th scope="row">${categoryAttribute.id}</th>
                                        <td>${categoryAttribute.name}</td>

                                        <td>${categoryAttribute.unit}</td>

                                        <td>${categoryAttribute.product_category_name}</td>


                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="${baseUrl}admin/market/category-attribute/delete/${categoryAttribute.id}"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="${baseUrl}admin/market/category-attribute/edit/${categoryAttribute.id}"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>


                                                <a href="${baseUrl}admin/market/category-attribute-value/${categoryAttribute.id}"
                                                    class="text-primary mx-2"><i class="fas fa-layer-group"></i></a>
                                            </div>
                                        </td>
                                    </tr>
    `);
        }
    });


    ajaxDeleteSearcher = document.querySelectorAll('.ajax-delete');
    startAjaxDelete(ajaxDeleteSearcher);

}







function addItemToFindDiscountCode(discounts, titleTableSearcher) {

    discounts.forEach(discount => {


        if (titleTableSearcher.value == '') {
            tableSearcherOutput.innerHTML = '';

        } else {



            discount.amount = new Intl.NumberFormat('en-US', { style: "decimal" }).format(discount.amount);


            if (discount.discount_celling == null) {
                discount.discount_celling = '-';
            } else {
                discount.discount_celling = new Intl.NumberFormat('en-US', { style: "decimal" }).format(discount.discount_celling);

            }

            if (discount.amount_type == 1) {
                discount.amount_type = 'درصد';
            } else {
                discount.amount_type = 'تومان';

            }

            if (discount.type == 1) {
                discount.type = 'خصوصی';
            } else {
                discount.type = 'عمومی';

            }

            if (discount.status == 1) {
                discount.status = 'فعال';
            } else {
                discount.status = 'غیر فعال';

            }

            tableSearcherOutput.insertAdjacentHTML("afterbegin", `
          <tr class="ajax-delete">
                                        <th scope="row">${discount.id}</th>
                                        <td>${discount.code}</td>
                                        <td>${discount.amount}</td>
                                        <td>${discount.amount_type}</td>
                                        <td>${discount.discount_celling}</td>
                                        <td>${discount.type}</td>
                                        <td>${discount.status}</td>
                                        <td>${discount.start_date}</td>
                                        <td>${discount.end_date}</td>
                                        <td>${discount.email}</td>

                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="${baseUrl}admin/market/discount/delete/${discount.id}"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="${baseUrl}admin/market/discount/edit/${discount.id}"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>

                                            </div>
                                        </td>
                                    </tr>
    `);
        }
    });


    ajaxDeleteSearcher = document.querySelectorAll('.ajax-delete');
    startAjaxDelete(ajaxDeleteSearcher);

}







function addItemToFindDiscountUser(discounts, titleTableSearcher) {

    discounts.forEach(discount => {


        if (titleTableSearcher.value == '') {
            tableSearcherOutput.innerHTML = '';

        } else {



            discount.amount = new Intl.NumberFormat('en-US', { style: "decimal" }).format(discount.amount);


            if (discount.discount_celling == null) {
                discount.discount_celling = '-';
            } else {
                discount.discount_celling = new Intl.NumberFormat('en-US', { style: "decimal" }).format(discount.discount_celling);

            }

            if (discount.amount_type == 1) {
                discount.amount_type = 'درصد';
            } else {
                discount.amount_type = 'تومان';

            }

            if (discount.type == 1) {
                discount.type = 'خصوصی';
            } else {
                discount.type = 'عمومی';

            }

            if (discount.status == 1) {
                discount.status = 'فعال';
            } else {
                discount.status = 'غیر فعال';

            }

            tableSearcherOutput.insertAdjacentHTML("afterbegin", `
          <tr class="ajax-delete">
                                        <th scope="row">${discount.id}</th>
                                        <td>${discount.code}</td>
                                        <td>${discount.amount}</td>
                                        <td>${discount.amount_type}</td>
                                        <td>${discount.discount_celling}</td>
                                        <td>${discount.type}</td>
                                        <td>${discount.status}</td>
                                        <td>${discount.start_date}</td>
                                        <td>${discount.end_date}</td>
                                        <td>${discount.email}</td>

                                        <td>
                                            <div>
                                                <button class="text-danger btn btn-sm btn-ajax-delete"
                                                    targetUrl="${baseUrl}admin/market/discount/delete/${discount.id}"><i
                                                        class="fas fa-trash"></i></button>

                                                <a href="${baseUrl}admin/market/discount/edit/${discount.id}"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>

                                            </div>
                                        </td>
                                    </tr>
    `);
        }
    });


    ajaxDeleteSearcher = document.querySelectorAll('.ajax-delete');
    startAjaxDelete(ajaxDeleteSearcher);

}



function addItemToFindOrder(orders, titleTableSearcher) {

    orders.forEach(order => {


        if (titleTableSearcher.value == '') {
            tableSearcherOutput.innerHTML = '';

        } else {

            order.order_final_amount = new Intl.NumberFormat('en-US', { style: "decimal" }).format(order.order_final_amount);


            if (order.payment_status == 1) {
                order.payment_status = 'در انتظار پرداخت';
            } else if (order.payment_status == 2) {
                order.payment_status = 'پرداخت شد';
            } else {
                order.payment_status = 'پرداخت نا موفق';

            }


            if (order.delivery_status == 1) {
                order.delivery_status = 'در حال پردازش';
            } else if (order.delivery_status == 2) {
                order.delivery_status = 'ارسال شده';
            } else {
                order.delivery_status = 'بازگشت داده شده';

            }



            if (order.order_status == 0) {
                order.order_status = 'در انتظار ';
            } else if (order.order_status == 1) {
                order.order_status = 'در حال پردازش ';
            } else if (order.order_status == 2) {
                order.order_status = 'تکمیل شده';
            } else if (order.order_status == 3) {
                order.order_status = 'رد شده';
            } else {
                order.order_status = 'بازگشت داده شده';

            }


            tableSearcherOutput.insertAdjacentHTML("afterbegin", `
          <tr class="ajax-delete">
                                        <th scope="row">${order.id}</th>
                                        <td>${order.email}</td>

                                        <td>${order.payment_status}</td>


                                        <td>${order.delivery_status}</td>

                                        <td>${order.order_final_amount}</td>
                                        <td>${order.order_status}</td>
                                        <td>${order.created_at}<td>
                                            <div>


                                                <a href="${baseUrl}admin/market/order/items/${order.id}"
                                                    class="text-warning mx-2"><i class="fas fa-edit"></i></a>


                                                <a href="${baseUrl}admin/market/order/show/${order.id}"
                                                    class="text-primary mx-2"><i class="fas fa-eye"></i></a>


                                            </div>
                                        </td>
                                    </tr>
    `);
        }
    });


}