<?php


//dashboard
uri('admin', 'Activities\Admin\Dashboard', 'index');
uri('dashboard', 'Activities\Admin\Dashboard', 'index');



//CONTENT


//post-category
uri('admin/content/post-category', 'Activities\Admin\content\PostCategory', 'index');
uri('admin/content/post-category/create', 'Activities\Admin\content\PostCategory', 'create');
uri('admin/content/post-category/store', 'Activities\Admin\content\PostCategory', 'store', 'POST');
uri('admin/content/post-category/chane-status', 'Activities\Admin\content\PostCategory', 'changeStatus', 'POST');
uri('admin/content/post-category/delete/{id}', 'Activities\Admin\content\PostCategory', 'delete');
uri('admin/content/post-category/edit/{id}', 'Activities\Admin\content\PostCategory', 'edit');
uri('admin/content/post-category/update/{id}', 'Activities\Admin\content\PostCategory', 'update', 'POST');


//post
uri('admin/content/post', 'Activities\Admin\content\Post', 'index');
uri('admin/content/post/create', 'Activities\Admin\content\Post', 'create');
uri('admin/content/post/store', 'Activities\Admin\content\Post', 'store', 'POST');
uri('admin/content/post/change-status', 'Activities\Admin\content\Post', 'changeStatus', 'POST');
uri('admin/content/post/change-commentable', 'Activities\Admin\content\Post', 'changeCommentable', 'POST');
uri('admin/content/post/delete/{id}', 'Activities\Admin\content\Post', 'delete');
uri('admin/content/post/edit/{id}', 'Activities\Admin\content\Post', 'edit');
uri('admin/content/post/update/{id}', 'Activities\Admin\content\Post', 'update', 'POST');
uri('admin/content/post/title-search', 'Activities\Admin\content\Post', 'titleSearch', 'POST');







//comment
uri('admin/content/comment', 'Activities\Admin\Content\Comment', 'index');
uri('admin/content/comment/show/{id}', 'Activities\Admin\Content\Comment', 'show');
uri('admin/content/comment/answer/{id}', 'Activities\Admin\Content\Comment', 'answer', 'POST');
uri('admin/content/comment/change-status', 'Activities\Admin\content\Comment', 'changeStatus', 'POST');



//banner
uri('admin/content/banner', 'Activities\Admin\content\Banner', 'index');
uri('admin/content/banner/create', 'Activities\Admin\content\Banner', 'create');
uri('admin/content/banner/store', 'Activities\Admin\content\Banner', 'store', 'POST');
uri('admin/content/banner/edit/{id}', 'Activities\Admin\content\Banner', 'edit');
uri('admin/content/banner/update/{id}', 'Activities\Admin\content\Banner', 'update', 'POST');
uri('admin/content/banner/delete/{id}', 'Activities\Admin\content\Banner', 'delete');


//faq
uri('admin/content/faq', 'Activities\Admin\content\Faq', 'index');
uri('admin/content/faq/create', 'Activities\Admin\content\Faq', 'create');
uri('admin/content/faq/store', 'Activities\Admin\content\Faq', 'store', 'POST');
uri('admin/content/faq/edit/{id}', 'Activities\Admin\content\Faq', 'edit');
uri('admin/content/faq/update/{id}', 'Activities\Admin\content\Faq', 'update', 'POST');
uri('admin/content/faq/delete/{id}', 'Activities\Admin\content\Faq', 'delete');


//header-menu
uri('admin/content/header-menu', 'Activities\Admin\content\HeaderMenu', 'index');
uri('admin/content/header-menu/create', 'Activities\Admin\content\HeaderMenu', 'create');
uri('admin/content/header-menu/store', 'Activities\Admin\content\HeaderMenu', 'store', 'POST');
uri('admin/content/header-menu/edit/{id}', 'Activities\Admin\content\HeaderMenu', 'edit');
uri('admin/content/header-menu/update/{id}', 'Activities\Admin\content\HeaderMenu', 'update', 'POST');
uri('admin/content/header-menu/delete/{id}', 'Activities\Admin\content\HeaderMenu', 'delete');


