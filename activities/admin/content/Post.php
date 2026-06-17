<?php

namespace Activities\Admin\Content;

use Activities\Admin\Admin;
use Database\DataBase;

class Post extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $posts = $db->select('select * from posts order by created_at desc');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/post/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $categories = $db->select('select * from post_categories order by name');
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/post/create.php');
    }


    public function store($request)
    {


        if (!$request['name'] || !$request['image']['tmp_name'] || !$request['body'] || !$request['status']  || !$request['commentable'] || !$request['post_category_id']) {
            flash('validation-error', 'پر کردن تمام فیلد ها به جز خلاصه پست و slug اجباری می باشد');
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['body'] = input_data($request['body']);
        $request['status'] = input_data($request['status']);
        $request['commentable'] = input_data($request['commentable']);
        $request['post_category_id'] = input_data($request['post_category_id']);
        $request['slug'] = input_data($request['slug']);
        $request['summary'] = input_data($request['summary']);
        $request['published_at'] = input_data($request['published_at']);
        // $request['image'] = input_data($request['image']);
        $request['image'] = saveImage($request['image'], 'admin/post-image');
        $request['published_at'] = date('Y-m-d H:i:s', $request['published_at'] / 1000);

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
        $db->insert('posts', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'پست با موفقیت اضافه شد');
        $this->redirect('admin/content/post');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'پست یافت نشد');
            $this->redirect('admin/content/post');
        }
        $id = input_data($id);
        $db = new DataBase;
        $post = $db->select('select * from posts where id=?', [$id])->fetch();

        if (!$post) {
            flash('validation-error', 'پست یافت نشد');
            $this->redirect('admin/content/post');
        }
        $categories = $db->select('select * from post_categories order by name');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/post/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'پست یافت نشد');
            $this->redirect('admin/content/post');
        }
        $id = input_data($id);
        $db = new DataBase;
        $post = $db->select('select * from posts where id=?', [$id])->fetch();

        if (!$post) {
            flash('validation-error', 'پست یافت نشد');
            $this->redirect('admin/content/post');
        }



        if (!$request['name'] || !$request['body'] || !$request['status']  || !$request['commentable'] || !$request['post_category_id']) {
            flash('validation-error', 'پر کردن تمام فیلد ها به جز خلاصه پست و slug و تصویر اجباری می باشد');
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['body'] = input_data($request['body']);
        $request['status'] = input_data($request['status']);
        $request['commentable'] = input_data($request['commentable']);
        $request['post_category_id'] = input_data($request['post_category_id']);
        $request['slug'] = input_data($request['slug']);
        $request['summary'] = input_data($request['summary']);
        $request['published_at'] = input_data($request['published_at']);
        // $request['image'] = input_data($request['image']);
        $request['published_at'] = date('Y-m-d H:i:s', $request['published_at'] / 1000);

        if ($request['image']['tmp_name'] != '') {
            removeImage($post['image']);
            $request['image'] = saveImage($request['image'], 'admin/post-image');

            if (!$request['image']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        } else {
            unset($request['image']);
        }

        $db->update('postS', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'پست با موفقیت اصلاح شد');
        $this->redirect('admin/content/post');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "پست مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $post = $db->select('select * from posts where id=?', [$id])->fetch();

        if (!$post) {
            $message = ["status" => false, "message" => "پست مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        removeImage($post['image']);
        $db->delete('posts', $id);
        $message = ["status" => true, "message" => "پست مد نظر حذف شد"];
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
        $post = $db->select('select * from posts where id=?', [$id])->fetch();

        if (!$post) {
            $message = ["status" => false, "message" => "دسته بندی مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }

        if ($post['status'] == 1) {
            $db->update('posts', $id, ['status'], [2]);
        } else {
            $db->update('posts', $id, ['status'], [1]);
        }
        $message = ["status" => true, "message" => "عملیات با موفقیت انجام شد"];
        // echo json_encode($message);
        $db->closeConnection();
        exit;
    }





    public function changeCommentable()
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
        $post = $db->select('select * from posts where id=?', [$id])->fetch();

        if (!$post) {
            $message = ["status" => false, "message" => "دسته بندی مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }

        if ($post['commentable'] == 1) {
            $db->update('posts', $id, ['commentable'], [2]);
        } else {
            $db->update('posts', $id, ['commentable'], [1]);
        }
        $message = ["status" => true, "message" => "عملیات با موفقیت انجام شد"];
        // echo json_encode($message);
        $db->closeConnection();
        exit;
    }





    public function titleSearch()
    {
        $json = file_get_contents('php://input');
        $value = json_decode($json, true)['value'];
        $value = input_data($value);

        $db = new DataBase;
        $posts = $db->select("select * from posts where name like '%$value%' ")->fetchAll();
        $db->closeConnection();
        echo json_encode($posts);
        exit;
    }
}
