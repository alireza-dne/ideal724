<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class CategoryAttribute extends Admin
{

    public function getAllCategories($categoryId)
    {
        $db = new DataBase;
        $category = $db->select('select * from product_categories where id=?', [$categoryId])->fetch();
        if ($category['parent_id'] != null) {
            $parentCategory = $this->getAllCategories($category['parent_id']);
            $category = array_merge([$parentCategory], [$category]);
        }
        $db->closeConnection();

        return $category;
    }


    public function index()
    {
        $db = new DataBase;
        $categoryAttributes = $db->select('SELECT category_attributes.*,product_categories.name AS product_category_name FROM category_attributes LEFT JOIN product_categories ON category_attributes.product_category_id=product_categories.id order by category_attributes.created_at desc');
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/category-attribute/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $categories = $db->select('select * from product_categories where status=1 order by name');
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/category-attribute/create.php');
    }


    public function store($request)
    {


        if (!$request['name'] || !$request['product_category_id']) {
            flash('validation-error', "پرکردن فیلدهای نام و دسته بندی اجباری می باشد");
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['product_category_id'] = input_data($request['product_category_id']);

        $db = new DataBase;
        $db->insert('category_attributes', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'ویژگی با موفقیت اضافه شد');
        $this->redirect('admin/market/category-attribute');
    }






    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'ویژگی یافت نشد');
            $this->redirect('admin/market/category-attribute');
        }
        $id = input_data($id);
        $db = new DataBase;
        $categoryAttribute = $db->select('select * from category_attributes where id=?', [$id])->fetch();

        if (!$categoryAttribute) {
            flash('validation-error', 'ویژگی یافت نشد');
            $this->redirect('admin/market/category-attribute');
        }
        $categories = $db->select('select * from product_categories where status=1 order by name');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/category-attribute/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'ویژگی یافت نشد');
            $this->redirect('admin/market/category-attribute');
        }
        $id = input_data($id);
        $db = new DataBase;
        $categoryAttribute = $db->select('select * from category_attributes where id=?', [$id])->fetch();

        if (!$categoryAttribute) {
            flash('validation-error', 'ویژگی یافت نشد');
            $this->redirect('admin/market/category-attribute');
        }


        if (!$request['name'] || !$request['product_category_id']) {
            flash('validation-error', "پرکردن فیلدهای نام و دسته بندی اجباری می باشد");
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['product_category_id'] = input_data($request['product_category_id']);


        $db->update('category_attributes', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'محصول با موفقیت اصلاح شد');
        $this->redirect('admin/market/category-attribute');
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
        $categoryAttribute = $db->select('select * from category_attributes where id=?', [$id])->fetch();

        if (!$categoryAttribute) {
            $message = ["status" => false, "message" => "ویژگی مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        $db->delete('category_attributes', $id);
        $message = ["status" => true, "message" => "ویژگی مد نظر حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }




    public function titleSearch()
    {
        $json = file_get_contents('php://input');
        $value = json_decode($json, true)['value'];
        $value = input_data($value);

        $db = new DataBase;
        $categoryAttributes = $db->select("SELECT category_attributes.*,product_categories.name AS product_category_name FROM category_attributes LEFT JOIN product_categories ON category_attributes.product_category_id=product_categories.id where category_attributes.name like '%$value%' ")->fetchAll();
        $db->closeConnection();
        echo json_encode($categoryAttributes);
        exit;
    }
}
