<?php

namespace Activities\Admin\Content;

use Activities\Admin\Admin;
use Database\DataBase;

class FooterMenu extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $FooterMenus = $db->select('SELECT h1.* ,h2.name AS parent_name FROM footer_menus h1 LEFT JOIN footer_menus h2 ON h1.parent_id=h2.id ORDER BY h1.row');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/footer-menu/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $FooterMenus = $db->select('SELECT h1.* ,h2.name AS parent_name FROM footer_menus h1 LEFT JOIN footer_menus h2 ON h1.parent_id=h2.id ORDER BY h1.row');
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/footer-menu/create.php');
    }


    public function store($request)
    {
        if (!$request['name'] || !$request['row'] || !$request['url'] || !$request['parent_id']) {
            flash('validation-error', 'پر کردن تمام فیلد ها اجباری می باشد');
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['row'] = input_data($request['row']);
        $request['url'] = input_data($request['url']);
        $request['parent_id'] = input_data($request['parent_id']);

        if ($request['parent_id'] == 'parent') {
            $request['parent_id'] = null;
        }

        $db = new DataBase;
        $db->insert('footer_menus', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'منو با موفقیت اضافه شدند');
        $this->redirect('admin/content/footer-menu');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'منو یافت نشد');
            $this->redirect('admin/content/footer-menu');
        }
        $id = input_data($id);
        $db = new DataBase;
        $FooterMenu = $db->select('select * from footer_menus where id=?', [$id])->fetch();

        if (!$FooterMenu) {
            flash('validation-error', 'منو یافت نشد');
            $this->redirect('admin/content/footer-menu');
        }
        $FooterMenus = $db->select('SELECT h1.* ,h2.name AS parent_name FROM footer_menus h1 LEFT JOIN footer_menus h2 ON h1.parent_id=h2.id ORDER BY h1.row');
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/content/footer-menu/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'منو یافت نشد');
            $this->redirect('admin/content/footer-menu');
        }
        $id = input_data($id);
        $db = new DataBase;
        $FooterMenu = $db->select('select * from footer_menus where id=?', [$id])->fetch();

        if (!$FooterMenu) {
            flash('validation-error', 'منو یافت نشد');
            $this->redirect('admin/content/footer-menu');
        }



        if (!$request['name'] || !$request['row'] || !$request['url'] || !$request['parent_id']) {
            flash('validation-error', 'پر کردن تمام فیلد ها اجباری می باشد');
            $this->redirectBack();
        }

        $request['name'] = input_data($request['name']);
        $request['row'] = input_data($request['row']);
        $request['url'] = input_data($request['url']);
        $request['parent_id'] = input_data($request['parent_id']);

        if ($request['parent_id'] == 'parent') {
            $request['parent_id'] = null;
        }

        $db->update('footer_menus', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'منو با موفقیت اصلاح شد');
        $this->redirect('admin/content/footer-menu');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => 'منو یافت نشد'];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $FooterMenu = $db->select('select * from footer_menus where id=?', [$id])->fetch();

        if (!$FooterMenu) {
            $message = ["status" => false, "message" => 'منو یافت نشد'];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        $db->delete('footer_menus', $id);
        $message = ["status" => true, "message" => "منو مد نظر با موفقیت حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
