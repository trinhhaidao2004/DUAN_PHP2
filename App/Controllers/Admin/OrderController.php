<?php

namespace App\Controllers\Admin;

use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Models\Order;
use App\Models\OrderDetail;
use App\View\Admin\Layout\Footer;
use App\View\Admin\Page\Order\Index;

use App\View\Admin\Layout\Header;
use App\View\Admin\Page\Order\Detail;

class OrderController
{
    // ddown hangf chx thanh toans
    public static function index($id)
    {
        $is_login = AuthHelper::checkLogin();
        if ($is_login) {
            $order = new Order();
            if ($id == 0) {
                $title = 'Đã hủy';
                $data = $order->getAllorderByStatusAdmin('orderStatus', '=', int: 0);
            } else if ($id == 1) {
                $title = 'Chờ xử lí';
                $data = $order->getAllorderByStatusAdmin('orderStatus', '=', $id);
            } else if ($id == 2) {
                $title = 'Đã xác nhận';
                $data = $order->getAllorderByStatusAdmin('orderStatus', '=', $id);
            } else if ($id == 3) {
                $title = 'Đang chuẩn bị';
                $data = $order->getAllorderByStatusAdmin('orderStatus', '=', $id);
            } else if ($id == 4) {
                $title = 'Đang giao hàng';
                $data = $order->getAllorderByStatusAdmin('orderStatus', '=', $id);
            } else if ($id == 5) {
                $title = 'Giao thành công';
                $data = $order->getAllorderByStatusAdmin('orderStatus', '=', $id);
            } else if ($id == 6) {
                $title = 'Chờ thanh toán';
                $data = $order->getAllorderByStatusAdmin('orderStatus', '=', $id);
            } else if ($id == 7) {
                $title = 'Hoàn trả\Hoàn tiền';
                $data = $order->getAllorderByStatus('orderStatus', '=', $id);
            } else {
                $data = $order->getAllorder();
            }
            Header::render();
            Index::render(title: $title, data: $data);
            Footer::render();
        } else {
            header('Location: /account');
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin tài khoản');
            exit();
        }
    }
    public static function confirmed()
    {
        Header::render();
        // Pending::render();
        Footer::render();
    }
    public static function detail($id)
    {
        $is_login = AuthHelper::checkLogin();
        if ($is_login) {
            $order = new OrderDetail();
            $result = $order->getAllOrderDetailIdAdmin($id);
            if (empty($result)) {
                header('Location: /notfound');
                NotificationHelper::error('error', 'Đơn hàng không tồn tại');
                exit();
            }
            if ($result[0]['orderStatus'] == 0) {
                $title = 'Đã hủy';
            } else if ($result[0]['orderStatus'] == 1) {
                $title = 'Chờ xử lí';
            } else if ($result[0]['orderStatus'] == 2) {
                $title = 'Đã xác nhận';
            } else if ($result[0]['orderStatus'] == 3) {
                $title = 'Đang chuẩn bị';
            } else if ($result[0]['orderStatus'] == 4) {
                $title = 'Đang giao hàng';
            } else if ($result[0]['orderStatus'] == 5) {
                $title = 'Giao thành công';
            } else if ($result[0]['orderStatus'] == 6) {
                $title = 'Chờ thanh toán';
            } else if ($result[0]['orderStatus'] == 7) {
                $title = 'Hoàn trả\Hoàn tiền';
            }
            $data = [
                'order_id' => $id,
                'orderDetail' => $result,
            ];
            // echo '<pre>';
        //    var_dump($data['orderDetail']);
        //    die;
            Header::render();
            Detail::render(title: $title, data: $data);
            Footer::render();
        } else {
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin tài khoản');
            header('Location: /account');
            exit();
        }

    }
}