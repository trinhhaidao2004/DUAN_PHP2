<?php

namespace App\View\Client\Order;

use App\Controllers\Client\CartController;
use App\Helpers\CartHelper;
use App\Models\Bank;
use App\Models\VietQRModel;
use App\View\Client\Component\Navbar_account;
use App\View\Client\Component\NavbarAccount;
use App\View\View;


class Detail extends View
{
    public static function render($data = [], $orderId = null)
    {
        if (count($data)) {
            $address = $data[0]['address'] . " " . $data[0]['ward'] . " " . $data[0]['district'] . " " . $data[0]['province'];
        }
        ?>
        <section id="cart_items" class="">
            <div class="container ">
                <div class="category-tab d-flex justify-content-center">
                    <div class="col-sm-12 ">
                        <?php NavbarAccount::render(orderId: $orderId) ?>
                    </div>
                </div>
                <div class="container">
                    <?php
                    if (count($data) && $data[0]['orderStatus'] == 6) {
                        $banks = new Bank();
                        $result = $banks->getAllClientBank();
                        if ($result) {
                            ?>
                            <div class="item-img-flex">
                                <div class="step-one">
                                    <h2 class="heading titie-order">Mã QR THANH TOÁN</h2>
                                </div>
                                <img width="30%"
                                    src="https://api.vietqr.io/image/<?= $result[0]['bank_code'] ?>-<?= $result[0]['account_number'] ?>-lqu0fMx.jpg?accountName=<?= $result[0]['account_name'] ?>&amount=<?= $data[0]['total'] ?>&addInfo=<?= urlencode('Thanh toán đơn hàng ') . $data[0]['order_id'] ?>"
                                    alt="">
                            </div>
                            <?php
                        } else {
                            echo "Lỗi: Không tạo được mã QR.";
                        }
                        ?>

                        <?php
                    } ?>


                    <div class="order-detail">
                        <div class="col-sm-4 margin-order">
                            <div class="item-order">
                                <div class="step-one">
                                    <h2 class="heading titie-order">Đơn hàng</h2>
                                </div>
                                <div class="checkout-options">
                                    <p class="p_detail">Mã đơn hàng : #<?= $data[0]['order_id'] ?> </p>
                                    <p class="p_detail">Trạng thái : <?php

                                    if ($data[0]['orderStatus'] == 0) {
                                        echo 'Đã hủy';
                                    } else if ($data[0]['orderStatus'] == 1) {
                                        echo 'Chờ xử lí';
                                    } else if ($data[0]['orderStatus'] == 2) {
                                        echo 'Đã xác nhận';
                                    } else if ($data[0]['orderStatus'] == 3) {
                                        echo 'Đang chuẩn bị';
                                    } else if ($data[0]['orderStatus'] == 4) {
                                        echo 'Đang giao hàng';
                                    } else if ($data[0]['orderStatus'] == 5) {
                                        echo 'Giao thành công';
                                    } else if ($data[0]['orderStatus'] == 6) {
                                        echo 'Chờ thanh toán';
                                    }
                                    ?></p>
                                    <p class="p_detail">Tổng cộng : <?= number_format($data[0]['total'], 0, ',', '.') ?> VND
                                    </p>
                                </div><!--/checkout-options-->
                            </div>
                        </div>
                        <div class="col-sm-4 margin-order">
                            <div class="item-order">
                                <div class="step-one">
                                    <h2 class="heading titie-order">Khách hàng</h2>
                                </div>
                                <div class="checkout-options">
                                    <p class="p_detail">Họ và tên : <?= $_SESSION['user']['name'] ?></p>
                                    <p class="p_detail">Số điện thoại : <?= $_SESSION['user']['phone'] ?></p>
                                    <p class="p_detail">Email : <?= $_SESSION['user']['email'] ?></p>
                                </div><!--/checkout-options-->
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="item-order">
                                <div class="step-one">
                                    <h2 class="heading titie-order">Người nhận</h2>
                                </div>
                                <div class="checkout-options">
                                    <p class="p_detail">Họ và tên : <?= $data[0]['name'] ?? '' ?>. Ngày mua :
                                        <?= $data[0]['date'] ?? '' ?>
                                    </p>
                                    <p class="p_detail">Số điện thoại : <?= $data[0]['phone'] ?? '' ?></p>
                                    <p class="p_detail">Địa chỉ : <?= $address ?? '' ?>
                                    </p>

                                </div><!--/checkout-options-->
                            </div>

                        </div>
                    </div>
                </div>
                <h2 class="text-center title">Danh sách sản phẩm</h2>
            </div>

            <div class="container">

                <div class="table-responsive cart_info cart_order">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image_product">Hình ảnh</td>
                                <td class="description">Tên sản phẩm</td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($data)):
                                foreach ($data as $item):
                                    ?>
                                    <tr>
                                        <td class="">
                                            <a href=""><img
                                                    src="<?= APP_URL ?> /public/Client/assets/images/home/<?= $item['image'] ?? '' ?>"
                                                    alt="" width="50%"></a>
                                        </td>
                                        <td class="cart_description">
                                            <h5 class="truncate"><a href="/products/details/"><?= $item['name'] ?? '' ?></a></h5>
                                            <p>ID sản phẩm: <?= $item['product_id'] ?? '' ?></p>
                                        </td>
                                        <td class="cart_price">
                                            <?php
                                            if ($item['originalPrice'] > 0):
                                                ?>
                                                <p><del class="text-danger"><?= number_format($item['originalPrice'], 0, ',', '.') ?>
                                                        VND</del>
                                                    <?= number_format($item['unitPrice'], 0, ',', '.') ?> VND</p>
                                                <?php
                                            else:
                                                ?>
                                                <p>
                                                    <?= number_format($item['unitPrice'], 0, ',', '.') ?> VND
                                                </p>

                                                <?php
                                            endif;
                                            ?>

                                        </td>
                                        <td class="cart_quantity">
                                            <?= $item['quantity'] ?>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price"> <?= number_format($item['totalPrice'], 0, ',', '.') ?> VND</p>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>

                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tr>
                                                <td>
                                                    <h4> Tổng :</h4>
                                                </td>
                                                <td>
                                                    <h4> <?= number_format($item['total'], 0, ',', '.') ?> VND</h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <?php else: ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($item['orderStatus'] == 1): ?>
                    <div class="update_order">
                        <a href="/cancel/order/<?= $data[0]['order_id'] ?>" class=" btn btn-primary">Hủy đơn</a>
                    </div>
                <?php endif; ?>
            </div>
        </section><!--/form-->


        <?php
    }
}