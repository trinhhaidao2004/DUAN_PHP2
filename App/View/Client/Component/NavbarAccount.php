<?php
namespace App\View\Client\Component;

use App\View\View;

class NavbarAccount extends View
{
    public static function render($data = [],$orderId = null)
    {

        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);
        $userId = $_SESSION['user']['id'] ?? '';
        // var_dump($path);
        ?>
        <h2 class="text-center title">Thông tin tài khoản</h2>
        <div class="row">
            <div class="col-sm-7">
                <ul class="nav nav-tabs">
                    <li class="<?= ($path === "/account/edit/$userId") ? 'active' : '' ?>">

                        <a href="/account/edit/<?= $userId ?>" class="">
                            Thông tin tài khoản
                        </a>
                    </li>
                    <li class="<?= ($path === "/account/password/$userId") ? 'active' : '' ?>"><a
                            href="/account/password/<?= $userId ?>">Đổi mật khẩu</a></li>
                    <li class="<?= ($path === "/account/trashcan/$userId") || ($path === "/trashcan/order/detail/$orderId") ? 'active' : '' ?>"><a
                            href="/account/trashcan/<?= $userId ?>">Lịch sử mua hàng</a>
                    </li>
                    <li class=""><a href="/logout">Đăng xuất</a></li>
                </ul>
            </div>


        </div>

        <?php
    }
}