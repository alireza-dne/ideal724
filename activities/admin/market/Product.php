<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class Product extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $products = $db->select('select * from products order by created_at desc');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/product/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $categories = $db->select('select * from product_categories order by name');
        $brands = $db->select('select * from brands order by persian_name');
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/product/create.php');
    }


    public function store($request)
    {


        if (!$request['name'] || !$request['image']['tmp_name'] || !$request['description'] || !$request['status']  || !$request['brand_id'] || !$request['product_category_id']) {
            flash('validation-error', "پرکردن فیلدهای نام، محتوا محصول، برند، دسته بندی و تصویر اجباری می باشد");
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['description'] = input_data($request['description']);
        $request['status'] = input_data($request['status']);
        $request['slug'] = input_data($request['slug']);
        $request['width'] = input_data($request['width']);
        $request['height'] = input_data($request['height']);
        $request['length'] = input_data($request['length']);
        $request['weight'] = input_data($request['weight']);
        $request['price'] = input_data($request['price']);
        $request['brand_id'] = input_data($request['brand_id']);
        $request['product_category_id'] = input_data($request['product_category_id']);


        if ($request['price'] < 0) {
            flash('validation-error', "قیمت نمی تواند کوچکتر از صفر باشد");
            $this->redirectBack();
        }

        if (!is_numeric($request['price'])) {
            flash('validation-error', "قیمت فقط باید در قالب عدد باشد");
            $this->redirectBack();
        }

        $request['image'] = saveImage($request['image'], 'admin/product-image');

        if (isset($_SESSION['user'])) {
            $request['user_id'] = $_SESSION['user'];
        } else {
            $request['user_id'] = 1;
        }


        if (!$request['image']) {
            flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
            $this->redirectBack();
        }
        $db = new DataBase;
        $db->insert('products', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'محصول با موفقیت اضافه شد');
        $this->redirect('admin/market/product');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/product');
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('select * from products where id=?', [$id])->fetch();

        if (!$product) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/product');
        }
        $categories = $db->select('select * from product_categories order by name');
        $brands = $db->select('select * from brands order by persian_name');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/product/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/product');
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('select * from products where id=?', [$id])->fetch();

        if (!$product) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/product');
        }


        if (!$request['name'] || !$request['description'] || !$request['status']  || !$request['brand_id'] || !$request['product_category_id']) {
            flash('validation-error', "پرکردن فیلدهای نام، محتوا محصول، برندو دسته بندی اجباری می باشد");
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['description'] = input_data($request['description']);
        $request['status'] = input_data($request['status']);
        $request['slug'] = input_data($request['slug']);
        $request['width'] = input_data($request['width']);
        $request['height'] = input_data($request['height']);
        $request['length'] = input_data($request['length']);
        $request['weight'] = input_data($request['weight']);
        $request['price'] = input_data($request['price']);
        $request['brand_id'] = input_data($request['brand_id']);
        $request['product_category_id'] = input_data($request['product_category_id']);


        if ($request['price'] < 0) {
            flash('validation-error', "قیمت نمی تواند کوچکتر از صفر باشد");
            $this->redirectBack();
        }

        if (!is_numeric($request['price'])) {
            flash('validation-error', "قیمت فقط باید در قالب عدد باشد");
            $this->redirectBack();
        }

        if ($request['image']['tmp_name'] != '') {
            removeImage($product['image']);
            $request['image'] = saveImage($request['image'], 'admin/product-image');

            if (!$request['image']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        } else {
            unset($request['image']);
        }

        $db->update('productS', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'محصول با موفقیت اصلاح شد');
        $this->redirect('admin/market/product');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "محصول مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('select * from products where id=?', [$id])->fetch();

        if (!$product) {
            $message = ["status" => false, "message" => "محصول مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        removeImage($product['image']);
        $db->delete('products', $id);
        $message = ["status" => true, "message" => "محصول مد نظر حذف شد"];
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
        $products = $db->select("select * from products where name like '%$value%' ")->fetchAll();
        $db->closeConnection();
        echo json_encode($products);
        exit;
    }



    private function getAllCategories($categoryId)
    {
        $db = new DataBase;
        $category = $db->select('select * from product_categories where id=?', [$categoryId])->fetch();

        if ($category['parent_id']) {
            $parentCategory = $this->getAllCategories($category['parent_id']);
            $category = array_merge([$parentCategory], [$category]);
        }
        return $category;
        $db->closeConnection();
    }



    public function show($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/product');
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('SELECT products.*,brands.persian_name AS brand_name,product_categories.name AS product_category_name,users.username FROM products LEFT JOIN brands ON products.brand_id=brands.id LEFT JOIN product_categories ON products.product_category_id=product_categories.id LEFT JOIN users ON products.user_id=users.id WHERE products.id=?', [$id])->fetch();

        if (!$product) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/product');
        }

        $allCategories = $this->getAllCategories($product['product_category_id']);

        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/product/show.php');
    }



    public function table($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/product');
        }
        $id = input_data($id);
        $db = new DataBase;
        $product = $db->select('SELECT products.*,brands.persian_name AS brand_name,product_categories.name AS product_category_name,users.username FROM products LEFT JOIN brands ON products.brand_id=brands.id LEFT JOIN product_categories ON products.product_category_id=product_categories.id LEFT JOIN users ON products.user_id=users.id WHERE products.id=?', [$id])->fetch();

        if (!$product) {
            flash('validation-error', 'محصول یافت نشد');
            $this->redirect('admin/market/product');
        }

        $categoryAttributes = $db->select('select * from category_attributes where product_category_id=?', [$product['product_category_id']])->fetchAll();

        $categoryAttributeValues = $db->select('select * from category_attribute_values where product_id=?', [$product['id']])->fetchAll();

        // dd($categoryAttributes);


        $allCategories = $this->getAllCategories($product['product_category_id']);

        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/product/table.php');
    }
}
