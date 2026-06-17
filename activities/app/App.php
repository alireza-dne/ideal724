<?php

namespace Activities\App;

use Database\DataBase;

class App
{
    public function productCategory($id)
    {
        $db = new DataBase;
        $id = input_data($id);
        $category = $db->select("SELECT * FROM product_categories WHERE status=1 AND id=?", [$id])->fetch();
        if (!$category) {
            redirect('/');
        }

        $parentId = $category['parent_id'];
        if ($parentId == null) {
            $parentCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND parent_id=?", [$id])->fetchAll();

            $productsId = '';
            $parentQustion = '';

            foreach ($parentCategories as $parentCategory) {
                $productsId .= ',' . $parentCategory['id'];
            }
            foreach ($parentCategories as $parentCategory) {
                $parentQustion .= ',?';
            }
            // $productsId = '(' . trim($productsId, ',') . ')';
            $productsId = explode(',', trim($productsId, ','));
            $parentQustion = '(' . trim($parentQustion, ',') . ')';

            $products = $db->select("SELECT products.id,products.name,products.image,brands.english_name FROM products LEFT JOIN brands ON products.brand_id=brands.id WHERE products.product_category_id IN $parentQustion AND products.status=1 ORDER BY products.created_at DESC", $productsId);
        } else {
            $products = $db->select("SELECT products.id,products.name,products.image,brands.english_name FROM products LEFT JOIN brands ON products.brand_id=brands.id WHERE products.product_category_id=? AND products.status=1 ORDER BY products.created_at DESC", [$id]);
        }



        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/category.php');
    }


    private function getAllCategories($categoryId)
    {
        $db = new DataBase();
        $category = $db->select('SELECT * FROM product_categories WHERE id=?', [$categoryId])->fetch();

        if ($category['parent_id']) {
            $parentCategory = $this->getAllCategories($category['parent_id']);
            $category = array_merge([$parentCategory], [$category]);
        }
        return $category;
    }


    public function product($id)
    {
        $db = new DataBase;
        $id = input_data($id);
        $product = $db->select("SELECT products.*,brands.english_name FROM products LEFT JOIN brands ON products.brand_id=brands.id WHERE products.status=1 AND products.id=?", [$id])->fetch();
        if (!$product) {
            redirect('/');
        }

        $view = $product['view'] + 1;
        $db->update('products', $id, ['view'], [$view]);


        $productAllCategories = $this->getAllCategories($product['product_category_id']);
        $galleries = $db->select("SELECT * FROM galleries WHERE status=1 AND product_id=?", [$id]);
        $categoryAttributes = $db->select("SELECT * FROM category_attributes WHERE status=1 AND product_category_id=?", [$product['product_category_id']])->fetchAll();
        $categoryValues = $db->select("SELECT * FROM category_attribute_values WHERE status=1 AND product_id=?", [$product['id']])->fetchAll();
        $comments = $db->select("SELECT comments.*,users.username FROM comments LEFT JOIN users ON comments.user_id=users.id WHERE comments.status='approved' AND comments.product_id=? AND  comments.parent_id IS NULL", [$product['id']]);

        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/product.php');
    }


    public function commentStore($request, $productId)
    {

        if (!isset($_SESSION['user']) || $_SESSION == '') {
            redirect('/');
        }

        if (!isset($productId) || $productId == null || !isset($request['comment']) || $request['comment'] == null) {
            flash('validation-error', 'مقدار کامنت نمی تواند خالی باشد.');
            redirectBack();
        }

        $productId = input_data($productId);
        $comment = input_data($request['comment']);
        $db = new DataBase;
        $product = $db->select("SELECT * FROM products WHERE status=1 AND id=?", [$productId])->fetch();
        if (!$product) {
            redirect('/');
        }
        $db->insert('comments', ['comment', 'user_id', 'product_id'], [$comment, $_SESSION['user'], $productId]);
        $db->closeConnection();
        flash('success', 'دیدگاه شما با موفقیت ارسال شد و پس از تایید، منتشر می گردد.');
        redirectBack();
    }


    public function post($id)
    {
        $db = new DataBase;
        $id = input_data($id);
        $post = $db->select("SELECT * FROM posts WHERE status=1 AND id=?", [$id])->fetch();
        if (!$post) {
            redirect('/');
        }

        $view = $post['view'] + 1;
        $db->update('posts', $id, ['view'], [$view]);
        $comments = $db->select("SELECT comments.*,users.username FROM comments LEFT JOIN users ON comments.user_id=users.id WHERE comments.status='approved' AND comments.post_id=? AND parent_id IS NULL", [$id])->fetchAll();

        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/post.php');
    }




    public function postCommentStore($request, $postId)
    {

        if (!isset($_SESSION['user']) || $_SESSION == '') {
            redirect('/');
        }

        if (!isset($postId) || $postId == null || !isset($request['comment']) || $request['comment'] == null) {
            flash('validation-error', 'مقدار کامنت نمی تواند خالی باشد.');
            redirectBack();
        }

        $postId = input_data($postId);
        $comment = input_data($request['comment']);
        $db = new DataBase;
        $post = $db->select("SELECT * FROM posts WHERE status=1 AND id=?", [$postId])->fetch();
        if (!$post) {
            redirect('/');
        }
        $db->insert('comments', ['comment', 'user_id', 'post_id'], [$comment, $_SESSION['user'], $postId]);
        $db->closeConnection();
        flash('success', 'دیدگاه شما با موفقیت ارسال شد و پس از تایید، منتشر می گردد.');
        redirectBack();
    }



    public function brand($id)
    {

        $db = new DataBase;
        $id = input_data($id);
        $brand = $db->select("SELECT * FROM brands WHERE status=1 AND id=?", [$id])->fetch();
        if (!$brand) {
            redirect('/');
        }
        $products = $db->select("SELECT products.id,products.name,products.image,brands.english_name FROM products LEFT JOIN brands ON products.brand_id=brands.id WHERE products.status=1 and products.brand_id=? ORDER BY products.created_at DESC", [$id]);

        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/brand.php');
    }


    public function products()
    {
        $db = new DataBase;
        $products = $db->select("SELECT products.id,products.name,products.image,brands.english_name,products.view FROM products LEFT JOIN brands ON products.brand_id=brands.id WHERE products.status=1 ORDER BY products.created_at DESC");

        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/products.php');
    }

    public function posts()
    {
        $db = new DataBase;
        $posts = $db->select("SELECT * FROM posts WHERE status=1 ORDER BY published_at DESC");;

        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/posts.php');
    }



    public function brands()
    {
        $db = new DataBase;
        $brands = $db->select('SELECT * FROM brands WHERE status=1 ORDER BY created_at DESC');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/brands.php');
    }
}
