<?php

namespace Activities\Admin\User;

use Activities\Admin\Admin as SourceAdmin;
use Database\DataBase;

class User extends SourceAdmin
{
    public function index()
    {
        $db = new DataBase;
        $users = $db->select("SELECT * from users where permission='user' and is_active=1 order by updated_at desc");
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/user/user/index.php');
    }

    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'کاربر یافت نشد');
            $this->redirect('admin/user/user');
        }
        $id = input_data($id);
        $db = new DataBase;
        $user = $db->select("SELECT * from users where permission='user' and is_active=1 and id=?", [$id])->fetch();
        $setting = $db->select('select * from settings')->fetch();

        if (!$user) {
            flash('validation-error', 'کاربر یافت نشد');
            $this->redirect('admin/user/user');
        }
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/user/user/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'کاربر یافت نشد');
            $this->redirect('admin/user/user');
        }
        $id = input_data($id);
        $db = new DataBase;
        $user = $db->select("SELECT * from users where permission='user' and is_active=1 and id=?", [$id])->fetch();

        if (!$user) {
            flash('validation-error', 'کاربر یافت نشد');
            $this->redirect('admin/user/user');
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
        $this->redirect('admin/user/user');
    }



    public function titleSearch()
    {
        $json = file_get_contents('php://input');
        $value = json_decode($json, true)['value'];
        $value = input_data($value);

        $db = new DataBase;
        $users = $db->select("SELECT * from users where permission='user' and is_active=1 and username like '%$value%'")->fetchAll();
        $db->closeConnection();
        echo json_encode($users);
        exit;
    }
}
