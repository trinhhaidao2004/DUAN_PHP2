<?php
namespace App\Controllers\Client;

use App\Controllers\Client\CartController;
use App\Helpers\CartHelper;
use App\Models\Bank;
use App\Models\VietQRModel;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Headerpay;
use App\View\Client\Order\Payment;
use App\Helpers\NotificationHelper;
use App\Models\Order;
use App\Models\User;
use App\View\Client\Layout\Footer as LayoutFooter;
use App\View\Client\Layout\Headerpay as LayoutHeader;

class PaymentController
{


    public static function createQRCode()
    {
        $cart_data = CartController::getorder();
        $total = CartHelper::total($cart_data);
        $banks = new Bank();
        $result = $banks->getAllClientBank();
        if ($result) {
            LayoutHeader::render();
            Payment::render($result);
            LayoutFooter::render();
        } else {
            echo "Lỗi: Không tạo được mã QR.";
        }
    }
    public static function updateOrder()
    {
        $order_id = $_SESSION['order_id'];
        $orders = new Order();
        $result = $orders->getOneOrderByStatus($order_id);
        $result['id'];
        if ($result['orderStatus'] === 1) {
            $data = [
                'orderStatus' => 6,
            ];
            $orders->update($result['id'], $data);
            setcookie('cart', '', time() - (3600 * 24 * 30 * 12), '/');
        }
    }


    public static function cancelOrder($id)
    {
        $orders = new Order();
        $result = $orders->getOneOrderByStatus($id);
        // var_dump($result);
        // die;
        if ($result['orderStatus'] === 1 && $result['paymentMethod'] == 'COD') {
            $data = [
                'orderStatus' => 0,
            ];
            $result = $orders->update($id, $data);
            if ($result) {
                NotificationHelper::success('cancelOrder', 'Hủy đơn hàng thành công');
                header("Location: /account/trashcan/" . $_SESSION['user']['id']);
                exit();
            } else {
                NotificationHelper::error('cancelOrder', 'Hủy đơn hàng thất bại');
                header("Location: /account/trashcan/" . $_SESSION['user']['id']);
            }
        }
        if (($result['orderStatus'] === 1 && $result['paymentMethod'] == 'PAYMENT') || ($result['orderStatus'] === 1 && $result['paymentMethod'] == 'VNPAY') ) {
            $user = new User();
            $getOnUser = $user->getOne($_SESSION['user']['id']);
            $getOnUser['balance'] += $result['total'];
            $data = [
                'balance' => $getOnUser['balance'],
            ];
            $result = $user->updateUser($_SESSION['user']['id'], $data);
            if ($result) {
                $data = [
                    'orderStatus' => 0,
                ];
                $result = $orders->update($id, $data);
                if ($result) {
                    NotificationHelper::success('cancelOrder', 'Hủy đơn hàng thành công');
                    header("Location: /account/trashcan/" . $_SESSION['user']['id']);
                    exit();
                } else {
                    NotificationHelper::error('cancelOrder', 'Hủy đơn hàng thất bại');
                    header("Location: /account/trashcan/" . $_SESSION['user']['id']);
                }
            }
        }
    }



    // Ví dụ trong file PHP (đường dẫn: /order/balance)
    public static function OrderBalance()
    {
        if ($_POST['payment_method'] === 'BLANCE') {
            $balance = floatval($_POST['balance']);
            $total = floatval($_POST['total']);
            if ($balance >= $total) {
                $balance -= $total;
                $total = 1000;
                echo json_encode([
                    'balance' => $balance,
                    'total' => $total
                ]);
                exit;
            }
            if ($balance < $total) {
                $total -= $balance;
                $balance = 0;
                echo json_encode([
                    'balance' => $balance,
                    'total' => $total
                ]);
                exit;
            }

        }

        echo json_encode(['error' => 'Invalid payment method']);
        exit;
    }


}
