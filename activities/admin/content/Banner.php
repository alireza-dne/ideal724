<?php

namespace Activities\Admin\Content;

use Activities\Admin\Admin;
use Database\DataBase;

class Banner extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $banners = $db->select('select * from banners order by created_at desc');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/banner/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/banner/create.php');
    }


    public function store($request)
    {


        if (!$request['title'] || !$request['image']['tmp_name']) {
            flash('validation-error', 'پر کردن عنوان و تصویر اجباری می باشد');
            $this->redirectBack();
        }

        $request['title'] = input_data($request['title']);
        $request['position'] = input_data($request['position']);
        $request['url'] = input_data($request['url']);
        $request['image'] = saveImage($request['image'], 'admin/banner-image');


        if (!$request['image']) {
            flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
            $this->redirectBack();
        }

        $db = new DataBase;
        $db->insert('banners', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'بنر با موفقیت اضافه شد');
        $this->redirect('admin/content/banner');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'بنر یافت نشد');
            $this->redirect('admin/content/banner');
        }
        $id = input_data($id);
        $db = new DataBase;
        $banner = $db->select('select * from banners where id=?', [$id])->fetch();

        if (!$banner) {
            flash('validation-error', 'بنر یافت نشد');
            $this->redirect('admin/content/banner');
        }
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/banner/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'بنر یافت نشد');
            $this->redirect('admin/content/banner');
        }
        $id = input_data($id);
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $banner = $db->select('select * from banners where id=?', [$id])->fetch();

        if (!$banner) {
            flash('validation-error', 'بنر یافت نشد');
            $this->redirect('admin/content/banner');
        }



        if (!$request['title']) {
            flash('validation-error', 'پر کردن عنوان اجباری می باشد');
            $this->redirectBack();
        }

        $request['title'] = input_data($request['title']);
        $request['position'] = input_data($request['position']);
        $request['url'] = input_data($request['url']);


        if ($request['image']['tmp_name'] != '') {
            removeImage($banner['image']);
            $request['image'] = saveImage($request['image'], 'admin/banner-image');

            if (!$request['image']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        } else {
            unset($request['image']);
        }

        $db->update('banners', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'بنر با موفقیت اصلاح شد');
        $this->redirect('admin/content/banner');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "بنر مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $banner = $db->select('select * from banners where id=?', [$id])->fetch();

        if (!$banner) {
            $message = ["status" => false, "message" => "بنر مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        removeImage($banner['image']);
        $db->delete('banners', $id);
        $message = ["status" => true, "message" => "بنر مد نظر با موفقیت حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
