<?php

namespace Activities\Admin;

use Activities\Auth\Auth;
use Database\DataBase;


class Admin
{
    protected function redirect($url)
    {
        header('Location: ' . trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
        exit;
    }

    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function __construct()
    {
        $db = new DataBase;
        $discounts = $db->select('SELECT * from discounts')->fetchAll();

        $auth = new Auth;
        $auth->checkAdmin();

        foreach ($discounts as $discount) {
            if ($discount['start_date'] >= $discount['end_date']) {

                $db->update('discounts', $discount['id'], ['status'], ['2']);
            }
        }
        $db->closeConnection();
    }


    // //saveImage($_FILES,'public','tatoo')
    // protected function saveImage($image, $imagePath, $imageName = null)
    // {
    //     if ($imageName) {
    //         $extention = explode('/', $image['type'])[1];
    //         $imageName = $imageName . '.' . $extention;
    //     } else {
    //         $extention = explode('/', $image['type'])[1];
    //         $imageName = date('Y-m-d-H-i-s') . '.' . $extention;
    //     }

    //     $imageTemp = $image['tmp_name'];
    //     $imagePath = 'public/' . $imagePath . '/';

    //     if (is_uploaded_file($imageTemp)) {
    //         if (move_uploaded_file($imageTemp, $imagePath . $imageName)) {
    //             return $imagePath . $imageName;
    //         } else {
    //             return false;
    //         }
    //     } {
    //         return false;
    //     }
    // }

    // protected function removeImage($path)
    // {
    //     $path = trim($path, '/ ');
    //     if (file_exists($path)) {
    //         unlink($path);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
