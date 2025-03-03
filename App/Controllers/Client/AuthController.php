<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\View\Client\Account\Forgetpass;
use App\View\Client\Account\Token;
use App\View\Client\Account\TrashCan;
use App\View\Client\Layout\Footer;
use App\View\Client\Account\Login;
use App\View\Client\Layout\Header;
use App\View\Client\Component\Notification;
use App\Helpers\NotificationHelper;
use App\Validations\AuthValidation;
use App\Validations\ProductValidation as AuthValidationUpload;
use App\View\Client\Order\Detail;
use App\View\Client\Account\Edit;
use App\View\Client\Account\EditPassword;

class AuthController
{
    public static function index()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Login::render();
        Footer::render();
    }
    public static function addRegister()
    {
        $is_valid = AuthValidation::register();
        if (!$is_valid) {
            NotificationHelper::error('register_valid', 'Đăng ký thất bại');
            header('Location: /account');
            exit();
        }
        $hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user = new User();
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $hash_password,
            'phone' => $_POST['phone'],
        ];
        $is_exist = $user->getOneByName('email', $data['email']);
        if ($is_exist) {
            NotificationHelper::error('store_product2', 'Tài khoản này đã tồn tại');
            header('location: /account');
            exit;
        }
        $id_user = $user->createUser($data);
        $result = AuthHelper::addRegister($id_user);
        if ($result) {
            NotificationHelper::success('login', 'Đăng ký thành công');
            header('Location: /');
        } else {
            NotificationHelper::error('login', 'Đăng ký thất bại');
            header('Location: /account');
        }
    }
    public static function loginAction()
    {
        $is_valid = AuthValidation::login();
        if (!$is_valid) {
            NotificationHelper::error('login_valid', 'Đăng nhập thất bại');
            header('Location: /account');
            exit();
        }
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'remember' => isset($_POST['remember']),
        ];
        $result = AuthHelper::login($data);
        if ($result) {
            NotificationHelper::success('login', 'Đăng nhập thành công');
            header('Location: /');
        } else {
            NotificationHelper::error('login', 'Đăng nhập thất bại');
            header('Location: /account');
        }
    }

    public static function edit($id)
    {
        $is_login = AuthHelper::checkLogin();
        if (!$is_login) {
            header('Location: /account');
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin tài khoản');
            exit();
        } else {
            $result = AuthHelper::edit($id);
            if ($result) {
                if (isset($_SESSION['error']['login'])) {
                    header('Location: /account');
                    exit();
                }
                if (isset($_SESSION['error']['user_id'])) {
                    $data = $_SESSION['user'];
                    $user_id = $data['id'];
                    header("Location: /account/edit/$user_id");
                    exit();
                }
            }
            $data = $_SESSION['user'];
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Edit::render($data);
            Footer::render();
        }

    }
    public static function updateAccount($id)
    {
        $is_valid = AuthValidation::update();
        if (!$is_valid) {
            NotificationHelper::error('update', 'Cập nhật thất bại  !');
            header("Location: /account/edit/$id");
            exit();
        }
        $data = [
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
        ];
        // kiểm tra hình ảnh có hợp leej hay không 
        $is_upload = AuthValidationUpload::updateImage('avatar', );
        if ($is_upload) {
            $data['avatar'] = $is_upload;
        }
        // gọi helper để udate 
        $result = AuthHelper::update($id, $data);
        // var_dump($_COOKIE['user']);
        // die;
        if ($result) {
            NotificationHelper::success('login', 'Cập nhật thành công');
            header("Location: /account/edit/$id");
        } else {
            NotificationHelper::error('login', 'Cập nhật thất bại');
            header("Location: /account/edit/$id");
        }
    }
    public static function indexPassword($id)
    {
         $data = [
             'id' => $id,
         ];
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            EditPassword::render($data);
            Footer::render();
        
    }
    public static function updatePassword($id)
    {
        $is_login = AuthHelper::checkLogin();
        if ($is_login || isset($_POST['password'])) {
            $is_valid = AuthValidation::updatePassword();
            if (!$is_valid) {
                NotificationHelper::error('update_password', 'Cập nhật mật khẩu thất bại');
                header("Location: /account/password/$id");
                exit();
            }
            $data = [
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ];
            $result = AuthHelper::update($id, $data);
            if ($result) {
                NotificationHelper::success('login_', 'Cập nhật mật khẩu thành công');
                header("Location: /");
            } else {
                NotificationHelper::error('login', 'Cập nhật mật khẩu thất bại');
                header("Location: /account/password/$id");
            }
        } else {
            header('Location: /account');
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin tài khoản');
            exit();
        }
    }
    public static function indexTrashcan($id)
    {
        $is_login = AuthHelper::checkLogin();
        if (!$is_login) {
            header('Location: /account');
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin tài khoản');
            exit();
        } else {
            $result = AuthHelper::edit($id);
            if ($result) {
                if (isset($_SESSION['error']['login'])) {
                    header('Location: /account');
                    exit();
                }
                if (isset($_SESSION['error']['user_id'])) {
                    $data = $_SESSION['user'];
                    $user_id = $data['id'];
                    header("Location: /account/trashcan/$user_id");
                    exit();
                }
            }
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            TrashCan::render();
            Footer::render();
        }
    }
    public static function detailOrder($id)
    {
        $is_login = AuthHelper::checkLogin();
        if (!$is_login) {
            header('Location: /account');
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin tài khoản');
            exit();
        } else {
            $order = new OrderDetail();
            $data = $order->getAllOrderDetail($id);
            if ($data){
                Header::render();
                Notification::render();
                NotificationHelper::unset();
                Detail::render(data: $data, orderId: $id);
                Footer::render();
            }else{
                NotificationHelper::error('error', 'Đơn hàng không tồn tại');
                header('Location: /notfound');
            }
           
        }
    }
    public static function logout()
    {
        AuthHelper::logout();
        NotificationHelper::success('logout', 'Đăng xuất thành công');
        header('Location: /');
    }
    public static function forgetPassword()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Forgetpass::render();
        Footer::render();

    }
    public static function forgetPasswordAction()
    {
        $is_valid = AuthValidation::forgetPassword('email');
        if (!$is_valid) {
            NotificationHelper::error('forget_password', 'Vui lòng nhập email');
            header('Location: /forgetpass');
            exit();
        }
        $user = new User();
        $result = $user->getOneUserByUsername($_POST['email']);
        if ($result) {
            $token = rand(100000, 999999);
            $email = $_POST['email'];
            $body = "Mã xác nhận khôi mật khẩu của tài khoản {$result['name']} là {$token} vui long không chia sẽ cho bất kì ai.";
            MailController::index(form: $body, title: 'Khôi phục mật khẩu', emailForgetPassword: $email);
            $data = [
                'token' => $token,
            ];
            $success = $user->update($result['id'], $data);
            // var_dump($success);
            // die;
            if ($success) {
                NotificationHelper::success('forget_password_', 'Vui lòng kiểm tra email của bạn');
                header("Location: /token");
                exit();
            } else {
                NotificationHelper::error('forgetpassword', 'Cập nhật mật khẩu thất bại');
                header("Location: /");
            }
        } else {
            NotificationHelper::error('forget_password', 'Email không tồn tại');
            header('Location: /forgetpass');
            exit();
        }
    }

    public static function token()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Token::render();
        Footer::render();
    }
    public static function forgetTokenAction()
    {
        $is_valid = AuthValidation::forgetPassword('token');
        if (!$is_valid) {
            NotificationHelper::error('forget_token', 'Vui lòng nhập mã xác nhận');
            header('Location: /token');
            exit();
        }
        $user = new User();
        $result = $user->getOneUserByToken($_POST['token']);
        if ($result) {
            
            header("Location: /account/password/".$result['id']);
            exit();
        } else {
            NotificationHelper::error('forgetpassword', 'Cập nhật mật khẩu thất bại');
            header("Location: /");
        }
    }
}