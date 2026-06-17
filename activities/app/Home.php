<?php

namespace Activities\App;

use Database\DataBase;

class Home
{
    public function index()
    {
        $db = new DataBase;
        $mostViewProducts = $db->select("SELECT products.id,products.name,products.image,brands.english_name FROM products LEFT JOIN brands ON products.brand_id=brands.id WHERE products.status=1 ORDER BY products.view DESC LIMIT 0,10");
        $posts = $db->select('SELECT * FROM posts WHERE status=1 AND published_at < NOW() ORDER BY created_at DESC LIMIT 0,3');
        $banners = $db->select('SELECT * FROM banners WHERE status=1 ORDER BY created_at DESC');



        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/index.php');
    }

    public function headerSearchBox()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json, true);
        $value = input_data($request['value']);
        $db = new DataBase;
        $products = $db->select("SELECT * FROM `products` WHERE name LIKE '%$value%';")->fetchAll();
        $db->closeConnection();
        echo json_encode($products);
        exit;
    }

    public function aboutUs()
    {
        $db = new DataBase;


        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/about-us.php');
    }

    public function myProfile()
    {
        if (!isset($_SESSION['user']) || $_SESSION == '') {
            redirect('login-register');
        }

        $db = new DataBase;
        $userId = input_data($_SESSION['user']);
        $user = $db->select("SELECT * FROM users WHERE id=? AND is_active=1", [$userId])->fetch();
        if (!$user) {
            redirect('/');
        }



        $db = new DataBase;


        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/my-profile.php');
    }



    public function error404()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/error-404.php');
    }
}
