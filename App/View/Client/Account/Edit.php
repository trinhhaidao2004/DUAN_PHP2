<?php
namespace App\View\Client\Account;

use App\View\Client\Component\Form;
use App\View\Client\Component\NavbarAccount;
use App\View\View;


class Edit extends View
{
    public static function render($data = [])
    {
        // var_dump($data);
        // var_dump($_SESSION['user']);
        // $avatar = $_SESSION['user']['avatar'] ?? $_COOKIE['user']['avatar']?? '';
        ?>
        <section id="form">
            <div class="container">
                <div class="category-tab ">
                    <!--category-tab-->
                    <div class="col-sm-12">

                        <?php

                        NavbarAccount::render() ?>
                    </div>
                </div>
                <div class="col-sm-3">

                </div>
                <div class="col-sm-6">
                    <div class="signup-form ">
                        <div class="text-center">
                            <?php if ($_SESSION['user']['google_id']): ?>
                                <img src="<?= $_SESSION['user']['avatar'] ?? 'user.png' ?>" alt="" class="or ">
                            <?php else: ?>
                                <img src="/public/Client/assets/images/home/<?= $_SESSION['user']['avatar'] ?? 'user.png' ?>" alt=""
                                    class="or ">
                            <?php endif; ?>
                            <h2>Cập nhật tài khoản</h2>
                        </div>

                        <form action="/account/update/<?= $_SESSION['user']['id'] ?>" method="post"
                            enctype="multipart/form-data">
                            <?php
                            Form::input(name: 'email', label: 'Email', type: 'email', class: 'form-control item_readonly', value: $_SESSION['user']['email'], readonly: 'readonly');
                            Form::input(name: 'name', label: 'Họ và tên', value: $_SESSION['user']['name'], placeholder: 'Vui lòng nhập họ và tên');
                            Form::input(name: 'avatar', label: 'Hình ảnh', type: 'file', value: $_SESSION['user']['avatar']);
                            Form::input('phone', label: 'Số điện thoại', class: '', value: $_SESSION['user']['phone'], placeholder: 'Vui lòng nhập số điện thoại');
                            Form::button(value: 'Cập nhật', class: 'btn btn-default');
                            ?>

                        </form>
                    </div><!--/sign up form-->




                </div>
            </div>
        </section><!--/form-->
        <?php
    }
}



