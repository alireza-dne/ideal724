<?php


function dd($data)
{
    echo '<pre style="background-color:black;color:springgreen;padding:10px;font-size:1rem;">';
    var_dump($data);
    exit;
}

function asset($src)
{
    $domain = trim(BASE_URL, '/ ');
    $src = $domain . '/' . trim($src, '/ ');
    return $src;
}


function url($url)
{
    $domain = trim(BASE_URL, '/ ');
    $url = $domain . '/' . trim($url, '/ ');
    return $url;
}

function methodField()
{
    return $_SERVER['REQUEST_METHOD'];
}

function input_data($data)
{
    $data = trim($data, '/ ');
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function displayError($displayError)
{
    if ($displayError) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);
    }
}
displayError(DISPLAY_ERROR);

global $flashMessage;
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

function flash($name, $value = null)
{
    if ($value == null) {
        global $flashMessage;
        $message = isset($flashMessage[$name]) ? $flashMessage[$name] : '';
        return $message;
    } else {
        $_SESSION['flash_message'][$name] = $value;
    }
}




if (isset($_SESSION['old'])) {
    unset($_SESSION['temporary_old']);
}


if (isset($_SESSION['old'])) {
    $_SESSION['temporary_old'] = $_SESSION['old'];
    unset($_SESSION['old']);
}

$params = [];
$params = !isset($_GET) ? $params : array_merge($params, $_GET);
$params = !isset($_POST) ? $params : array_merge($params, $_POST);
$_SESSION['old'] = $params;
unset($params);


function old($name)
{
    if (isset($_SESSION['temporary_old'][$name])) {
        return $_SESSION['temporary_old'][$name];
    } else {
        return null;
    }
}



spl_autoload_register(function ($className) {
    $path = BASE_PATH . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR;
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    include $path . $className . '.php';
});






//saveImage($_FILES,'public','tatoo')
function saveImage($image, $imagePath, $imageName = null)
{
    if ($imageName) {
        $extention = explode('/', $image['type'])[1];
        if ($extention == 'svg' || $extention == 'svg+xml') {
            $extention = 'svg';
        }
        $imageName = $imageName . '.' . $extention;
    } else {
        $extention = explode('/', $image['type'])[1];
        if ($extention == 'svg' || $extention == 'svg+xml') {
            $extention = 'svg';
        }
        $imageName = date('Y-m-d-H-i-s') . '.' . $extention;
    }

    $allowMimes = ['png', 'jpeg', 'jpg', 'gif', 'webp', 'tiff', 'svg'];
    $imageMime = pathinfo($image['name'], PATHINFO_EXTENSION);
    $imageMime = strtolower($imageMime);
    if (!in_array($imageMime, $allowMimes)) {
        flash('validation-error', 'برای تصویر فقط فرمت های png, jpeg, jpg, gif, webp, tiff, svg مورد قبول می باشد.');
        redirectBack();
    }
    $imageTemp = $image['tmp_name'];
    $imagePath = 'public/' . $imagePath . '/';

    if (is_uploaded_file($imageTemp)) {
        if (move_uploaded_file($imageTemp, $imagePath . $imageName)) {
            return $imagePath . $imageName;
        } else {
            return false;
        }
    } {
        return false;
    }
}





function removeImage($path)
{
    $path = trim($path, '/ ');
    if (file_exists($path)) {
        unlink($path);
        return true;
    } else {
        return false;
    }
}



function redirect($url)
{
    header('Location: ' . trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
    exit;
}

function redirectBack()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function jalaliData($date)
{
    return \Parsidev\Jalali\jDate::forge($date)->format('datetime');
}


function jalaliData2($date)
{
    return str_replace('-', '/', \Parsidev\Jalali\jDate::forge($date)->format('date'));
}
