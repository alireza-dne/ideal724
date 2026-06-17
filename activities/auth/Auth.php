<?php

namespace Activities\Auth;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Database\DataBase;

class Auth
{
    private function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    private function randomToken()
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }


    private function activationMessage($username, $verifyToken)
    {
        $message = "<div style='direction: rtl ;padding: 2rem;'>
        <h1>فعالسازی حساب کاربری ایده آل</h1>
    <p>جناب $username عزیز، برای فعالسازی حساب کاربری خود روی لینک زیر کلیک کنید.</p>
    <a href='" . url('activation/' . $verifyToken) . "'>فعالسازی</a>
    </div>";
        return $message;
    }

    private function forgetMessage($username, $forgetToken)
    {
        $message = "<div style='direction: rtl ;padding: 2rem;'>
        <h1>فراموشی رمز عبور حساب کاربری ایده آل</h1>
    <p>جناب $username عزیز، برای برای به روز رسانی رمز عبور حساب کاربری خود بر روی لینک زیر کلیک کنید.</p>
    <a href='" . url('reset-password/' . $forgetToken) . "'>تغییر پسورد</a>
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

    public function loginRegister()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/auth/login-register.php');
    }



    public function store()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json, true);

        $email = input_data($request['email']);
        $username = input_data($request['username']);
        $password = input_data($request['password']);
        $confirmPassword = input_data($request['confirm-password']);
        $message = null;

        $db = new DataBase;
        $user = $db->select('select * from users where email=?', [$email])->fetch();



        if (!isset($email) || $email == null) {
            $message['email'] = ["field" => "email", "status" => false, "message" => "پر کردن فیلد ایمیل اجباری می باشد"];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message['email'] = ["field" => "email", "status" => false, "message" => "فرمت وارد شده صحیح نمی باشد"];
        } elseif ($user) {
            $message['email'] = ["field" => "email", "status" => false, "message" => "کاربر با این ایمیل از قبل وجود دارد"];
        } else {
            $message['email'] = ["field" => "email", "status" => true, "message" => "صحیح"];
        }



        if (!isset($username) || $username == null) {
            $message['username'] = ["field" => "username", "status" => false, "message" => "پر کردن فیلد نام و نام خانوادگی اجباری می باشد"];
        } else {
            $message['username'] = ["field" => "username", "status" => true, "message" => "صحیح"];
        }



        if (!isset($password) || $password == null) {
            $message['password'] = ["field" => "password", "status" => false, "message" => "پر کردن فیلد رمز عبور اجباری می باشد"];
        } elseif (strlen($password) < 8) {
            $message['password'] = ["field" => "password", "status" => false, "message" => "حداقل طول رمز عبور 8 کاراکتر باشد"];
        } else {
            $message['password'] = ["field" => "username", "status" => true, "message" => "صحیح"];
        }


        if (!isset($confirmPassword) || $confirmPassword == null) {
            $message['confirmPassword'] = ["field" => "password", "status" => false, "message" => "پر کردن فیلد تکرار رمز عبور اجباری می باشد"];
        } elseif ($password != $confirmPassword) {
            $message['confirmPassword'] = ["field" => "password", "status" => false, "message" => "مقدار رمز عبور و تکرار آن برابر نیستند"];
        } else {
            $message['confirmPassword'] = ["field" => "username", "status" => true, "message" => "صحیح"];
        }



        if ($message['email']['status'] === true && $message['username']['status'] === true && $message['password']['status'] === true && $message['confirmPassword']['status'] === true) {
            $message['finalStatus'] = true;
        } else {
            $message['finalStatus'] = false;
        }



        if ($message['finalStatus'] === false) {
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }


        $randomToken = $this->randomToken();
        $activationMessage = $this->activationMessage($username, $randomToken);

        $result = json_decode($this->sendMail($email, 'فعالسازی حساب کاربری شرکت اطلس کمپرسور ایده آل', $activationMessage));

        if (!$result) {
            $message['emailStatus'] = false;
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }
        $password = $this->hash($password);
        $db->insert('users', ['username', 'email', 'password', 'permission', 'verify_token'], [$username, $email, $password, 'user', $randomToken]);


        $message['emailStatus'] = true;


        $db->closeConnection();
        flash('success', 'ایمیل فعالساز برای شما ارسال شد، پس از فعالسازی می تواند وارد حساب کاربری خود شوید');
        echo json_encode($message);
        exit;
    }


    public function activation($verifyToken)
    {
        $db = new DataBase;
        $user = $db->select('select * from users where verify_token=?', [$verifyToken])->fetch();

        if ($user) {
            $db->update('users', $user['id'], ['verify_token', 'is_active'], [null, 1]);
        }

        $db->closeConnection();
        redirect('login-register');
    }

    public function login()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json, true);

        $email = input_data($request['email']);
        $password = input_data($request['password']);
        $message = null;

        $db = new DataBase;
        $user = $db->select('select * from users where email=?', [$email])->fetch();

        if (!isset($email) || $email == null) {
            $message['email'] = ["field" => "email", "status" => false, "message" => "پر کردن فیلد ایمیل اجباری می باشد"];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message['email'] = ["field" => "email", "status" => false, "message" => "فرمت وارد شده صحیح نمی باشد"];
        } elseif (!$user) {
            $message['email'] = ["field" => "email", "status" => false, "message" => 'کاربر با این مشخصات یافت نشد'];
        } elseif ($user['is_active'] != 1) {
            $message['email'] = ["field" => "email", "status" => false, "message" => 'کاربر غیر فعال می باشد'];
        } else {
            $message['email'] = ["field" => "email", "status" => true, "message" => "صحیح"];
        }


        if (!isset($password) || $password == null) {
            $message['password'] = ["field" => "password", "status" => false, "message" => "پر کردن فیلد رمز عبور اجباری می باشد"];
        } else {
            $message['password'] = ["field" => "username", "status" => true, "message" => "صحیح"];
        }



        if (!$message['password']['status'] ||  !$message['email']['status']) {

            $message['finalStatus'] = ["message" => "ایمیل یا رمز عبور اشتباه است", "status" => false];

            unset($message['email']);
            unset($message['password']);

            echo json_encode($message);
            $db->closeConnection();
            exit;
        }


        if (!password_verify($password, $user['password'])) {
            $message['finalStatus'] = ["message" => "ایمیل یا رمز عبور اشتباه است", "status" => false];
        } else {
            $message['finalStatus'] = ["message" => "در حال ورود ...", "status" => true];
        }


        unset($message['email']);
        unset($message['password']);


        if ($message['finalStatus']['status'] === false) {
            echo json_encode($message);
            $db->closeConnection();
            exit;
        }

        $_SESSION['user'] = $user['id'];


        echo json_encode($message);
        $db->closeConnection();
        exit;
    }


    public function forgetPassword()
    {
        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/auth/forget-password.php');
    }


    public function forgetPasswordStore($request)
    {
        if (!isset($request['email']) || $request['email'] == '') {
            flash('success', 'ایمیل حاوی لینک تغیر رمز عبور برای شما ارسال شد');
            // flash('validation-error', 'ایمیل ارسال نشد');
            redirect('login-register');
        }

        $email = input_data($request['email']);

        $db = new DataBase;
        $user = $db->select('select * from users where email=?', [$email])->fetch();


        if (!$user) {
            flash('success', 'ایمیل حاوی لینک تغیر رمز عبور برای شما ارسال شد');
            // flash('validation-error', 'کاربر یافت نشد');
            redirect('login-register');
        }

        $randomToken = $this->randomToken();
        $forgetMessage = $this->forgetMessage($user['username'], $randomToken);

        $result = $this->sendMail($email, 'به روز رسانی رمز عبور شرکت اطلس کمپرسور ایده آل', $forgetMessage);

        if (!$result) {
            // flash('success', 'ایمیل حاوی لینک تغیر رمز عبور برای شما ارسال شد');
            flash('validation-error', 'ایمیل ارسال نشد');
            redirect('login-register');
        }

        $db->update('users', $user['id'], ['forget_token', 'forget_token_expire'], [$randomToken, date('Y-m-d H:i:s', strtotime('+5 minutes'))]);


        $db->closeConnection();
        flash('success', 'ایمیل حاوی لینک تغیر رمز عبور برای شما ارسال شد، زمان انقضای استفاده از این ایمیل جهت تغییر رمز عبور فقط 15 دقیقه می باشد');
        redirect('login-register');
    }


    public function resetPassword($randomToken)
    {

        $db = new DataBase;
        $setting = $db->select('select * from settings')->fetch();

        $db->closeConnection();
        require_once(BASE_PATH . '/template/auth/reset-password.php');
    }

    public function resetPasswordStore($request)
    {


        if (!isset($request['password']) || $request['password'] == '' || !isset($request['confirm-password']) || $request['confirm-password'] == '' || !isset($request['randomToken']) || $request['randomToken'] == '') {
            flash('validation-error', 'پر کردن تمام فیلدها اجباری می باشد');
            redirectBack();
        }

        $password = input_data($request['password']);
        $confirmPassword = input_data($request['confirm-password']);
        $randomToken = input_data($request['randomToken']);

        $db = new DataBase;
        $user = $db->select('select * from users where forget_token=?', [$randomToken])->fetch();


        if (!$user) {
            flash('validation-error', 'کاربر یافت نشد');
            redirectBack();
        }

        if (strtotime($user['forget_token_expire']) < strtotime(date('Y-m-d H:i:s'))) {
            flash('validation-error', 'توکن منقضی شده است');
            redirectBack();
        }

        if (strlen($password) < 8 || strlen($confirmPassword) < 8) {
            flash('validation-error', 'حداقل طول رمز عبور 8 کاراکتر باشد');
            redirectBack();
        }

        if ($password != $confirmPassword) {
            flash('validation-error', 'رمز عبور و تکرارش برابر نیستند');
            redirectBack();
        }

        $password = $this->hash($password);
        $db->update('users', $user['id'], ['password', 'forget_token', 'forget_token_expire'], [$password, null, null]);

        $db->closeConnection();
        flash('success', " رمز عبور با موفقیت تغیر یافت");
        redirect('login-register');
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        redirect('login-register');
    }


    public function checkAdmin()
    {
        if (!isset($_SESSION['user'])) {
            redirect('login-register');
        } else {
            $db = new Database();
            $_SESSION['user'] = input_data($_SESSION['user']);

            $user = $db->select('SELECT * FROM users WHERE id=? AND is_active=1', [$_SESSION['user']])->fetch();
            $db->closeConnection();

            if ($user) {
                if ($user['permission'] === 'admin') {
                } else {
                    redirect('login-register');
                }
            } else {
                redirect('login-register');
            }
        }
    }


    public function changeProfileInfo($request)
    {
        if (!isset($_SESSION['user']) || $_SESSION == '') {
            redirect('login-register');
        }

        $db = new DataBase;
        $userId = input_data($_SESSION['user']);
        $user = $db->select("SELECT * FROM users WHERE id=? AND is_active=1", [$userId])->fetch();
        if (!$user) {
            redirect('/');
        }


        if (!isset($request['username']) || $request['username'] == '' || !isset($request['email']) || $request['email'] == '' || !isset($request['mobile']) || $request['mobile'] == '') {
            flash('validation-error', 'پر کردن فیلدهای نام و نام خانوادگی، ایمیل و موبایل اجباری می باشد');
            redirectBack();
        }

        $username = input_data($request['username']);
        $email = input_data($request['email']);
        $mobile = input_data($request['mobile']);
        $password = '';

        $mobilePattern = "/^(\+98|0)?9\d{9}$/";
        if (!preg_match($mobilePattern, $mobile)) {
            flash('validation-error', 'لطفا شماره موبایل خود را به صورت صحیح وارد فرمایید');
            redirectBack();
        }

        if ($request['password'] != '') {
            if (strlen($request['password']) < 8) {
                flash('validation-error', 'حداقل طول رمز عبور 8 کاراکتر باشد');
                redirectBack();
            }
            $password = input_data($request['password']);
        }

        $request = '';
        $request = null;

        if ($username !== $user['username']) {
            $db->update('users', $userId, ['username'], [$username]);
        }

        if ($mobile !== $user['mobile']) {
            $db->update('users', $userId, ['mobile'], [$mobile]);
        }

        if ($password !== '') {
            $password = $this->hash($password);
            $db->update('users', $userId, ['password'], [$password]);
        }

        if ($email !== $user['email']) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                flash('validation-error', 'لطفا ایمیل خود را به صورت صحیح وارد فرمایید');
                redirectBack();
            }
            $verifyToken = $this->randomToken();
            $activationMessage = $this->activationMessage($username, $verifyToken);
            $result = $this->sendMail($email, 'فعالسازی - تغیر ایمیل اطلس کمپرسور ایده آل', $activationMessage);

            if (!$result) {
                flash('validation-error', 'ارسال و تغییر ایمیل انجام نشد');
                redirectBack();
            }
            $db->update('users', $userId, ['email', 'verify_token', 'is_active'], [$email, $verifyToken, 2]);
            $db->closeConnection();
            flash('success', 'ایمیل شما با موفقیت تغیر یافت و حساب کاربری شما نیز موقتا غیر فعال شد. جهت فعالسازی مجدد حساب کاربری خود، به آدرس ایمیل جدیدی که وارد کرده اید مراجعه کرده و روی لینک فعاسازی کلیک کنید.');
            redirect('login-register');
        }

        $db->closeConnection();
        flash('success', 'اطلاعات کاربری با موفقیت به روز رسانی شد');
        redirectBack();
    }
}