//footer-menu
uri('admin/content/footer-menu', 'Activities\Admin\content\FooterMenu', 'index');
uri('admin/content/footer-menu/create', 'Activities\Admin\content\FooterMenu', 'create');
uri('admin/content/footer-menu/store', 'Activities\Admin\content\FooterMenu', 'store', 'POST');
uri('admin/content/footer-menu/edit/{id}', 'Activities\Admin\content\FooterMenu', 'edit');
uri('admin/content/footer-menu/update/{id}', 'Activities\Admin\content\FooterMenu', 'update', 'POST');
uri('admin/content/footer-menu/delete/{id}', 'Activities\Admin\content\FooterMenu', 'delete');

/////////////////////////////////////////////////

//user


//admin
uri('admin/user/admin', 'Activities\Admin\User\Admin', 'index');
uri('admin/user/admin/edit/{id}', 'Activities\Admin\User\Admin', 'edit');
uri('admin/user/admin/update/{id}', 'Activities\Admin\User\Admin', 'update', 'POST');

//user
uri('admin/user/user', 'Activities\Admin\User\User', 'index');
uri('admin/user/user/edit/{id}', 'Activities\Admin\User\User', 'edit');
uri('admin/user/user/update/{id}', 'Activities\Admin\User\User', 'update', 'POST');
uri('admin/user/user/title-search', 'Activities\Admin\User\User', 'titleSearch', 'POST');




/////////////////////////////////////////////////////


//setting
uri('admin/setting', 'Activities\Admin\Setting\Setting', 'index');
uri('admin/setting/create', 'Activities\Admin\Setting\Setting', 'create');
uri('admin/setting/store', 'Activities\Admin\Setting\Setting', 'store', 'POST');
uri('admin/setting/edit/{id}', 'Activities\Admin\Setting\Setting', 'edit');
uri('admin/setting/update/{id}', 'Activities\Admin\Setting\Setting', 'update', 'POST');




/////////////////////////////////////////////////////

//MARKET


//product category
uri('admin/market/product-category', 'Activities\Admin\Market\ProductCategory', 'index');
uri('admin/market/product-category/create', 'Activities\Admin\Market\ProductCategory', 'create');
uri('admin/market/product-category/store', 'Activities\Admin\Market\ProductCategory', 'store', 'POST');
uri('admin/market/product-category/chane-status', 'Activities\Admin\Market\ProductCategory', 'changeStatus', 'POST');
uri('admin/market/product-category/delete/{id}', 'Activities\Admin\Market\ProductCategory', 'delete');
uri('admin/market/product-category/edit/{id}', 'Activities\Admin\Market\ProductCategory', 'edit');
uri('admin/market/product-category/update/{id}', 'Activities\Admin\Market\ProductCategory', 'update', 'POST');


//brand
uri('admin/market/brand', 'Activities\Admin\Market\Brand', 'index');
uri('admin/market/brand/create', 'Activities\Admin\Market\Brand', 'create');
uri('admin/market/brand/store', 'Activities\Admin\Market\Brand', 'store', 'POST');
uri('admin/market/brand/chane-status', 'Activities\Admin\Market\Brand', 'changeStatus', 'POST');
uri('admin/market/brand/delete/{id}', 'Activities\Admin\Market\Brand', 'delete');
uri('admin/market/brand/edit/{id}', 'Activities\Admin\Market\Brand', 'edit');
uri('admin/market/brand/update/{id}', 'Activities\Admin\Market\Brand', 'update', 'POST');



