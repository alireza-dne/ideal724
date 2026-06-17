<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class categoryAttributeValue extends Admin
{

    public function index($categoryAttributeID)
    {
        $db = new DataBase;
        $categoryAttributeID = input_data($categoryAttributeID);

        $categoryAttribute = $db->select('select * from category_attributes where id=?', [$categoryAttributeID])->fetch();


        if (!$categoryAttribute) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute');
        }

        $categoryAttributeValues = $db->select('SELECT category_attribute_values.*,products.name as product_name FROM category_attribute_values JOIN products ON category_attribute_values.product_id=products.id WHERE category_attribute_values.category_attribute_id=? ORDER BY category_attribute_values.created_at DESC', [$categoryAttributeID])->fetchAll();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/category-attribute-value/index.php');
    }


    public function create($categoryAttributeID)
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $categoryAttributeID = input_data($categoryAttributeID);

        $categoryAttribute = $db->select('select * from category_attributes where id=?', [$categoryAttributeID])->fetch();


        if (!$categoryAttribute) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute');
        }

        $products = $db->select('select * from products order by created_at desc');
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/category-attribute-value/create.php');
    }


    public function store($request, $categoryAttributeID)
    {

        $db = new DataBase;
        $categoryAttributeID = input_data($categoryAttributeID);

        $categoryAttribute = $db->select('select * from category_attributes where id=?', [$categoryAttributeID])->fetch();


        if (!$categoryAttribute) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute');
        }

        if (!$request['value'] || !$request['product_id']) {
            flash('validation-error', "پرکردن مقدار و محصول اجباری می باشد");
            $this->redirectBack();
        }

        $request['value'] = input_data($request['value']);
        $request['product_id'] = input_data($request['product_id']);
        $request['increase_price'] = input_data($request['increase_price']);
        $request['type'] = input_data($request['type']);
        $request['category_attribute_id'] = $categoryAttributeID;

        if ($request['increase_price'] == null) {
            $request['increase_price'] = 0;
        }

        if (!is_numeric($request['increase_price'])) {
            flash('validation-error', "تاثیر قیمت فقط باید عدد باشد");
            $this->redirectBack();
        }

        $value = ['value' => $request['value'], 'increase_price' => $request['increase_price']];
        unset($request['increase_price']);
        $request['value'] = json_encode($value, JSON_UNESCAPED_UNICODE);
        $db->insert('category_attribute_values', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'مقادیر  با موفقیت اضافه شد');
        $this->redirect('admin/market/category-attribute-value/' . $categoryAttributeID);
    }






    public function edit($categoryAttributeID, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute-value/' . $categoryAttributeID);
        }
        $id = input_data($id);
        $db = new DataBase;

        $categoryAttributeValue = $db->select('select * from category_attribute_values where id=?', [$id])->fetch();

        if (!$categoryAttributeValue) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute-value/' . $categoryAttributeID);
        }

        $categoryAttributeID = input_data($categoryAttributeID);
        $categoryAttribute = $db->select('select * from category_attributes where id=?', [$categoryAttributeID])->fetch();


        if (!$categoryAttribute) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute-value/' . $categoryAttributeID);
        }


        $setting = $db->select('select * from settings')->fetch();
        $products = $db->select('select * from products order by created_at desc');

        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/category-attribute-value/edit.php');
    }



    public function update($request, $categoryAttributeID, $id)
    {

        $id = input_data($id);
        $db = new DataBase;

        $categoryAttributeValue = $db->select('select * from category_attribute_values where id=?', [$id])->fetch();

        if (!$categoryAttributeValue) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute-value/' . $categoryAttributeID);
        }


        $categoryAttributeID = input_data($categoryAttributeID);
        $categoryAttribute = $db->select('select * from category_attributes where id=?', [$categoryAttributeID])->fetch();


        if (!$categoryAttribute) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute-value/' . $categoryAttributeID);
        }

        if (!$request['value'] || !$request['product_id']) {
            flash('validation-error', "پرکردن مقدار و محصول اجباری می باشد");
            $this->redirectBack();
        }

        $request['value'] = input_data($request['value']);
        $request['product_id'] = input_data($request['product_id']);
        $request['increase_price'] = input_data($request['increase_price']);
        $request['type'] = input_data($request['type']);
        $request['category_attribute_id'] = $categoryAttributeID;

        if ($request['increase_price'] == null) {
            $request['increase_price'] = 0;
        }

        if (!is_numeric($request['increase_price'])) {
            flash('validation-error', "تاثیر قیمت فقط باید عدد باشد");
            $this->redirectBack();
        }

        $value = ['value' => $request['value'], 'increase_price' => $request['increase_price']];
        unset($request['increase_price']);
        $request['value'] = json_encode($value, JSON_UNESCAPED_UNICODE);
        $db->update('category_attribute_values', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'مقادیر  با موفقیت اصلاح شد');
        $this->redirect('admin/market/category-attribute-value/' . $categoryAttributeID);
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "ویژگی مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $categoryAttributeValue = $db->select('select * from category_attribute_values where id=?', [$id])->fetch();

        if (!$categoryAttributeValue) {
            $message = ["status" => false, "message" => "ویژگی مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        $db->delete('category_attribute_values', $id);
        $message = ["status" => true, "message" => "ویژگی مد نظر حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
