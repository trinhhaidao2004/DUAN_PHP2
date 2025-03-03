<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class AuthValidation
{
    public static function register(): bool
    {
        $is_valid = true;

        // Tên đăng nhập
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Không để trống họ và tên');
            $is_valid = false;
        }
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            NotificationHelper::error('email', 'Không để trống Email');
            $is_valid = false;
        } else {
            $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
            if (!preg_match($emailPattern, $_POST['email'])) {
                NotificationHelper::error('email', 'Email không đúng định dạng');
                $is_valid = false;
            }
        }
        if (!isset($_POST['phone']) || $_POST['phone'] === '') {
            NotificationHelper::error('phone', 'Không để trống Số điện thoại');
            $is_valid = false;
        } else {
            $phonePattern = "/^(0[0-9]{9,10})$/";
            if (!preg_match($phonePattern, $_POST['phone'])) {
                NotificationHelper::error('phone', 'Số điện thoại không đúng định dạng');
                $is_valid = false;
            }
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
      

        return $is_valid;
    }

    public static function contactForm()
    {
        $is_valid = true;
        // Tên
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'vui lòng nhập họ và tên');
            $is_valid = false;
        }
        // Email
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            NotificationHelper::error('email', 'Không để trống Email');
            $is_valid = false;
        } else {
            $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
            if (!preg_match($emailPattern, $_POST['email'])) {
                NotificationHelper::error('email', 'Email không đúng định dạng');
                $is_valid = false;
            }
        }
        // Số điện thoại
        if (!isset($_POST['phone']) || $_POST['phone'] === '') {
            NotificationHelper::error('phone', 'Không để trống Số điện thoại');
            $is_valid = false;
        } else {
            $phonePattern = "/^(0[0-9]{9,10})$/";
            if (!preg_match($phonePattern, $_POST['phone'])) {
                NotificationHelper::error('phone', 'Số điện thoại không đúng định dạng');
                $is_valid = false;
            }
        }
        return $is_valid;

    }


    public static function login(): bool
    {
        $is_valid = true;

        // Tên đăng nhập
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            NotificationHelper::error('email', 'Không để trống email');
            $is_valid = false;
        }
        // Mật khẩu
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            NotificationHelper::error('password', 'Không để trống mật khẩu');
            // var_dump($_POST['password']);
            $is_valid = false;
        }

        return $is_valid;
    }

    public static function edit(): bool
    {
        $is_valid = true;


        // Email
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            NotificationHelper::error('email', 'Không để trống Email');
            $is_valid = false;
        } else {
            $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
            if (!preg_match($emailPattern, $_POST['email'])) {
                NotificationHelper::error('email', 'Email không đúng định dạng');
                $is_valid = false;
            }
        }

        if (!isset($_POST['phone']) || $_POST['phone'] === '') {
            NotificationHelper::error('phone', 'Không để trống Số điện thoại');
            $is_valid = false;
        } else {
            $phonePattern = "/^(0[0-9]{9,10})$/";
            if (!preg_match($phonePattern, $_POST['phone'])) {
                NotificationHelper::error('phone', 'Số điện thoại không đúng định dạng');
                $is_valid = false;
            }
        }
        return $is_valid;
    }
    public static function update(): bool
    {

        $is_valid = true;
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Họ và tên không được để trống!');
            $is_valid = false;
        }
        if (!isset($_POST['phone']) || $_POST['phone'] === '') {
            NotificationHelper::error('phone', 'Không để trống Số điện thoại');
            $is_valid = false;
        } else {
            $phonePattern = "/^(0[0-9]{9,10})$/";
            if (!preg_match($phonePattern, $_POST['phone'])) {
                NotificationHelper::error('phone', 'Số điện thoại không đúng định dạng');
                $is_valid = false;
            } elseif (strlen($_POST['phone']) !== 10) {
                NotificationHelper::error('phone', 'Số điện thoại phải có đúng 10 ký tự số');
                $is_valid = false;
            }
        }
       
        return $is_valid;
    }

    public static function updatePassword(): bool
    {
        $is_valid = true;

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

        return $is_valid;
    }
    public static function forgetPassword($value): bool
    {
        $is_valid = true;

        // Tên đăng nhập
        if (!isset($_POST[$value]) || $_POST[$value] === '') {
            $is_valid = false;
        }

        return $is_valid;
    }
}
