<?php
namespace App\View\Client\Account;

use App\View\Client\Component\Form;
use App\View\Client\Component\NavbarAccount;
use App\View\View;
use App\View\Client\Component\Table;

class TrashCan extends View
{
    public static function render($data = [])
    {
        // var_dump($data);
        // var_dump($_COOKIE['user']);
        // $avatar = $_SESSION['user']['avatar'] ?? $_COOKIE['user']['avatar']?? '';
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);
        $userId = $_SESSION['user']['id'] ?? '';
        ?>
        <section id="form">
            <div class="container ">
                <div class="category-tab d-flex justify-content-center">
                    <!--category-tab-->
                    <div class="col-sm-12 ">
                        <?php NavbarAccount::render() ?>
                    </div>


                </div>

                <div class="">
                    <div class="category-tab">
                        <!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs select_trashcan">
                                <li class="active">
                                    <a href="#tshirt" data-toggle="tab" class="account-trash-filter" data-id="9">Tất cả</a>
                                </li>
                                <li><a href="#blazers" data-toggle="tab" class="account-trash-filter" data-id="1">Chờ xử lí</a>
                                </li>
                                <li><a href="#sunglass" data-toggle="tab" class="account-trash-filter" data-id="2">Đã xác
                                        nhận</a></li>
                                <li><a href="#kids" data-toggle="tab" class="account-trash-filter" data-id="3">Đang chuẩn bị</a>
                                </li>
                                <li><a href="#poloshirt" data-toggle="tab" class="account-trash-filter" data-id="4">Đang giao
                                        hàng</a></li>
                                <li><a href="#poloshirt" data-toggle="tab" class="account-trash-filter" data-id="5">Giao thành
                                        công</a></li>
                                <li><a href="#poloshirt" data-toggle="tab" class="account-trash-filter" data-id="6">Chờ thanh
                                        toán</a></li>
                                <li><a href="#poloshirt" data-toggle="tab" class="account-trash-filter" data-id="0">Đã hủy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <section id="cart_items">
                    <div class="container">
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed my-3">
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Mã đơn hàng</td>
                                        <td class="description">Ngày đặt</td>
                                        <td class="price">Phương thức thanh toán</td>
                                        <td class="quantity">Tổng tiền thanh toán</td>
                                        <td class="quantity">Trạng thái</td>
                                        <td class="total"></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="order-list">
                                   
                                </tbody>
                            </table>

                        </div>
                    </div>
                </section> <!--/#cart_items-->





            </div>
        </section><!--/form-->
        <?php
    }
}



