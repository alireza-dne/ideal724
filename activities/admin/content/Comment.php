<?php

namespace Activities\Admin\Content;

use Activities\Admin\Admin;
use Database\DataBase;

class Comment extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $comments = $db->select('SELECT comments.*,users.username,posts.name AS post_name,products.name AS product_name FROM comments LEFT JOIN users ON comments.user_id=users.id LEFT JOIN posts ON comments.post_id=posts.id LEFT JOIN products ON comments.product_id = products.id ORDER BY comments.created_at DESC');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/comment/index.php');
    }

    public function show($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'نظر یافت نشد');
            $this->redirect('admin/content/comment');
        }
        $id = input_data($id);
        $db = new DataBase;
        $comment = $db->select('SELECT comments.*,users.username,posts.name AS post_name,products.name AS product_name FROM comments LEFT JOIN users ON comments.user_id=users.id LEFT JOIN posts ON comments.post_id=posts.id LEFT JOIN products ON comments.product_id = products.id where comments.id=?', [$id])->fetch();

        $replies = $db->select('SELECT comments.*,users.username,posts.name AS post_name,products.name AS product_name FROM comments LEFT JOIN users ON comments.user_id=users.id LEFT JOIN posts ON comments.post_id=posts.id LEFT JOIN products ON comments.product_id = products.id where comments.parent_id=?', [$id])->fetchAll();
        $setting = $db->select('select * from settings')->fetch();

        if (!$comment) {
            flash('validation-error', 'نظر یافت نشد');
            $this->redirect('admin/content/comment');
        }
        $db->update('comments', $id, ['status'], ['seen']);
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/comment/show.php');
    }


    public function answer($request, $id)
    {
        if (!$request['comment']) {
            flash('validation-error', 'محتوای نظر نمی تواند خالی باشد می باشد');
            $this->redirectBack();
        }

        $request['comment'] = input_data($request['comment']);
        if (isset($_SESSION['user'])) {
            $request['user_id'] = $_SESSION['user'];
        } else {
            $request['user_id'] = 1;
        }

        $db = new DataBase;
        $comment = $db->select("select * from comments where id=?", [$id])->fetch();

        if (!$comment) {
            flash('validation-error', 'نظر یافت نشد');
            $this->redirect('admin/content/comment');
        }
        $request['post_id'] = $comment['post_id'];
        $request['product_id'] = $comment['product_id'];
        $request['status'] = 'approved';
        $request['parent_id'] = $comment['id'];

        $db->insert('comments', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'نظر با موفقیت اضافه شد');
        $this->redirect('admin/content/comment');
    }


    public function changeStatus()
    {
        $json = file_get_contents('php://input');
        $id = json_decode($json, true)['id'];
        $value = json_decode($json, true)['value'];



        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $comment = $db->select('select * from comments where id=?', [$id])->fetch();

        if (!$comment) {
            $message = ["status" => false, "message" => "نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }

        if ($value == 'unseen') {
            $db->update('comments', $id, ['status'], ['unseen']);
        } elseif ($value == 'seen') {
            $db->update('comments', $id, ['status'], ['seen']);
        } else {
            $db->update('comments', $id, ['status'], ['approved']);
        }
        $message = ["status" => true, "message" => "عملیات با موفقیت انجام شد"];
        // echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
