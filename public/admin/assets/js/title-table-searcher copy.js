const titleTableSearcher = document.querySelector('.title-table-searcher');
const tableSearcherOutput = document.querySelector('.table-searcher-output');
const targetUrl = titleTableSearcher.getAttribute('targetUrl');
const baseUrl = titleTableSearcher.getAttribute('baseUrl');
let posts;
var ajaxDeleteSearcher;
var statusChangerSearcher;


titleTableSearcher.oninput = function() {
    tableSearcherOutput.innerHTML = '';
    titleSearch()
}


function titleSearch() {


    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var jsonData = JSON.parse(xmlHttp.responseText);

            let documents = jsonData;
            console.log();

            if (targetUrl == baseUrl + 'admin/content/post/title-search') {
                addItemToFindPosts(documents);
            } else if (targetUrl == baseUrl + 'admin/user/user/title-search') {
                addItemToFindUsers(documents);
            } else if (targetUrl == baseUrl + 'admin/market/product/title-search') {
                addItemToFindProducts(documents);
            } else if (targetUrl == baseUrl + 'admin/market/store/title-search') {
                addItemToFindStores(documents);
            } else if (targetUrl == baseUrl + 'admin/market/category-attribute/title-search') {
                addItemToFindCategoryAttributes(documents);
            }

        }
    }
    xmlHttp.open('POST', targetUrl, true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    let data = { "value": titleTableSearcher.value };
    data = JSON.stringify(data)
    xmlHttp.send(data);
}


function addItemToFindPosts(posts) {

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







function addItemToFindUsers(users) {
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





function addItemToFindProducts(products) {

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








function addItemToFindStores(products) {

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






function addItemToFindCategoryAttributes(categoryAttributes) {

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