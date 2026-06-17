<?php

namespace Activities\Admin\Market;

use Activities\Admin\Admin;
use Database\DataBase;

class Discount extends Admin
{
    public function index()
    {
        $db = new DataBase;
        $discounts = $db->select('SELECT discounts.*,users.email FROM discounts LEFT JOIN users ON discounts.user_id=users.id ORDER BY discounts.created_at DESC');
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/discount/index.php');
    }

    public function create()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();
        $users = $db->select('select * from users order by email');
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/discount/create.php');
    }


    private function randomToken()
    {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

    public function store($request)
    {

        if (!$request['amount'] || !$request['amount_type'] || !$request['type'] || !$request['status'] || !$request['start_date'] || !$request['end_date'] || !$request['user_id']) {
            flash('validation-error', 'پر کردن تمام فیلدها به جز کد و سقف اجباری می باشد');
            $this->redirectBack();
        }

        $request['code'] = input_data($request['code']);
        $request['discount_celling'] = input_data($request['discount_celling']);
        $request['amount'] = input_data($request['amount']);
        $request['amount_type'] = input_data($request['amount_type']);
        $request['type'] = input_data($request['type']);
        $request['status'] = input_data($request['status']);
        $request['start_date'] = input_data($request['start_date']);
        $request['end_date'] = input_data($request['end_date']);
        $request['user_id'] = input_data($request['user_id']);

        if ($request['amount'] < 1) {
            flash('validation-error', "مقدار نمی تواند کوچکتر از یک باشد");
            $this->redirectBack();
        }

        if (!is_numeric($request['amount'])) {
            flash('validation-error', "مقدار فقط باید در قالب عدد باشد");
            $this->redirectBack();
        }

        if ($request['code'] == null) {
            $request['code'] = $this->randomToken();
        }

        if ($request['discount_celling'] != '') {
            if ($request['discount_celling'] < 1) {
                flash('validation-error', "سقف نمی تواند کوچکتر از یک باشد");
                $this->redirectBack();
            }
        }

        if ($request['amount_type'] == 1 && $request['amount'] > 100) {
            flash('validation-error', "در حالت تخفیف درصدی، مقدار نمی تواند بیشتر از 100 باشد");
            $this->redirectBack();
        }

        if ($request['user_id'] == 'public') {
            $request['user_id'] = 5;
        }

        if ($request['type'] == 1 && $request['user_id'] == 5) {
            flash('validation-error', "در حالت تخفیف خصوصی، لطفا کاربر را انتخاب فرمایید");
            $this->redirectBack();
        }

        if ($request['type'] == 2 && $request['user_id'] != 5) {
            flash('validation-error', "در حالت تخفیف عمومی نباید کاربری انتخاب کنید");
            $this->redirectBack();
        }

        if ($request['end_date'] < $request['start_date']) {
            flash('validation-error', "زمان پایان بزرگتر از زمان شروع باشد");
            $this->redirectBack();
        }

        $request['end_date'] = date('Y-m-d H:i:s', $request['end_date'] / 1000);
        $request['start_date'] = date('Y-m-d H:i:s', $request['start_date'] / 1000);

        $db = new DataBase;
        $db->insert('discounts', array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'کد تخفیف با موفقیت اضافه شد');
        $this->redirect('admin/market/discount');
    }



    public function edit($id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'کد تخفیف یافت نشد');
            $this->redirect('admin/market/discount');
        }
        $id = input_data($id);
        $db = new DataBase;
        $discount = $db->select('select * from discounts where id=?', [$id])->fetch();

        if (!$discount) {
            flash('validation-error', 'کد تخفیف یافت نشد');
            $this->redirect('admin/market/discount');
        }
        $users = $db->select('select * from users order by email');

        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/admin/market/discount/edit.php');
    }



    public function update($request, $id)
    {
        if (!isset($id) || $id == null) {
            flash('validation-error', 'کد تخفیف یافت نشد');
            $this->redirect('admin/market/discount');
        }
        $id = input_data($id);
        $db = new DataBase;
        $discount = $db->select('select * from discounts where id=?', [$id])->fetch();

        if (!$discount) {
            flash('validation-error', 'کد تخفیف یافت نشد');
            $this->redirect('admin/market/discount');
        }



        if (!$request['amount'] || !$request['amount_type'] || !$request['type'] || !$request['status'] || !$request['start_date'] || !$request['end_date'] || !$request['user_id']) {
            flash('validation-error', 'پر کردن تمام فیلدها به جز کد و سقف اجباری می باشد');
            $this->redirectBack();
        }

        $request['code'] = input_data($request['code']);
        $request['discount_celling'] = input_data($request['discount_celling']);
        $request['amount'] = input_data($request['amount']);
        $request['amount_type'] = input_data($request['amount_type']);
        $request['type'] = input_data($request['type']);
        $request['status'] = input_data($request['status']);
        $request['start_date'] = input_data($request['start_date']);
        $request['end_date'] = input_data($request['end_date']);
        $request['user_id'] = input_data($request['user_id']);

        if ($request['amount'] < 1) {
            flash('validation-error', "مقدار نمی تواند کوچکتر از یک باشد");
            $this->redirectBack();
        }

        if (!is_numeric($request['amount'])) {
            flash('validation-error', "مقدار فقط باید در قالب عدد باشد");
            $this->redirectBack();
        }

        if ($request['code'] == null) {
            $request['code'] = $this->randomToken();
        }

        if ($request['discount_celling'] != '') {
            if ($request['discount_celling'] < 1) {
                flash('validation-error', "سقف نمی تواند کوچکتر از یک باشد");
                $this->redirectBack();
            }
        }

        if ($request['amount_type'] == 1 && $request['amount'] > 100) {
            flash('validation-error', "در حالت تخفیف درصدی، مقدار نمی تواند بیشتر از 100 باشد");
            $this->redirectBack();
        }

        if ($request['user_id'] == 'public') {
            $request['user_id'] = 5;
        }

        if ($request['type'] == 1 && $request['user_id'] == 5) {
            flash('validation-error', "در حالت تخفیف خصوصی، لطفا کاربر را انتخاب فرمایید");
            $this->redirectBack();
        }

        if ($request['type'] == 2 && $request['user_id'] != 5) {
            flash('validation-error', "در حالت تخفیف عمومی نباید کاربری انتخاب کنید");
            $this->redirectBack();
        }

        if ($request['end_date'] < $request['start_date']) {
            flash('validation-error', "زمان پایان بزرگتر از زمان شروع باشد");
            $this->redirectBack();
        }

        $request['end_date'] = date('Y-m-d H:i:s', $request['end_date'] / 1000);
        $request['start_date'] = date('Y-m-d H:i:s', $request['start_date'] / 1000);



        $db->update('discounts', $id, array_keys($request), array_values($request));
        $db->closeConnection();
        flash('success', 'کد تخفیف با موفقیت اصلاح شد');
        $this->redirect('admin/market/discount');
    }





    public function delete($id)
    {

        if (!isset($id) || $id == null) {
            $message = ["status" => false, "message" => "کد تخفیف مد نظر یافت نشد"];
            echo json_encode($message);
            exit;
        }
        $id = input_data($id);
        $db = new DataBase;
        $discount = $db->select('select * from discounts where id=?', [$id])->fetch();

        if (!$discount) {
            $message = ["status" => false, "message" => "کد تخفیف مد نظر یافت نشد"];
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        $db->delete('discounts', $id);
        $message = ["status" => true, "message" => "کد تخفیف مد نظر حذف شد"];
        echo json_encode($message);
        $db->closeConnection();
        exit;
    }





    public function titleSearchCode()
    {
        $json = file_get_contents('php://input');
        $value = json_decode($json, true)['value'];
        $value = input_data($value);

        $db = new DataBase;
        $discounts = $db->select("SELECT discounts.*,users.email FROM discounts LEFT JOIN users ON discounts.user_id=users.id where discounts.code like '%$value%' ")->fetchAll();
        $db->closeConnection();
        echo json_encode($discounts);
        exit;
    }




    public function titleSearchUser()
    {
        $json = file_get_contents('php://input');
        $value = json_decode($json, true)['value'];
        $value = input_data($value);

        $db = new DataBase;
        $discounts = $db->select("SELECT discounts.*,users.email FROM discounts LEFT JOIN users ON discounts.user_id=users.id where users.email like '%$value%' ")->fetchAll();
        $db->closeConnection();
        echo json_encode($discounts);
        exit;
    }
}
