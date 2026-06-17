<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class Order extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $orders = $db->select('SELECT orders.*,users.email FROM orders LEFT JOIN users ON orders.user_id=users.id ORDER BY orders.created_at DESC');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/order/index.php');
    }





    public function show($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/order');
        }
        $id = input_data($id);
        $db = new DataBase;
        $order = $db->select('SELECT orders.*,users.email,addresses.address,addresses.city_id,payments.message,payments.tracking_code,deliveries.name AS delivery_name,discounts.code,cities.name AS city_name FROM orders LEFT JOIN users ON orders.user_id=users.id LEFT JOIN addresses ON orders.address_id=addresses.id LEFT JOIN payments ON orders.payment_id=payments.id LEFT JOIN deliveries ON orders.delivery_id=deliveries.id LEFT JOIN discounts ON orders.delivery_id=discounts.id LEFT JOIN cities ON addresses.city_id=cities.id WHERE orders.id=?', [$id])->fetch();

        if (!$order) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/order');
        }

        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/order/show.php');
    }


    public function items($orderID)
    {
        $db = new DataBase;
        $items = $db->select('SELECT order_items.*,products.name,products.id FROM order_items LEFT JOIN products ON order_items.product_id=products.id WHERE order_items.order_id=?', [$orderID])->fetchAll();
        $setting = $db->select('select * from settings')->fetch();

        require(BASE_PATH . '/template/admin/market/order/items.php');
    }



    public function titleSearch()
    {
        $json = file_get_contents('php://input');
        $value = json_decode($json, true)['value'];
        $value = input_data($value);

        $db = new DataBase;
        $orders = $db->select("SELECT orders.*,users.email FROM orders LEFT JOIN users ON orders.user_id=users.id where users.email like '%$value%' ")->fetchAll();
        $db->closeConnection();
        echo json_encode($orders);
        exit;
    }
}