//product
uri('admin/market/product', 'Activities\Admin\Market\Product', 'index');
uri('admin/market/product/create', 'Activities\Admin\Market\Product', 'create');
uri('admin/market/product/store', 'Activities\Admin\Market\Product', 'store', 'POST');
uri('admin/market/product/chane-status', 'Activities\Admin\Market\Product', 'changeStatus', 'POST');
uri('admin/market/product/delete/{id}', 'Activities\Admin\Market\Product', 'delete');
uri('admin/market/product/edit/{id}', 'Activities\Admin\Market\Product', 'edit');
uri('admin/market/product/update/{id}', 'Activities\Admin\Market\Product', 'update', 'POST');
uri('admin/market/product/show/{id}', 'Activities\Admin\Market\Product', 'show');
uri('admin/market/product/title-search', 'Activities\Admin\Market\Product', 'titleSearch', 'POST');
uri('admin/market/product/show/{id}', 'Activities\Admin\Market\Product', 'show');
uri('admin/market/product/table/{id}', 'Activities\Admin\Market\Product', 'table');




//store
uri('admin/market/store', 'Activities\Admin\Market\Store', 'index');
uri('admin/market/store/edit/{productID}', 'Activities\Admin\Market\Store', 'edit');
uri('admin/market/store/update/{productID}', 'Activities\Admin\Market\Store', 'update', 'POST');
uri('admin/market/store/add-form/{productID}', 'Activities\Admin\Market\Store', 'addForm');
uri('admin/market/store/add/{productID}', 'Activities\Admin\Market\Store', 'add', 'POST');
uri('admin/market/store/title-search', 'Activities\Admin\Market\Store', 'titleSearch', 'POST');



//category_attribute
uri('admin/market/category-attribute', 'Activities\Admin\Market\CategoryAttribute', 'index');
uri('admin/market/category-attribute/create', 'Activities\Admin\Market\CategoryAttribute', 'create');
uri('admin/market/category-attribute/store', 'Activities\Admin\Market\CategoryAttribute', 'store', 'POST');
uri('admin/market/category-attribute/edit/{id}', 'Activities\Admin\Market\CategoryAttribute', 'edit');
uri('admin/market/category-attribute/update/{id}', 'Activities\Admin\Market\CategoryAttribute', 'update', 'POST');
uri('admin/market/category-attribute/delete/{id}', 'Activities\Admin\Market\CategoryAttribute', 'delete');
uri('admin/market/category-attribute/title-search', 'Activities\Admin\Market\CategoryAttribute', 'titleSearch', 'POST');



//category_attribute_value
uri('admin/market/category-attribute-value/{categoryAttributeID}', 'Activities\Admin\Market\CategoryAttributeValue', 'index');
uri('admin/market/category-attribute-value/{categoryAttributeID}/create', 'Activities\Admin\Market\CategoryAttributeValue', 'create');
uri('admin/market/category-attribute-value/{categoryAttributeID}/store', 'Activities\Admin\Market\CategoryAttributeValue', 'store', 'POST');
uri('admin/market/category-attribute-value/{categoryAttributeID}/edit/{id}', 'Activities\Admin\Market\CategoryAttributeValue', 'edit');
uri('admin/market/category-attribute-value/{categoryAttributeID}/update/{id}', 'Activities\Admin\Market\CategoryAttributeValue', 'update', 'POST');
uri('admin/market/category-attribute-value/delete/{id}', 'Activities\Admin\Market\CategoryAttributeValue', 'delete');




//payment
uri('admin/market/payment', 'Activities\Admin\Market\Payment', 'index');
uri('admin/market/payment/change-status', 'Activities\Admin\Market\Payment', 'changeStatus', 'POST');



//product/{}/gallery
uri('admin/market/product/{productID}/gallery', 'Activities\Admin\Market\Gallery', 'index');
uri('admin/market/product/{productID}/gallery/create', 'Activities\Admin\Market\Gallery', 'create');
uri('admin/market/product/{productID}/gallery/store', 'Activities\Admin\Market\Gallery', 'store', 'POST');
uri('admin/market/gallery/edit/{id}', 'Activities\Admin\Market\Gallery', 'edit');
uri('admin/market/gallery/update/{id}', 'Activities\Admin\Market\Gallery', 'update', 'POST');
uri('admin/market/gallery/delete/{id}', 'Activities\Admin\Market\Gallery', 'delete');



