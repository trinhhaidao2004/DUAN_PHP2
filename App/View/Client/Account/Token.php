<?php
namespace App\View\Client\Account;

use App\View\Client\Component\Form;
use App\View\Client\Component\NavbarAccount;
use App\View\View;


class Token extends View
{
    public static function render($data = [])
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Home | E-Shopper</title>
            <link href="<?= APP_URL ?>/public/Client/assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="<?= APP_URL ?>/public/Client/assets/css/font-awesome.min.css" rel="stylesheet">
            <link href="<?= APP_URL ?>/public/Client/assets/css/prettyPhoto.css" rel="stylesheet">
            <link href="<?= APP_URL ?>/public/Client/assets/css/price-range.css" rel="stylesheet">
            <link href="<?= APP_URL ?>/public/Client/assets/css/animate.css" rel="stylesheet">
            <link href="<?= APP_URL ?>/public/Client/assets/css/main.css" rel="stylesheet">
            <link href="<?= APP_URL ?>/public/Client/assets/css/responsive.css" rel="stylesheet">

            <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
            <link rel="shortcut icon" href="images/ico/favicon.ico">
            <link rel="apple-touch-icon-precomposed" sizes="144x144"
                href="public/Client/assets/images/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114"
                href="public/Client/assets/images/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72"
                href="public/Client/assets/images/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="public/Client/assets/images/ico/apple-touch-icon-57-precomposed.png">
        </head><!--/head-->

        <body>
        <section id="form">
            <div class="container">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="signup-form ">
                        <div class="text-center">
                            <h2>Nhập mã xác thực</h2>
                        </div>
                        <form action="/account/token/password" method="post"
                            enctype="multipart/form-data">
                            <?php
                            Form::input('token', 'Mã xác thực', class: '', placeholder: 'Vui lòng nhập mã xác thực');
                            ?>
                            <?php Form::button(value: 'Gửi', class: 'btn btn-default');
                            ?>

                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </section><!--/form-->
        </body>

        </html>
        <?php
    }
}



