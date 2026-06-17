<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class Gallery extends Admin
{

    public function index($productId)
    {
        if (!isset($productId) || $productId == null) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }

        $db = new DataBase;
        $productId = input_data($productId);
        $product = $db->select('select * from products where id=?', [$productId])->fetch();
        if (!$product) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }
        $setting = $db->select('select * from settings')->fetch();
        $galleries = $db->select('SELECT * from galleries where product_id=? order by created_at desc', [$productId])->fetchAll();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/gallery/index.php');
    }


    public function create($productId)
    {
        $db = new DataBase;
        $productId = input_data($productId);

        $product = $db->select('select * from products where id=?', [$productId])->fetch();

        if (!$product) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/gallery/create.php');
    }


    public function store($request, $productId)
    {

        $db = new DataBase;
        $productId = input_data($productId);

        $product = $db->select('select * from products where id=?', [$productId])->fetch();


        if (!$product) {
            flash('validation-error', "مقادیر مد نظر یافت نشد");
            $this->redirect('admin/market/category-attribute');
        }


        if (!$request['image']['tmp_name']) {
            flash('validation-error', "پرکردن مقدار عکس اجباری می باشد");
            $this->redirectBack();
        }


        $request['image'] = saveImage($request['image'], 'admin/gallery-image');


        if (!$request['image']) {
            flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
            $this->redirectBack();
        }
        $request['product_id'] = $product['id'];

        $db->insert('galleries', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'گالری تصویر  با موفقیت اضافه شد');
        $this->redirect('admin/market/product/' . $product['id'] . '/gallery');
    }






    public function edit($id)
    {

        if (!isset($id) || $id == null) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }

        $id = input_data($id);
        $db = new DataBase;

        $gallery = $db->select('select * from galleries where id=?', [$id])->fetch();

        if (!$gallery) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }

        $product = $db->select('select * from products where id=?', [$gallery['product_id']])->fetch();

        if (!$product) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/gallery/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }

        $id = input_data($id);
        $db = new DataBase;

        $gallery = $db->select('select * from galleries where id=?', [$id])->fetch();

        if (!$gallery) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }

        $product = $db->select('select * from products where id=?', [$gallery['product_id']])->fetch();

        if (!$product) {
            flash('validation-error', "گالری تصاویر مد نظر یافت نشد");
            $this->redirect('admin/market/product');
        }

        if (!$request['image']['tmp_name']) {
            flash('validation-error', "پرکردن مقدار عکس اجباری می باشد");
            $this->redirectBack();
        } else {
            removeImage($gallery['image']);
            $request['image'] = saveImage($request['image'], 'admin/gallery-image');

            if (!$request['image']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        }
        $db->update('galleries', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'گالری  با موفقیت اصلاح شد');
        $this->redirect('admin/market/product/' . $product['id'] . '/gallery');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "گالری مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $gallery = $db->select('select * from galleries where id=?', [$id])->fetch();

        if (!$gallery) {
            $message = ["status" => false, "message" => "گالری مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        removeImage($gallery['image']);
        $db->delete('galleries', $id);
        $message = ["status" => true, "message" => "گالری مد نظر حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
