<?php

namespace Activities\Admin\Setting;

use Activities\Admin\Admin;
use Database\DataBase;

class Setting extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/setting/index.php');
    }

    public function create()
    {
        require_once(BASE_PATH . '/template/admin/setting/create.php');
    }


    public function store($request)
    {
        if (!$request['title'] || !$request['logo']['tmp_name'] || !$request['icon']['tmp_name'] || !$request['description'] || !$request['key_words']  || !$request['phone'] || !$request['mobile'] || !$request['instagram'] || !$request['telegram']) {
            flash('validation-error', "پرکردن تمام فیلدها و همچنین تصاویر الزامی می باشد");
            $this->redirectBack();
        }

        $request['title'] = input_data($request['title']);
        $request['description'] = input_data($request['description']);
        $request['key_words'] = input_data($request['key_words']);
        $request['phone'] = input_data($request['phone']);
        $request['mobile'] = input_data($request['mobile']);
        $request['instagram'] = input_data($request['instagram']);
        $request['telegram'] = input_data($request['telegram']);


        $request['logo'] = saveImage($request['logo'], 'admin/setting-image', 'logo');
        $request['icon'] = saveImage($request['icon'], 'admin/setting-image', 'icon');


        if (!$request['logo'] || !$request['icon']) {
            flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
            $this->redirectBack();
        }

        $db = new DataBase;
        $db->insert('settings', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'تنظیمات با موفقیت اضافه شد');
        $this->redirect('admin/setting');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'تنظیمات یافت نشد');
            $this->redirect('admin/setting');
        }

        $id = input_data($id);
        $db = new DataBase;
        $setting = $db->select('select * from settings where id=?', [$id])->fetch();

        if (!$setting) {
            flash('validation-error', 'تنظیمات یافت نشد');
            $this->redirect('admin/setting');
        }
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/setting/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'تنظیمات یافت نشد');
            $this->redirect('admin/setting');
        }
        $id = input_data($id);
        $db = new DataBase;
        $setting = $db->select('select * from settings where id=?', [$id])->fetch();

        if (!$setting) {
            flash('validation-error', 'تنظیمات یافت نشد');
            $this->redirect('admin/setting');
        }



        if (!$request['title'] || !$request['description'] || !$request['key_words']  || !$request['phone'] || !$request['mobile'] || !$request['instagram'] || !$request['telegram']) {
            flash('validation-error', "پرکردن تمام فیلدها الزامی می باشد");
            $this->redirectBack();
        }

        $request['title'] = input_data($request['title']);
        $request['description'] = input_data($request['description']);
        $request['key_words'] = input_data($request['key_words']);
        $request['phone'] = input_data($request['phone']);
        $request['mobile'] = input_data($request['mobile']);
        $request['instagram'] = input_data($request['instagram']);
        $request['telegram'] = input_data($request['telegram']);



        if ($request['logo']['tmp_name'] != '') {
            removeImage($setting['logo']);
            $request['logo'] = saveImage($request['logo'], 'admin/setting-image', 'logo');

            if (!$request['logo']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        } else {
            unset($request['logo']);
        }


        if ($request['icon']['tmp_name'] != '') {
            removeImage($setting['icon']);
            $request['icon'] = saveImage($request['icon'], 'admin/setting-image', 'icon');

            if (!$request['icon']) {
                flash('validation-error', 'تصویر ذخیره نشد، مجددا تلاش کنید');
                $this->redirectBack();
            }
        } else {
            unset($request['icon']);
        }


        $db->update('settings', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'تنظیمات با موفقیت اصلاح شد');
        $this->redirect('admin/setting');
    }
}