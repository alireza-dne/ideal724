<?php

namespace Activities\App;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Database\DataBase;

class Order
{

    public function order($productId)
    {
        if (!isset($_SESSION['user']) || $_SESSION == '') {
            flash('validation-error', 'جهت ثبت سفارش به صورت آنلاین، ابتدا وارد سامانه شوید در غیر اینصورت با کارشناسان شرکت اطلس کمپرسور ایده آل تماس حاصل فرمایید : 09152222646');
            redirect('login-register');
        }

        $db = new DataBase;
        $productId = input_data($productId);
        $userId = input_data($_SESSION['user']);

        $product = $db->select("SELECT products.*,brands.english_name FROM products LEFT JOIN brands ON products.brand_id=brands.id WHERE products.status=1 AND products.id=?", [$productId])->fetch();

        $user = $db->select("SELECT * FROM users WHERE id=? AND is_active=1", [$userId])->fetch();
        if (!$user) {
            redirect('/');
        }


        $productCategories = $db->select("SELECT * FROM product_categories WHERE status=1 AND show_in_menu=1")->fetchAll();
        $setting = $db->select('select * from settings')->fetch();
        $db->closeConnection();
        require_once(BASE_PATH . '/template/app/order.php');
    }




    private function orderMessage($username, $email, $mobile, $order)
    {
        $message = "<div style='direction: rtl ;padding: 2rem;'>
        <h1>درخواست استعلام و تامین کالا</h1>
        <h4> نام و نام خانوادگی درخواست کننده: $username</h4>
        <h4>ایمیل : $email</h4>
        <h4>موبایل : $mobile</h4>
        <h2 style='color: #0c5880;'> شرح کالاهای مورد نیاز:</h2>
        <p>$order</p>
    </div>";
        return $message;
    }


    private function sendMail($emailAddress, $subject, $body)
    {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->CharSet = "UTF-8"; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = MAIL_HOST; //Set the SMTP server to send through
            $mail->SMTPAuth = SMTP_AUTH; //Enable SMTP authentication
            $mail->Username = MAIL_USERNAME; //SMTP username
            $mail->Password = MAIL_PASSWORD; //SMTP password
            $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
            $mail->Port = MAIL_PORT; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(SENDER_MAIL, SENDER_NAME);
            $mail->addAddress($emailAddress);


            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->SMTPDebug = 0; //توضیحات را خاموش کردیم تا json خطا ندهد
            $mail->send();
            // echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }


    public function orderStore($request)
    {

        if (!isset($_SESSION['user']) || $_SESSION == '') {
            flash('validation-error', 'جهت ثبت سفارش به صورت آنلاین، ابتدا وارد سامانه شوید در غیر اینصورت با کارشناسان شرکت اطلس کمپرسور ایده آل تماس حاصل فرمایید : 09152222646');
            redirect('login-register');
        }

        $db = new DataBase;
        $userId = input_data($_SESSION['user']);
        $user = $db->select("SELECT * FROM users WHERE id=? AND is_active=1", [$userId])->fetch();
        if (!$user) {
            redirect('/');
        }

        if (!isset($request['order']) || $request['order'] == '' || !isset($request['mobile']) || $request['mobile'] == '') {
            flash('validation-error', 'وارد کردن تمام فیلد ها اجباری می باشد');
            redirectBack();
        }
        $order = input_data($request['order']);
        $mobile = input_data($request['mobile']);

        $mobilePattern = "/^(\+98|0)?9\d{9}$/";
        if (!preg_match($mobilePattern, $mobile)) {
            flash('validation-error', 'لطفا شماره موبایل خود را به صورت صحیح وارد فرمایید');
            redirectBack();
        }

        $orderMessage = $this->orderMessage($user['username'], $user['email'], $mobile, $order);
        $result = $this->sendMail('acideal1401@gmail.com', 'درخواست تامین کالا - از وبسایت ideal724.com', $orderMessage);

        if (!$result) {
            flash('validation-error', 'ارسال درخواست انجام نشد، لطفا با پشتیبانی تماس بگیرید.');
            redirectBack();
        }
        $db->closeConnection();
        flash('success', 'درخواست شما برای شرکت اطلس کمپرسور ایده آل ارسال شد، کارشناسان ما در اسرع وقت با شما ارتباط برقرار خواهند کرد.');
        redirect('order/1');
    }
}
