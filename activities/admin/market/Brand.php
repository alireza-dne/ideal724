<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class Brand extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $brands = $db->select('select * from brands order by created_at desc');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/brand/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/brand/create.php');
    }


    public function store($request)
    {


        if (!$request['persian_name'] || !$request['image']['tmp_name']) {
            flash('validation-error', 'پر کردن نام فارسی و تصویر اجباری می باشد');
            $this->redirectBack();
        }

        $request['persian_name'] = input_data($request['persian_name']);
        $request['english_name'] = input_data($request['english_name']);
        $request['slug'] = input_data($request['slug']);
        $request['status'] = input_data($request['status']);

        $request['image'] = saveImage($request['image'], 'admin/brand-image');


        if (!$request['image']) {
            flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
            $this->redirectBack();
        }

        $db = new DataBase;
        $db->insert('brands', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'برند با موفقیت اضافه شد');
        $this->redirect('admin/market/brand');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'برند یافت نشد');
            $this->redirect('admin/market/brand');
        }
        $id = input_data($id);
        $db = new DataBase;
        $brand = $db->select('select * from brands where id=?', [$id])->fetch();

        if (!$brand) {
            flash('validation-error', 'برند یافت نشد');
            $this->redirect('admin/market/brand');
        }
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/brand/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'برند یافت نشد');
            $this->redirect('admin/market/brand');
        }
        $id = input_data($id);
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $brand = $db->select('select * from brands where id=?', [$id])->fetch();

        if (!$brand) {
            flash('validation-error', 'برند یافت نشد');
            $this->redirect('admin/market/brand');
        }



        if (!$request['persian_name']) {
            flash('validation-error', 'پر کردن نام فارسی و تصویر اجباری می باشد');
            $this->redirectBack();
        }

        $request['persian_name'] = input_data($request['persian_name']);
        $request['english_name'] = input_data($request['english_name']);
        $request['slug'] = input_data($request['slug']);
        $request['status'] = input_data($request['status']);


        if ($request['image']['tmp_name'] != '') {
            removeImage($brand['image']);
            $request['image'] = saveImage($request['image'], 'admin/brand-image');

            if (!$request['image']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        } else {
            unset($request['image']);
        }

        $db->update('brands', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'برند با موفقیت اصلاح شد');
        $this->redirect('admin/market/brand');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "برند مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $brand = $db->select('select * from brands where id=?', [$id])->fetch();

        if (!$brand) {
            $message = ["status" => false, "message" => "برند مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        removeImage($brand['image']);
        $db->delete('brands', $id);
        $message = ["status" => true, "message" => "برند مد نظر با موفقیت حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
