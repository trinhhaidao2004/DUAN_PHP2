<?php

namespace App\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use App\View\Admin\Layout\Footer;
use App\View\Admin\Page\User\Index;
use App\View\Admin\Page\User\Add;
use App\View\Admin\Page\User\Edit;
use App\View\Admin\Layout\Header;
use App\Helpers\NotificationHelper;
use App\View\Admin\Component\Notification;
use App\Validations\UserValidation;
use App\View\Admin\Page\Order\Index as IndexOrderUser;
class UserController
{
    public static function index()
    {
        $user = new User();
        $data = $user->getUsers();
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }
    public static function add()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Add::render();
        Footer::render();
    }
    public static function addAction()
    {
        $is_valid = UserValidation::create();
        if (!$is_valid) {

            NotificationHelper::error('store', 'Thêm khách hàng thất bại');
            header('location: /admin/users/create');
            exit();
        }
        $email = $_POST['email'];
        $user = new User();
        $is_exsite = $user->getOneUserByUsername($email);
        if ($is_exsite) {
            NotificationHelper::error('store', 'Tên loại người dùng đã tồn tại');
            header('location: /admin/users/create');
            exit();
        }
        $data = [
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];

        $is_upload = UserValidation::uploadAvatar();
        if ($is_upload) {
            $data['avatar'] = $is_upload;
        }
        // var_dump($data );
        // die;
        $result = $user->createUser($data);
        if ($result) {
            NotificationHelper::success('store', 'Thêm khách hàng thành công');
            header('location: /admin/users');
            exit();
        } else {
            NotificationHelper::error('store', 'Thêm khách hàng thất bại');
            header('location: /admin/users/create');
            exit();
        }
    }
    public static function edit($id)
    {
        $user = new User();
        $data = $user->getOne($id);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit::render($data);
        Footer::render();
    }
    public static function update($id)
    {
        if ($_SESSION['user']['id'] == $id) {
            NotificationHelper::error('store', 'Bạn không có quyền sửa thông tin của mình');
            header('location: /admin/users');
            exit();
        }
        $is_valid = UserValidation::edit();
        // var_dump($is_valid);
        // die;
        if (!$is_valid) {
            NotificationHelper::error('store', 'Cập nhật khách hàng thất bại');
            header('location: /admin/users/edit/' . $id);
            exit();
        }
        $data = [
            'role' => $_POST['role'],
        ];
        $user = new User();
        $result = $user->updateUser($id, $data);
        if ($result) {
            NotificationHelper::success('store', 'Cập nhật khách hàng thành công');
            header('location: /admin/users');
            exit();
        } else {
            NotificationHelper::error('store', 'Cập nhật khách hàng thất bại');
            header('location: /admin/users/edit/' . $id);
            exit();
        }
    }
    public static function historyIndex($id)
    {
        $order = new Order();
        $data = $order->getAllOderByUser($id);
        if (!$data) {
            NotificationHelper::error('user_order', 'Tài khoản chưa có đơn hàng nào');
            header('location: /admin/users');
            exit();
        }
        Header::render();
        IndexOrderUser::render(title: 'Danh sách đơn hàng', data: $data);
        Footer::render();
    }

    public static function historyOrderStatus()
    {
        $OrderStatus = isset($_POST['status']) ? $_POST['status'] : 'all';
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        $OrderStatus = intval($OrderStatus);
        $userId = intval($userId);
        $order = new Order();
        if ($OrderStatus === 10) {
            $data = $order->getAllOderByUser($userId);
            // var_dump($data);
            // die;
        } else {
            $data = $order->getAllOrderUserByStatus($userId, $OrderStatus);
        }

        if (count($data)):
            ?>
            <?php
            foreach ($data as $item):
                $address = $item['address'] . " " . $item['ward'] . " " . $item['district'] . " " . $item['province'];
                ?>
                <tr>
                    <td><span>#<?= $item['id'] ?></span></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['email'] ?></td>
                    <td><?= $item['date'] ?></td>
                    <td>
                        <?= number_format($item['total'], 0, ',', '.') ?> VND
                    </td>
                    <td>
                        <?php
                        if ($item['paymentMethod'] == 'PAYMENT') {
                            if ($item['orderStatus'] == 1) {
                                echo 'Chuyển khoản ngân hàng (Đã thanh toán)';
                            } else {
                                echo 'Chuyển khoản ngân hàng ';
                            }
                        } else if ($item['paymentMethod'] == 'VNPAY') {
                            echo 'Thanh toán VNPAY (Đã thanh toán)';
                        } else {
                            echo 'Thanh toán khi nhận hàng';
                        }
                        ?>
                    </td>
                    <td> <?= $address ?> </td>
                    <td>
                        <a href="/admin/orders/detail/<?= $item['id'] ?>" class="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);">
                                <path
                                    d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z">
                                </path>
                                <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path>
                            </svg> Chi tiết đơn hàng
                        </a>
                    </td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <h5 class="text-center text-danger m-2">Không có dữ liệu</h5>
            <?php
        endif;



    }
}