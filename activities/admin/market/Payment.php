<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class Payment extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $payments = $db->select('SELECT payments.*,users.email FROM payments JOIN users ON payments.user_id=users.id ORDER BY payments.created_at DESC');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/payment/index.php');
    }

    public function titleSearch()
    {
        $json = file_get_contents('php://input');
        $value = json_decode($json, true)['value'];
        $value = input_data($value);

        $db = new DataBase;
        $products = $db->select("select * from products where name like '%$value%' ")->fetchAll();
        $db->closeConnection();
        echo json_encode($products);
        exit;
    }






    public function changeStatus()
    {
        $json = file_get_contents('php://input');
        $id = json_decode($json, true)['id'];
        $value = json_decode($json, true)['value'];



        $id = input_data($id);
        $db = new DataBase;
        $payment = $db->select('select * from payments where id=?', [$id])->fetch();


        if (!$payment) {
            $message = ["status" => false, "message" => "پرداخت مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }



        if ($value == 0) {
            $db->update('payments', $id, ['status'], [0]);
        } elseif ($value == 1) {
            $db->update('payments', $id, ['status'], [1]);
        } else {
            $db->update('payments', $id, ['status'], [2]);
        }
        $message = ["status" => true, "message" => "عملیات با موفقیت انجام شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
