<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class BankValidation
{
    public static function create()
    {
        $is_valid = true;
        // Tên đăng nhập
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name_bank', 'Không để trống tên tài khoản');
            $is_valid = false;
        }
       
        if (!isset($_POST['account_number']) || $_POST['account_number'] === '') {
            NotificationHelper::error('account_number_', 'Không để trống số tài khoản');
            $is_valid = false;
        }
        if (!isset($_POST['bank_code']) || $_POST['bank_code'] === '') {
            NotificationHelper::error('name', 'Không để trống ngân hàng');
            $is_valid = false;
        }
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            // var_dump($_POST['status']);
            $is_valid = false;
        }

        return $is_valid;
    }
    public static function edit()
    {
        return self::create();
    }
}