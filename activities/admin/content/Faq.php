<?php

namespace Activities\Admin\Content;

use Activities\Admin\Admin;
use Database\DataBase;

class Faq extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $faqs = $db->select('select * from faqs order by created_at desc');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/faq/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();

        require_once(BASE_PATH . '/template/admin/content/faq/create.php');
    }


    public function store($request)
    {


        if (!$request['answer'] || !$request['qustion']) {
            flash('validation-error', 'پر کردن سوال و پاسخ اجباری می باشد');
            $this->redirectBack();
        }

        $request['qustion'] = input_data($request['qustion']);
        $request['answer'] = input_data($request['answer']);

        $db = new DataBase;
        $db->insert('faqs', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'سوال و پاسخ با موفقیت اضافه شدند');
        $this->redirect('admin/content/faq');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'سوال متداول یافت نشد');
            $this->redirect('admin/content/faq');
        }
        $id = input_data($id);
        $db = new DataBase;
        $faq = $db->select('select * from faqs where id=?', [$id])->fetch();
        $setting = $db->select('select * from settings')->fetch();

        if (!$faq) {
            flash('validation-error', 'سوال متداول یافت نشد');
            $this->redirect('admin/content/faq');
        }
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/faq/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'سوال متداول یافت نشد');
            $this->redirect('admin/content/faq');
        }
        $id = input_data($id);
        $db = new DataBase;
        $faq = $db->select('select * from faqs where id=?', [$id])->fetch();

        if (!$faq) {
            flash('validation-error', 'سوال متداول یافت نشد');
            $this->redirect('admin/content/faq');
        }



        if (!$request['qustion'] || !$request['answer']) {
            flash('validation-error', 'پر کردن سوال و پاسخ اجباری می باشد');
            $this->redirectBack();
        }

        $request['qustion'] = input_data($request['qustion']);
        $request['answer'] = input_data($request['answer']);

        $db->update('faqs', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'سوال متداول با موفقیت اصلاح شد');
        $this->redirect('admin/content/faq');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "سوال متداول مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $faq = $db->select('select * from faqs where id=?', [$id])->fetch();

        if (!$faq) {
            $message = ["status" => false, "message" => "سوال متداول مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        $db->delete('faqs', $id);
        $message = ["status" => true, "message" => "سوال متداول مد نظر با موفقیت حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
