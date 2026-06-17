<?php

namespace Activities\Admin;

use Database\DataBase;
use Activities\Admin\Admin;


class Dashboard extends Admin
{
    public function index()
    {
        $db = new DataBase;

        $unseenComments = $db->select("SELECT COUNT(`id`) AS count FROM comments WHERE status='unseen'")->fetch();
        $users = $db->select("SELECT COUNT(`id`) AS count FROM users WHERE is_active=1")->fetch();
        $posts = $db->select("SELECT COUNT(`id`) AS count FROM posts")->fetch();
        $products = $db->select("SELECT COUNT(`id`) AS count FROM products")->fetch();



        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/index.php');
    }
}