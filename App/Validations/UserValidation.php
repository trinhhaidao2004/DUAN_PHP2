<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class UserValidation
{

  public static function create()
  {
    $is_valid = true;

    if (!isset($_POST['name']) || $_POST['name'] === '') {
      NotificationHelper::error('name', 'Không để trống họ và tên');
      $is_valid = false;
    }
    // Tên đăng nhập
    if (!isset($_POST['username']) || $_POST['username'] === '') {
      NotificationHelper::error('username', 'Không để trống tên đăng nhập');
      $is_valid = false;
    }

    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] === UPLOAD_ERR_NO_FILE) {
      NotificationHelper::error('avatar', 'Vui lòng chọn một hình ảnh.');
      $is_valid = false;
    }
    if (!isset($_POST['phone']) || $_POST['phone'] === '') {
      NotificationHelper::error('phone', 'Không để trống số điện thoại');
      $is_valid = false;
    }
    if (!isset($_POST['email']) || $_POST['email'] === '') {
      NotificationHelper::error('email', 'Không để trống họ và tên');
      $is_valid = false;
    }
    // Mật khẩu
    if (!isset($_POST['password']) || $_POST['password'] === '') {
      NotificationHelper::error('password', 'Không để trống mật khẩu');
      $is_valid = false;
    } else {
      if (strlen($_POST['password'] < 3)) {
        NotificationHelper::error('password', 'Mật khẩu phải có ít nhất 3 ký tự');
        $is_valid = false;
      }
    }
    if (!isset($_POST['role']) || $_POST['role'] === '') {
      NotificationHelper::error('role', 'Không để trống quyền');
      $is_valid = false;
    }
    // Nhập lại mật khẩu
    if (!isset($_POST['re_password']) || $_POST['re_password'] === '') {
      NotificationHelper::error('re_password', 'Không để trống nhập lại mật khẩu');
      $is_valid = false;
    } else {
      if ($_POST['re_password'] != $_POST['password']) {
        NotificationHelper::error('re_password', 'Mật khẩu nhập lại không trùng với mật khẩu đã nhập');
        $is_valid = false;
      }
    }

    // Email
    if (!isset($_POST['email']) || $_POST['email'] === '') {
      NotificationHelper::error('email', 'Không để trống email');
      $is_valid = false;
    } else {
      $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
      if (!preg_match($emailPattern, $_POST['email'])) {
        NotificationHelper::error('email', 'Email không đúng định dạng');
        $is_valid = false;
      }
    }
    if (!isset($_POST['adress']) || $_POST['adress'] === '') {
      NotificationHelper::error('adress', 'Không để trống địa chỉ');
      $is_valid = false;
    }
    return $is_valid;
  }

  public static function edit()
  {
    $is_valid = true;
    if (!isset($_POST['role']) || $_POST['role'] === '') {
      NotificationHelper::error('role', 'Không để trống quyền');
      $is_valid = false;
    }
    return $is_valid;
  }

  public static function uploadAvatar()
  {
    return ProductValidation::updateImage('avatar');
  }

}