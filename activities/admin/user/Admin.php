<?php

namespace Activities\Admin\User;

use Activities\Admin\Admin as SourceAdmin;
use Database\DataBase;

class Admin extends SourceAdmin
{
    public function index()
    {
        $db = new DataBase;
        $admins = $db->select("SELECT * from users where permission='admin' and is_active=1 order by updated_at desc");
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/user/admin/index.php');
    }

    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'ادمین یافت نشد');
            $this->redirect('admin/user/admin');
        }
        $id = input_data($id);
        $db = new DataBase;
        $admin = $db->select("SELECT * from users where permission='admin' and is_active=1 and id=?", [$id])->fetch();
        $setting = $db->select('select * from settings')->fetch();
        if (!$admin) {
            flash('validation-error', 'ادمین یافت نشد');
            $this->redirect('admin/user/admin');
        }
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/user/admin/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'ادمین یافت نشد');
            $this->redirect('admin/user/admin');
        }
        $id = input_data($id);
        $db = new DataBase;
        $admin = $db->select("SELECT * from users where permission='admin' and is_active=1 and id=?", [$id])->fetch();

        if (!$admin) {
            flash('validation-error', 'ادمین یافت نشد');
            $this->redirect('admin/user/admin');
        }



        if (!$request['username'] || !$request['permission']) {
            flash('validation-error', 'پر کردن تمام فیلد ها اجباری می باشد');
            $this->redirectBack();
        }

        $request['username'] = input_data($request['username']);
        $request['permission'] = input_data($request['permission']);


        $db->update('users', $id, ['username', 'permission'], [$request['username'], $request['permission']]);
        $db->closeConnection();
        flash('success', 'کاربر با موفقیت اصلاح شد');
        $this->redirect('admin/user/admin');
    }
}
