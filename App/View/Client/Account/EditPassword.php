<?php
namespace App\View\Client\Account;

use App\Helpers\AuthHelper;
use App\View\Client\Component\Form;
use App\View\Client\Component\NavbarAccount;
use App\View\View;


class EditPassword extends View
{
    public static function render($data = [])
    {
        $is_login = AuthHelper::checkLogin();
        if ($is_login) {
           $user_id =  $_SESSION['user']['id'] ;
        }else{
            $user_id = $data['id'];
        }
        ?>
        <section id="form">
            <div class="container">
                <div class="category-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <?php
                         $is_login = AuthHelper::checkLogin();
                         if($is_login){
                            NavbarAccount::render();
                         }
                        ?>
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
                        <form action="/account/update/password/<?=$user_id?>" method="post"
                            enctype="multipart/form-data">
                            <?php
                            Form::input('password', 'Mật khẩu', 'password', class: '', placeholder: 'Vui lòng nhập mật khẩu');
                            Form::input('re_password', 'Nhập lai mật khẩu', 'password', class: '', placeholder: 'Vui lòng nhập lại mật khẩu');
                            ?>
                            <p class="my-5"><a href="/forgetpass" class="mr-2">Quên mật khẩu ?</a> </p>
                            <?php Form::button(value: 'Cập nhật', class: 'btn btn-default');
                            ?>

                        </form>
                    </div><!--/sign up form-->




                </div>
            </div>
        </section><!--/form-->
        <?php
    }
}



