<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\CartHelper;
use App\Models\Category;
use App\Models\Vnpays;
use App\View\Client\Cart\Bill;
use App\View\Client\Layout\Footer;
use App\View\Client\Index;
use App\View\Client\Layout\Header;
use App\View\Client\Page\NotFound;
use App\Models\Product;
use App\View\Client\Component\Notification;
use App\Helpers\NotificationHelper;

class HomeController
{
    public static function index()
    {
        $product = new Product();
        $category = new Category();
        $data = [
            'products' => $product->getAllProduct(),
            'categories' => $category->getAll('status', '=', 1) // Lấy tất cả danh mục sản phẩm trạng thái 1
        ];
       // var_dump(count($data['products']) );
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        NotificationHelper::unsetorder();
        Index::render($data);
        Footer::render();
    }
    public static function thanks()
    {
        $is_login = AuthHelper::checkLogin();
        if ($is_login) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $vnp_ResponseCode = $_GET['vnp_ResponseCode'] ?? null;
                if ($vnp_ResponseCode == '00') {
                    $cart_data = CartController::getorder();
                        CartHelper::createCart($cart_data);
                    setcookie('cart', '', time() - (3600 * 24 * 30 * 12), '/');
                    $timeStr = $_GET['vnp_PayDate'];
                    // Chuyển chuỗi sang timestamp
                    $timestamp = strtotime(substr($timeStr, 0, 8) . ' ' . substr($timeStr, 8));
                    $date = date("Y-m-d H:i:s", $timestamp);
                    $data = [
                        "vnp_Amount" => $_GET['vnp_Amount'],
                        "vnp_BankCode" => $_GET['vnp_BankCode'],
                        "vnp_BankTranNo" => $_GET['vnp_BankTranNo'],
                        "vnp_CardType" => $_GET['vnp_CardType'],
                        "vnp_OrderInfo" => $_GET['vnp_OrderInfo'],
                        "vnp_PayDate" => $date,
                        "vnp_ResponseCode" => $_GET['vnp_ResponseCode'],
                        "vnp_TransactionStatus" => $_GET['vnp_TransactionStatus'],
                        "vnp_TxnRef" => $_GET['vnp_TxnRef'],
                        "order_id" => $_SESSION['order_id'],
                    ];
                    // var_dump($data);
                    // die;
                    $vnpays = new Vnpays();
                    $vnpays->createVnpay($data);
                    Bill::render();
                } else {
                    // Thất bại hoặc bị hủy
                    header('Location: http://127.0.0.1:8080/checkout');
                    unset($_SESSION['information']);
                    exit();
                }
            }
        } else {
            NotificationHelper::error('s', 'Bnạ không có quyền truy cập trang này!');
            header('location: /');
        }

    }
    public static function notfound()
    {
        NotFound::render();
    }
    public static function thanksOrder()
    {
        Bill::render();
    }
   
}