//delivery
uri('admin/market/delivery', 'Activities\Admin\Market\Delivery', 'index');
uri('admin/market/delivery/create', 'Activities\Admin\Market\Delivery', 'create');
uri('admin/market/delivery/store', 'Activities\Admin\Market\Delivery', 'store', 'POST');
uri('admin/market/delivery/delete/{id}', 'Activities\Admin\Market\Delivery', 'delete');
uri('admin/market/delivery/edit/{id}', 'Activities\Admin\Market\Delivery', 'edit');
uri('admin/market/delivery/update/{id}', 'Activities\Admin\Market\Delivery', 'update', 'POST');


//discount
uri('admin/market/discount', 'Activities\Admin\Market\Discount', 'index');
uri('admin/market/discount/create', 'Activities\Admin\Market\Discount', 'create');
uri('admin/market/discount/store', 'Activities\Admin\Market\Discount', 'store', 'POST');
uri('admin/market/discount/delete/{id}', 'Activities\Admin\Market\Discount', 'delete');
uri('admin/market/discount/edit/{id}', 'Activities\Admin\Market\Discount', 'edit');
uri('admin/market/discount/update/{id}', 'Activities\Admin\Market\Discount', 'update', 'POST');
uri('admin/market/discount/title-search-code', 'Activities\Admin\Market\Discount', 'titleSearchCode', 'POST');
uri('admin/market/discount/title-search-user', 'Activities\Admin\Market\Discount', 'titleSearchUser', 'POST');




//order
uri('admin/market/order', 'Activities\Admin\Market\Order', 'index');
// uri('admin/market/order/edit/{id}', 'Activities\Admin\Market\Order', 'edit');
// uri('admin/market/order/update/{id}', 'Activities\Admin\Market\Order', 'update', 'POST');
uri('admin/market/order/show/{id}', 'Activities\Admin\Market\Order', 'show');
uri('admin/market/order/items/{orderID}', 'Activities\Admin\Market\Order', 'items');
uri('admin/market/order/title-search', 'Activities\Admin\Market\Order', 'titleSearch', 'POST');







// auth
uri('login-register', 'Activities\Auth\Auth', 'loginRegister');
uri('register-store', 'Activities\Auth\Auth', 'store', 'POST');
uri('activation/{verify_token}', 'Activities\Auth\Auth', 'activation');
uri('login', 'Activities\Auth\Auth', 'login', 'POST');
uri('forget-password', 'Activities\Auth\Auth', 'forgetPassword');
uri('forget-password-store', 'Activities\Auth\Auth', 'forgetPasswordStore', 'POST');
uri('reset-password/{verify_token}', 'Activities\Auth\Auth', 'resetPassword');
uri('reset-password-store', 'Activities\Auth\Auth', 'resetPasswordStore', 'POST');
uri('logout', 'Activities\Auth\Auth', 'logout');
uri('change-profile-info', 'Activities\Auth\Auth', 'changeProfileInfo', 'POST');







// Home
uri('/', 'Activities\App\Home', 'index');
uri('', 'Activities\App\Home', 'index');
uri('home', 'Activities\App\Home', 'index');
uri('header-search-box', 'Activities\App\Home', 'headerSearchBox', 'POST');
uri('about-us', 'Activities\App\Home', 'aboutUs');
uri('my-profile', 'Activities\App\Home', 'myProfile');
uri('error-404', 'Activities\App\Home', 'error404');





//App
uri('product-category/{id}', 'Activities\App\App', 'productCategory');
uri('product/{id}', 'Activities\App\App', 'product');
uri('comment-store/{productId}', 'Activities\App\App', 'commentStore', 'POST');
uri('post/{id}', 'Activities\App\App', 'post');
uri('post-comment-store/{postId}', 'Activities\App\App', 'postCommentStore', 'POST');
uri('brand/{id}', 'Activities\App\App', 'brand');
uri('products', 'Activities\App\App', 'products');
uri('posts', 'Activities\App\App', 'posts');
uri('brands', 'Activities\App\App', 'brands');



// order
uri('order/{productId}', 'Activities\App\Order', 'order');
uri('order-store', 'Activities\App\Order', 'orderStore', 'POST');
