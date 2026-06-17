<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class Store extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $products = $db->select('select * from products order by created_at desc');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/store/index.php');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/store');
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('select * from products where id=?', [$id])->fetch();

        if (!$product) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/store');
        }
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/store/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/store');
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('select * from products where id=?', [$id])->fetch();

        if (!$product) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/store');
        }


        if ($request['sold_number'] == null) {
            $request['sold_number'] = 0;
        }

        if ($request['marketable_number'] == null) {
            $request['marketable_number'] = 0;
        }

        $request['marketable_number'] = input_data($request['marketable_number']);
        $request['sold_number'] = input_data($request['sold_number']);;


        if ($request['sold_number'] < 0 || $request['marketable_number'] < 0) {
            flash('validation-error', "مقادیر نمی تواند کوچکتر از صفر باشد");
            $this->redirectBack();
        }

        if (!is_numeric($request['sold_number']) || !is_numeric($request['marketable_number'])) {
            flash('validation-error', "مقادیر فقط باید در قالب عدد باشد");
            $this->redirectBack();
        }

        $db->update('products', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'محصول با موفقیت اصلاح شد');
        $this->redirect('admin/market/store');
    }




    public function addForm($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/store');
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('select * from products where id=?', [$id])->fetch();

        if (!$product) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/store');
        }
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/store/add-form.php');
    }



    public function add($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/store');
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('select * from products where id=?', [$id])->fetch();

        if (!$product) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/store');
        }


        if ($request['sold_number'] == null) {
            $request['sold_number'] = 0;
        }

        if ($request['marketable_number'] == null) {
            $request['marketable_number'] = 0;
        }

        $request['marketable_number'] = input_data($request['marketable_number']);
        $request['sold_number'] = input_data($request['sold_number']);;


        if (!is_numeric($request['sold_number']) || !is_numeric($request['marketable_number'])) {
            flash('validation-error', "مقادیر فقط باید در قالب عدد باشد");
            $this->redirectBack();
        }

        $request['sold_number'] = $request['sold_number'] + $product['sold_number'];
        $request['marketable_number'] = $request['marketable_number'] + $product['marketable_number'];


        $db->update('products', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'محصول با موفقیت اصلاح شد');
        $this->redirect('admin/market/store');
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
}
