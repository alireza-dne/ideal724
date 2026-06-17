<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class ProductCategory extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $categories = $db->select('SELECT p1.*,p2.name AS parent_name FROM product_categories p1 left JOIN product_categories p2 ON p1.parent_id=p2.id ORDER BY p1.created_at DESC');

        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/product-category/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $categories = $db->select('SELECT p1.*,p2.name AS parent_name FROM product_categories p1 left JOIN product_categories p2 ON p1.parent_id=p2.id where p1.parent_id is null ORDER BY p1.name DESC');
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/product-category/create.php');
    }


    public function store($request)
    {
        if (!$request['name'] || !$request['image']['tmp_name'] || !isset($request['image'])) {
            flash('validation-error', 'پر کردن فیلد های نام و تصویر اجباری می باشد');
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['description'] = input_data($request['description']);
        $request['slug'] = input_data($request['slug']);
        $request['status'] = input_data($request['status']);
        $request['show_in_menu'] = input_data($request['show_in_menu']);
        $request['parent_id'] = input_data($request['parent_id']);

        if ($request['parent_id'] == 'parent') {
            $request['parent_id'] = null;
        }


        $request['image'] = saveImage($request['image'], 'admin/product-category-image');

        if (!$request['image']) {
            flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
            $this->redirectBack();
        }

        $db = new DataBase;
        $db->insert('product_categories', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'دسته بندی با موفقیت اضافه شد');
        $this->redirect('admin/market/product-category');
    }

    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'دسته بندی یافت نشد');
            $this->redirect('admin/market/product-category');
        }
        $id = input_data($id);
        $db = new DataBase;
        $category = $db->select('select * from product_categories where id=?', [$id])->fetch();

        if (!$category) {
            flash('validation-error', 'دسته بندی یافت نشد');
            $this->redirect('admin/market/product-category');
        }
        $categories = $db->select('SELECT * from product_categories where parent_id is null ORDER BY name DESC');
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/product-category/edit.php');
    }



    public function update($request, $id)
    {
        if (!$request['name']) {
            flash('validation-error', 'پر کردن فیلد نام اجباری می باشد');
            $this->redirectBack();
        }

        if (!isset($id) || $id == null) {
            flash('validation-error', 'دسته بندی یافت نشد');
            $this->redirect('admin/market/product-category');
        }

        $id = input_data($id);
        $db = new DataBase;
        $category = $db->select('select * from product_categories where id=?', [$id])->fetch();
        $setting = $db->select('select * from settings')->fetch();

        if (!$category) {
            flash('validation-error', 'دسته بندی یافت نشد');
            $this->redirect('admin/market/product-category');
        }


        $request['name'] = input_data($request['name']);
        $request['description'] = input_data($request['description']);
        $request['slug'] = input_data($request['slug']);
        $request['status'] = input_data($request['status']);
        $request['show_in_menu'] = input_data($request['show_in_menu']);
        $request['parent_id'] = input_data($request['parent_id']);

        if ($request['parent_id'] == 'parent') {
            $request['parent_id'] = null;
        }


        if ($request['image']['tmp_name'] != '') {
            removeImage($category['image']);
            $request['image'] = saveImage($request['image'], 'admin/product-category-image');

            if (!$request['image']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        } else {
            unset($request['image']);
        }

        $db->update('product_categories', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'دسته بندی با موفقیت اصلاح شد');
        $this->redirect('admin/market/product-category');
    }





    public function delete($id)
    {
        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "دسته بندی مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $category = $db->select('select * from product_categories where id=?', [$id])->fetch();

        if (!$category) {
            $message = ["status" => false, "message" => "دسته بندی مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        removeImage($category['image']);
        $db->delete('product_categories', $id);
        $message = ["status" => true, "message" => "دسته بندی مد نظر حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }






    public function changeStatus()
    {
        $json = file_get_contents('php://input');
        $id = json_decode($json, true)['id'];


        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "دسته بندی مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $category = $db->select('select * from product_categories where id=?', [$id])->fetch();

        if (!$category) {
            $message = ["status" => false, "message" => "دسته بندی مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }

        if ($category['status'] == 1) {
            $db->update('product_categories', $id, ['status'], [2]);
        } else {
            $db->update('product_categories', $id, ['status'], [1]);
        }
        $message = ["status" => true, "message" => "عملیات با موفقیت انجام شد"];
        // echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
