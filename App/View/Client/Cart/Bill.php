<?php

namespace App\View\Client\Cart;

use App\Controllers\Client\CartController;
use App\Helpers\AuthHelper;
use App\Helpers\CartHelper;
use App\View\View;


class Bill extends View
{
    public static function render($data = null)
    {


        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>

        <body>
            <?php if ($_SESSION['information']['PaymentMethod'] === 'VNPAY'):
                $total = number_format($_GET['vnp_Amount'] / 100);
                $date = date('Y-m-d H:i:s');
                ?>
                <div class="container w-50 my-5">
                    <div class="">
                        <div class=" p-2 text-center">
                            <img src="/public/Client/assets/images/home/image.png" alt="" width="10%">
                            <h5 class="text-primary">Giao dịch thành công</h5>
                        </div>
                        <div class=" p-2 text-center">
                            <h5 class="text-center m-2 text-danger">Cảm ơn bạn đã đặt hàng tại Book Store .</h5>
                        </div>
                        <div class="container">
                            <div class="d-flex justify-content-between py-3 item_dflex">
                                <div class="item">Số điện thoại</div>
                                <div class="item"><?= $_SESSION['information']['phone'] ?></div>
                            </div>
                            <div class="d-flex justify-content-between py-3 item_dflex">
                                <div class="item">Thời gian thanh toán</div>
                                <div class="item"><?= $date ?></div>
                            </div>
                            <div class="d-flex justify-content-between py-3 item_dflex">
                                <div class="item">Phương thức thanh toán</div>
                                <div class="item"><?= $_SESSION['information']['PaymentMethod'] ?></div>
                            </div>
                            <div class="d-flex justify-content-between py-3 item_dflex">
                                <div class="item">Số tiền thanh toán</div>
                                <div class="item text-danger"><?= $total ?> VND</div>
                            </div>
                            <div class="d-flex justify-content-center py-3">
                                <a href="/" id="complete_header" class="btn btn-primary">Thực hiện giao dịch khác</a>
                            </div>
                        </div>
                    </div>

                </div>
            <?php else:
                $cart_data = CartController::getorder();
                // var_dump($cart_data);
                // die;
                $totalBlance = CartHelper::total($cart_data);
                $date = date('Y-m-d H:i:s');
                ?>
                <div class="container w-50 my-5">
                    <div class="">
                        <div class=" p-2 text-center">
                            <img src="/public/Client/assets/images/home/image.png" alt="" width="10%">
                            <h5 class="text-primary">Đặt hàng thành công</h5>
                        </div>
                        <div class=" p-2 text-center">
                            <h5 class="text-center m-2 text-danger">Cảm ơn bạn đã đặt hàng tại Book Store .</h5>
                        </div>
                        <div class="container">
                            <div class="d-flex justify-content-between py-3 item_dflex">
                                <div class="item">Số điện thoại</div>
                                <div class="item"><?= $_SESSION['information']['phone'] ?></div>
                            </div>
                            <div class="d-flex justify-content-between py-3 item_dflex">
                                <div class="item">Thời gian thanh toán</div>
                                <div class="item"><?= $date ?></div>
                            </div>
                            <div class="d-flex justify-content-between py-3 item_dflex">
                                <div class="item">Phương thức thanh toán</div>
                                <div class="item">
                                    <?php
                                    if ($_SESSION['information']['PaymentMethod'] === 'COD'):
                                        ?>
                                        Thanh toán khi nhận hàng
                                        <?php
                                    else:
                                        ?>
                                        Thanh toán bằng ví
                                        <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-3 item_dflex">
                                <div class="item">Số tiền thanh toán</div>
                                <div class="item text-danger"> <?= number_format($totalBlance['total'], 0, ',', '.') ?> VND</div>
                            </div>
                            <div class="d-flex justify-content-center py-3">
                                <a href="/" id="complete_header" class="btn btn-primary">Thực hiện giao dịch khác</a>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
            <?php setcookie('cart', '', time() - (3600 * 24 * 30 * 12), '/'); ?>
        </body>

        </html>
        <?php

    }
}