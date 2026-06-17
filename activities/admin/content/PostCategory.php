<?php

namespace Activities\Admin\Content;

use Activities\Admin\Admin;
use Database\DataBase;

class PostCategory extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $categories = $db->select('select * from post_categories order by created_at desc');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/post-category/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/post-category/create.php');
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
        // $request['image'] = input_data($request['image']);
        $request['status'] = input_data($request['status']);

        $request['image'] = saveImage($request['image'], 'admin/post-category-image');

        if (!$request['image']) {
            flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
            $this->redirectBack();
        }
        $db = new DataBase;
        $db->insert('post_categories', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'دسته بندی با موفقیت اضافه شد');
        $this->redirect('admin/content/post-category');
    }

    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'دسته بندی یافت نشد');
            $this->redirect('admin/content/post-category');
        }
        $id = input_data($id);
        $db = new DataBase;
        $category = $db->select('select * from post_categories where id=?', [$id])->fetch();
        $setting = $db->select('select * from settings')->fetch();


        if (!$category) {
            flash('validation-error', 'دسته بندی یافت نشد');
            $this->redirect('admin/content/post-category');
        }
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/post-category/edit.php');
    }



    public function update($request, $id)
    {
        if (!$request['name']) {
            flash('validation-error', 'پر کردن فیلد نام اجباری می باشد');
            $this->redirectBack();
        }

        if (!isset($id) || $id == null) {
            flash('validation-error', 'دسته بندی یافت نشد');
            $this->redirect('admin/content/post-category');
        }
        $id = input_data($id);
        $db = new DataBase;
        $category = $db->select('select * from post_categories where id=?', [$id])->fetch();

        if (!$category) {
            flash('validation-error', 'دسته بندی یافت نشد');
            $this->redirect('admin/content/post-category');
        }



        $request['name'] = input_data($request['name']);
        $request['description'] = input_data($request['description']);
        $request['slug'] = input_data($request['slug']);
        // $request['image'] = input_data($request['image']);
        $request['status'] = input_data($request['status']);


        if ($request['image']['tmp_name'] != '') {
            removeImage($category['image']);
            $request['image'] = saveImage($request['image'], 'admin/post-category-image');

            if (!$request['image']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        } else {
            unset($request['image']);
        }

        $db->update('post_categories', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'دسته بندی با موفقیت اصلاح شد');
        $this->redirect('admin/content/post-category');
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
        $category = $db->select('select * from post_categories where id=?', [$id])->fetch();

        if (!$category) {
            $message = ["status" => false, "message" => "دسته بندی مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        removeImage($category['image']);
        $db->delete('post_categories', $id);
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
        $category = $db->select('select * from post_categories where id=?', [$id])->fetch();

        if (!$category) {
            $message = ["status" => false, "message" => "دسته بندی مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }

        if ($category['status'] == 1) {
            $db->update('post_categories', $id, ['status'], [2]);
        } else {
            $db->update('post_categories', $id, ['status'], [1]);
        }
        $message = ["status" => true, "message" => "عملیات با موفقیت انجام شد"];
        // echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
