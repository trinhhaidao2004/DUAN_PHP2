<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Models\Order;
use App\Models\Product;
use App\View\Client\Component\Product as ComponentProduct;
class ComponentController
{
    public static function selectProductByCategory()
    {
        $id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
        $id_int = intval($id);
        $product = new Product();
        if ($id_int == 0) {
            $data = $product->getAllProduct(6);
        } else {
            $data = $product->selectProductByCategory($id_int);
        }
        ComponentProduct::render($data['products']);
    }
    public static function selectProductByAge()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $id_int = intval($id);
        $product = new Product();
        if ($id_int == 0) {
            $data = $product->getAllByAge('age', '=', 0);
        } else if ($id_int == 1) {
            $data = $product->getAllByAge('age', '=', 1);
        } else {
            $data = $product->getAllByAge('age', '=', 2);
        }
        ComponentProduct::render($data);
    }
    public static function selectOrderByStatus()
    {
        $is_login = AuthHelper::checkLogin();
        if ($is_login) {
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $id_int = intval($id);
            $order = new Order();
            if ($id_int == 0) {
                $data = $order->getAllorderByStatus('orderStatus', '=', $id_int);
            } else if ($id_int == 1) {
                $data = $order->getAllorderByStatus('orderStatus', '=', $id_int);
            } else if ($id_int == 2) {
                $data = $order->getAllorderByStatus('orderStatus', '=', $id_int);
            } else if ($id_int == 3) {
                $data = $order->getAllorderByStatus('orderStatus', '=', $id_int);
            } else if ($id_int == 4) {
                $data = $order->getAllorderByStatus('orderStatus', '=', $id_int);
            } else if ($id_int == 5) {
                $data = $order->getAllorderByStatus('orderStatus', '=', $id_int);
            } else if ($id_int == 6) {
                $data = $order->getAllorderByStatus('orderStatus', '=', $id_int);
            } else {
                $data = $order->getAllorder();
            }
            if (count($data)):
                ?>
                <?php
                foreach ($data as $item):
                    ?>
                    <tr>
                        <td class="cart_product">
                            #<?= $item['id'] ?>
                        </td>
                        <td class="name_product">
                            <?= $item['date'] ?>
                        </td>
                        <td class="name_product">
                            <?php
                            if ($item['paymentMethod'] == 'PAYMENT') {
                                if ($item['orderStatus'] == 2 || $item['orderStatus'] == 1) {
                                    echo 'Chuyển khoản ngân hàng (Đã thanh toán)';
                                } else {
                                    echo 'Chuyển khoản ngân hàng (Chưa thanh toán)';
                                }
                            } else if ($item['paymentMethod'] == 'VNPAY') {
                                if ($item['orderStatus'] == 2 || $item['orderStatus'] == 1) {
                                    echo 'Thanh toán VNPAY (Đã thanh toán)';
                                } else {
                                    echo 'Thanh toán VNPAY (Đã hoàn tiền)';
                                }
                            } else {
                                echo 'Thanh toán khi nhận hàng';
                            }
                            ?>
                        </td>
                        <td class="name_product">
                            <?= number_format($item['total'], 0, ',', '.') ?>
                            VND
                        </td>
                        <td class="name_product">
                            <?php
                            if ($item['orderStatus'] == 0) {
                                echo 'Đã hủy';
                            } else if ($item['orderStatus'] == 1) {
                                echo 'Chờ xử lí';
                            } else if ($item['orderStatus'] == 2) {
                                echo 'Đã xác nhận';
                            } else if ($item['orderStatus'] == 3) {
                                echo 'Đang chuẩn bị';
                            } else if ($item['orderStatus'] == 4) {
                                echo 'Đang giao hàng';
                            } else if ($item['orderStatus'] == 5) {
                                echo 'Giao thành công';
                            } else if ($item['orderStatus'] == 6) {
                                echo 'Chờ thanh toán';
                            }
                            ?>
                        </td>
                        <td class="name_product">
                            <a href="/trashcan/order/detail/<?= $item['id'] ?>" class="btn btn-primary" data-id="2">Xem chi tiết</a>
                            <?php if (($item['paymentMethod'] == 'COD' && $item['orderStatus'] == 1) || ($item['paymentMethod'] == 'VNPAY' && $item['orderStatus'] == 1) || ($item['paymentMethod'] == 'PAYMENT' && $item['orderStatus'] == 1)): ?>
                                <a href="/cancel/order/<?= $item['id'] ?>" class="btn btn-primary" data-id="2">Hủy đơn</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else:
                ?>
                <h5 class="text-center text-danger m-2">Không có dữ liệu</h5>
                <?php
            endif;
        } else {
            header('Location: /account');
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin tài khoản');
            exit();
        }
    }
}