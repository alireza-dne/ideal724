<?php

use Activities\app\Home;

require_once 'lib/config.php';
require_once 'lib/helpers.php';
require_once 'database/DataBase.php';
require_once 'activities/admin/Admin.php';
require_once 'activities/auth/Auth.php';
require_once 'activities/admin/Dashboard.php';

//content
require_once 'activities/admin/content/PostCategory.php';
require_once 'activities/admin/content/Post.php';
require_once 'activities/admin/content/Comment.php';
require_once 'activities/admin/content/Banner.php';
require_once 'activities/admin/content/Faq.php';
require_once 'activities/admin/content/HeaderMenu.php';
require_once 'activities/admin/content/FooterMenu.php';


//user
require_once 'activities/admin/user/Admin.php';
require_once 'activities/admin/user/User.php';


//setting
require_once 'activities/admin/setting/Setting.php';




//market
require_once 'activities/admin/market/ProductCategory.php';
require_once 'activities/admin/market/Brand.php';
require_once 'activities/admin/market/Product.php';
require_once 'activities/admin/market/Store.php';
require_once 'activities/admin/market/CategoryAttribute.php';
require_once 'activities/admin/market/CategoryAttributeValue.php';
require_once 'activities/admin/market/Payment.php';
require_once 'activities/admin/market/Gallery.php';
require_once 'activities/admin/market/Delivery.php';
require_once 'activities/admin/market/Discount.php';
require_once 'activities/admin/market/Order.php';



//auth
require_once 'activities/auth/Auth.php';


//app
require_once 'activities/app/Home.php';
require_once 'activities/app/App.php';
require_once 'activities/app/Order.php';




require_once 'rout/routing.php';
require_once 'rout/web.php';




$home = new Home;
$home->error404();
// echo '404 - not found';
exit;
