<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\CartHelper;
use App\Models\Product;
use App\Models\User;
use App\View\Client\Layout\Footer;
use App\View\Client\Cart\Cart;
use App\View\Client\Cart\Checkout;
use App\View\Client\Layout\Header;
use App\View\Client\Component\Notification;
use App\Helpers\NotificationHelper;
use App\Helpers\PayHelper;
use App\Validations\CartValidation;

class CartController
{
    public static function index()
    {
        if (isset($_COOKIE['cart'])) {
            $product = new Product();
            $cookie_data = $_COOKIE['cart'];
            $cart_data = json_decode($cookie_data, true);
            // // echo "<pre>";
            // echo "<pre>";
            // var_dump($cart_data);
            if (count($cart_data)) {
                foreach ($cart_data as $key => $value) {
                    $product_id = $value['product_id'];
                    // var_dump($product_id);
                    $result = $product->getOneProduct($product_id);
                    // var_dump($result);
                    $cart_data[$key]['data'] = $result;
                }
                Header::render();
                Notification::render();
                NotificationHelper::unset();
                Cart::render($cart_data);
                Footer::render();
            } else {
                // setcookie("cart", "", time() -  3600 * 24 * 30 * 12, '/');
                // $_SESSION['error'] = 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào';
                NotificationHelper::error('cart', 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào');
                header('location: /');
            }
        } else {
            // $_SESSION['error'] = 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào';
            NotificationHelper::error('cart', 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào');
            header('location: /');
            // var_dump($_SESSION['error']);
        }

    }
    public static function add()
    {
        // Tạo đối tượng Product để lấy thông tin sản phẩm nếu cần
        $product = new Product();

        // Render header và footer
        // HeaderController::render();
        // Footer::render();

        // Lấy product_id từ request POST
        $product_id = $_POST['id'];
        $number = $_POST['number'];
        // var_dump($product_id);
        // Kiểm tra nếu đã có cookie 'cart'
        if (isset($_COOKIE['cart'])) {

            // Lấy dữ liệu từ cookie và chuyển đổi từ JSON string sang array
            $cookie_data = $_COOKIE['cart'];
            $cart_data = json_decode($cookie_data, true);
        } else {
            // Nếu chưa có cookie, khởi tạo giỏ hàng trống
            $cart_data = [];
        }

        // Lấy danh sách product_id từ giỏ hàng
        $product_id_arr = array_column($cart_data, 'product_id');

        // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
        if (in_array($product_id, $product_id_arr)) {
            // Nếu sản phẩm đã có, duyệt qua giỏ hàng để tăng số lượng sản phẩm
            foreach ($cart_data as $key => $value) {

                if ($cart_data[$key]['product_id'] == $product_id) {

                    if (isset($_POST['number'])) {
                        $cart_data[$key]['quantity'] += $number;
                    } else {
                        $cart_data[$key]['quantity'] += 1;
                    }
                }
            }
        } else {
            if (isset($_POST['number'])) {
                if ($_POST['number'] > 0) {
                    $product_array = [
                        'product_id' => $product_id,
                        'quantity' => $number,
                    ];
                } else {
                    header('location: /');
                    exit();
                }


            } else {
                $product_array = [
                    'product_id' => $product_id,
                    'quantity' => 1,
                ];
            }

            // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm với số lượng 1

            $cart_data[] = $product_array;
        }

        // Chuyển array thành JSON string để lưu vào cookie
        $product_data = json_encode($cart_data);

        // Lưu cookie 'cart' với thời hạn là 1 năm (3600 giây * 24 giờ * 30 ngày * 12 tháng)
        setcookie('cart', $product_data, time() + 3600 * 24 * 30 * 12, '/');

        // Hiển thị thông báo thêm sản phẩm thành công
        NotificationHelper::success('cart', 'Đã thêm sản phẩm vào giỏ hàng');

        // Chuyển hướng về trang giỏ hàng để cập nhật
        header('location: /cart');
        exit();
    }
    public static function update()
    {
        $product_id = $_POST['id'];
        $quantity = $_POST['quantity'];

        if (isset($_COOKIE['cart'])) {
            // nếu đã tồn tại cookie cart thì lấy giá trị của cookie cart 
            // nếu đã tồn tại cookie cart thì lấy giá trị của cookie cart 
            $cookie_data = $_COOKIE['cart'];

            // chuyển string thành array 
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $product_id_arr = array_column($cart_data, 'product_id');

        // kiểm tra product_id có tồn tại trong cookie cart chưa 
        if (in_array($product_id, $product_id_arr)) {
            foreach ($cart_data as $key => $value) {
                // nếu có thì cập nhật số lượng = số lượng mà ng dùng submit
                if ($cart_data[$key]['product_id'] == $product_id) {
                    $cart_data[$key]['quantity'] = $quantity;
                }
            }
        } else {
            // nếu chưa có thì thêm vào cookie cart 
            $product_array = array(
                'product_id' => $product_id,
                'quantity' => 1,
            );
            $cart_data[] = $product_array;
        }

        // chuyển array thành string để lưu vào cookie cart 
        $product_data = json_encode($cart_data);

        // lưu cookie 
        setcookie('cart', $product_data, time() + 3600 * 24 * 30 * 12, '/');

        NotificationHelper::success('cart', 'Đã cập nhật số lượng sản phẩm');

        // sau khi lưu cookie thì phải chuyển trang/ load lại thì mới ăn cookie
        header('location: /cart');
    }
    public static function deleteItem()
    {
        if (isset($_COOKIE['cart'])) {
            $cookie_data = $_COOKIE['cart'];
            $cart_data = json_decode($cookie_data, true);
            foreach ($cart_data as $key => $value) {
                if ($cart_data[$key]['product_id'] == $_POST['id']) {
                    unset($cart_data[$key]);
                    $product_data = json_encode($cart_data);
                    setcookie("cart", $product_data, time() + 3600 * 24 * 30 * 12, '/');
                }
            }
            NotificationHelper::success('cart', 'Đã xoá sản phẩm khỏi giỏ hàng');
            header('location: /cart');
        }
    }
    public static function checkout()
    {
        $is_login = AuthHelper::checkLogin();
        if (!$is_login) {
            header('Location: /account');
            NotificationHelper::error('', 'Vui lòng đăng nhập để có thể thực hiện chức năng này');
            exit();
        } else {
            if (isset($_COOKIE['cart'])) {
                $product = new Product();
                $cookie_data = $_COOKIE['cart'];
                $cart_data = json_decode($cookie_data, true);
                // // echo "<pre>";
                // echo "<pre>";
                // var_dump($cart_data);
                if (count($cart_data)) {
                    foreach ($cart_data as $key => $value) {
                        $product_id = $value['product_id'];
                        // var_dump($product_id);
                        $result = $product->getOneProduct($product_id);
                        // var_dump($result);
                        $cart_data[$key]['data'] = $result;
                    }
                    Header::render();
                    Checkout::render($cart_data);
                    Footer::render();
                } else {
                    // setcookie("cart", "", time() -  3600 * 24 * 30 * 12, '/');
                    // $_SESSION['error'] = 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào';
                    NotificationHelper::error('cart', 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào');
                    header('location: /');
                }
            } else {
                // $_SESSION['error'] = 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào';
                NotificationHelper::error('cart', 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào');
                header('location: /');
                // var_dump($_SESSION['error']);
            }
        }

    }
    public static function getorder()
    {
        if (isset($_COOKIE['cart'])) {
            $product = new Product();
            $cookie_data = $_COOKIE['cart'];
            $cart_data = json_decode($cookie_data, true);
            if (count($cart_data)) {
                foreach ($cart_data as $key => $value) {
                    $product_id = $value['product_id'];
                    $result = $product->getOneProduct($product_id);
                    $cart_data[$key]['data'] = $result;
                }
            } else {
                NotificationHelper::error('cart', 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào');
                header('location: /');
            }
        }
        return $cart_data;
    }
    public static function order()
    {
        $is_login = AuthHelper::checkLogin();
        if ($is_login) {
            $is_valid = CartValidation::create();
            if (!$is_valid) {
                NotificationHelper::error('update_product2', 'Cập nhật sản phẩm thất bại  !');
                header("Location: /checkout");
                exit();
            }
            $cart_data = self::getorder();
            $data = [
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'province' => $_POST['province_'],
                'district' => $_POST['district_'],
                'ward' => $_POST['ward_'],
                'province_code' => $_POST['province'],
                'district_code' => $_POST['district'],
                'ward_code' => $_POST['ward'],
                'address' => $_POST['address'],
                'PaymentMethod' => $_POST['PaymentMethod'],
                'delivery' => $_POST['delivery'],
            ];
            // var_dump($data);
            // die;
            $_SESSION['information'] = $data;
            if ($_POST['PaymentMethod'] === 'COD') {
                CartHelper::createCart($cart_data);
                NotificationHelper::success('cart', 'Đặt hàng thành công');
                header('location: /thanks/order');
                exit();
            } else if ($_POST['PaymentMethod'] === 'BLANCE') {
                CartHelper::totalBalance($cart_data);
                CartHelper::createCart($cart_data);
                NotificationHelper::success('cart', 'Đặt hàng thành công');
                header('location: /thanks/order');
                
                exit();
            } else if ($_POST['PaymentMethod'] === 'PAYMENT') {
                $_SESSION['QRCode'] = 'QRCode';
                CartHelper::createCart($cart_data);
                PaymentController::createQRCode();
            } else {
                $total = CartHelper::total($cart_data);
                // var_dump($total);
                // die;
                PayHelper::VNpay($total);
            }
        } else {
            NotificationHelper::error('cart', 'Vui lòng đăng nhập để thực hiện chức năng này');
            header('location: /');
        }
    }
}