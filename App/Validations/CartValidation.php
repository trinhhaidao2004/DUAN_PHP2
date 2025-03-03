<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class CartValidation
{
    public static function create(): bool
    {
        $is_valid = true;
        // Tên đăng nhập
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name_', 'Họ tên không được để trống');
            $is_valid = false;
        }
        // Mật khẩu

        if (!isset($_POST['phone']) || $_POST['phone'] === '') {
            NotificationHelper::error('phone_', 'Không để trống Số điện thoại');
            $is_valid = false;
        } else {
            $phonePattern = "/^(0[0-9]{9,10})$/";
            if (!preg_match($phonePattern, $_POST['phone'])) {
                NotificationHelper::error('phone_', 'Số điện thoại không đúng định dạng');
                $is_valid = false;
            } else if (strlen($_POST['phone']) !== 10) {
                NotificationHelper::error('phone_', 'Số điện thoại phải có đúng 10 ký tự số');
                $is_valid = false;
            }
        }
        // Email
        if (!isset($_POST['province']) || $_POST['province'] === '') {
            NotificationHelper::error('province_2', 'Không để trống Tỉnh');
            $is_valid = false;
        }
        if (!isset($_POST['district']) || $_POST['district'] === '') {
            NotificationHelper::error('district_2', 'Không để trống huyện');
            $is_valid = false;
        }
        if (!isset($_POST['ward']) || $_POST['ward'] === '') {
            NotificationHelper::error('ward_2', 'Không để trống phường');
            $is_valid = false;
        }
        if (!isset($_POST['address']) || $_POST['address'] === '') {
            NotificationHelper::error('address_2', 'Không để trống địa chỉ');
            $is_valid = false;
        }
        // if (!isset($_POST['PaymentMethod']) || $_POST['PaymentMethod'] === '') {
        //     NotificationHelper::error('PaymentMethod2', 'Vui lòng chọn phương thức thanh toán');
        //     $is_valid = false;
        // }
        if (!isset($_POST['delivery']) || $_POST['delivery'] === '') {
            NotificationHelper::error('delivery_error', 'Vui lòng chọn phương thức giao hàng');
            $is_valid = false;
        }
        return $is_valid;
    }
}
