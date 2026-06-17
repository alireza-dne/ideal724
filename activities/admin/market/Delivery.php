<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class Delivery extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $deliveries = $db->select('select * from deliveries order by created_at desc');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/delivery/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/delivery/create.php');
    }


    public function store($request)
    {


        if (!$request['name'] || !$request['unit']) {
            flash('validation-error', 'پر کردن تمام فیلدها اجباری می باشد');
            $this->redirectBack();
        }

        if ($request['amount'] == null) {
            $request['amount'] = 0;
        }

        if ($request['time'] == null) {
            $request['time'] = 0;
        }
        $request['name'] = input_data($request['name']);
        $request['time'] = input_data($request['time']);
        $request['amount'] = input_data($request['amount']);
        $request['unit'] = input_data($request['unit']);



        if ($request['amount'] < 0) {
            flash('validation-error', "هزینه ارسال نمی تواند کوچکتر از صفر باشد");
            $this->redirectBack();
        }

        if (!is_numeric($request['amount'])) {
            flash('validation-error', "هزینه ارسال فقط باید در قالب عدد باشد");
            $this->redirectBack();
        }
        $db = new DataBase;
        $db->insert('deliveries', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'روش ارسال با موفقیت اضافه شد');
        $this->redirect('admin/market/delivery');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'روش ارسال یافت نشد');
            $this->redirect('admin/market/delivery');
        }
        $id = input_data($id);
        $db = new DataBase;
        $delivery = $db->select('select * from deliveries where id=?', [$id])->fetch();

        if (!$delivery) {
            flash('validation-error', 'روش ارسال یافت نشد');
            $this->redirect('admin/market/delivery');
        }
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/delivery/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'روش ارسال یافت نشد');
            $this->redirect('admin/market/delivery');
        }
        $id = input_data($id);
        $db = new DataBase;
        $delivery = $db->select('select * from deliveries where id=?', [$id])->fetch();

        if (!$delivery) {
            flash('validation-error', 'روش ارسال یافت نشد');
            $this->redirect('admin/market/delivery');
        }

        if (!$request['name'] || !$request['unit']) {
            flash('validation-error', 'پر کردن تمام فیلدها اجباری می باشد');
            $this->redirectBack();
        }

        if ($request['amount'] == null) {
            $request['amount'] = 0;
        }

        if ($request['time'] == null) {
            $request['time'] = 0;
        }
        $request['name'] = input_data($request['name']);
        $request['time'] = input_data($request['time']);
        $request['amount'] = input_data($request['amount']);
        $request['unit'] = input_data($request['unit']);

        if ($request['amount'] < 0) {
            flash('validation-error', "هزینه ارسال نمی تواند کوچکتر از صفر باشد");
            $this->redirectBack();
        }

        if (!is_numeric($request['amount'])) {
            flash('validation-error', "هزینه ارسال فقط باید در قالب عدد باشد");
            $this->redirectBack();
        }


        $db->update('deliveries', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'روش ارسال با موفقیت اصلاح شد');
        $this->redirect('admin/market/delivery');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "روش ارسال مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $delivery = $db->select('select * from deliveries where id=?', [$id])->fetch();

        if (!$delivery) {
            $message = ["status" => false, "message" => "روش ارسال مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        $db->delete('deliveries', $id);
        $message = ["status" => true, "message" => "روش ارسال مد نظر حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }
}
