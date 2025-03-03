<?php

namespace App\View\Client\Order;

use App\Controllers\Client\CartController;
use App\Helpers\CartHelper;
use App\View\View;
use App\Views\Client\Components\NavbarAccount;

class payment extends View
{
    public static function render($data = [])
    {
        $date = date('Y-m-d');
        $cart_data = CartController::getorder();
        $total = CartHelper::total($cart_data);
        ?>
        <div class="container ">
            <h3 class="text-center m-2">Thông tin đơn hàng</h3>
            <h4 class="text-center m-2 text-danger">Cảm ơn bạn đã đặt hàng tại Book Store .Vui lòng kiểm tra đơn hàng trước
                khi thanh toán</h4>
            <div class="d_flex">
                <div class="d_flex item_pay">
                    <div class="">Mã đơn hàng : </div>
                    <div class=" "><?= $_SESSION['order_id'] ?></div>
                </div>
                <div class="d_flex item_pay">
                    <div class=" pl-2">Ngày đặt :</div>
                    <div class=""><?= $date ?>  </div>
                </div>
                <div class="d_flex item_pay">
                    <div class="">Tổng tiền :  </div>
                    <div class=""><?=  number_format($total['total'], 0, ',', '.')  ?> VND</div>
                </div>
                <div class="d_flex item_pay">
                    <div class="">Phương thức thanh toán chuyển khoản : Chuyển khoản ngân hàng</div>
                    <div class=""></div>
                </div>
            </div>
            <h2 class="text-center mt-4">Mã QR chuyển khoản ngân hàng</h2>
            <div class="d-flex justify-content-center">
                <h4>Thời gian còn lại</h4> 
            <h4 id="countdown" class="mx-2"></h4>
            </div>
            <div class="text-center my-3">
            <img class="my-3" src='https://api.vietqr.io/image/<?= $data[0]['bank_code'] ?>-<?= $data[0]['account_number'] ?>-lqu0fMx.jpg?accountName=<?= $data[0]['account_name'] ?>&amount=<?= $total['total'] ?>&addInfo=<?= urlencode('Thanh toán đơn hàng ') . $_SESSION['order_id'] ?>'
            alt='QR Code' width='45%' />
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Thời gian đếm ngược (ví dụ: 5 phút từ thời điểm hiện tại)
            let countdownTime = 60;  // 5 phút (300 giây)

            function updateCountdown() {
                let minutes = Math.floor(countdownTime / 60);
                let seconds = countdownTime % 60;
                // Hiển thị thời gian còn lại
                document.getElementById("countdown").innerHTML = `${minutes} phút ${seconds} giây`;
                if (countdownTime <= 0) {
                    clearInterval(countdownInterval);  // Dừng đếm ngược khi hết thời gian
                    sendPostRequest();  // Gọi hàm PHP khi hết thời gian
                } else {
                    countdownTime--;
                }
            }
            let countdownInterval = setInterval(updateCountdown, 1000);
            function sendPostRequest() {
                $.ajax({
                    url: '/cancel',
                    method: 'POST',
                    data: {
                        action: 'cancel',
                        method: "POST",
                    },
                    success: function (response) {
                        // alert('Hết thời gian! PHP đã xử lý yêu cầu.');
                        window.location.href = '/';
                    },
                    error: function (error) {
                        alert('Đã có lỗi xảy ra.');
                    }
                });
            }
        </script>
        <?php
    }
}