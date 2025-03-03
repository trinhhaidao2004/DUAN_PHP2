<?php
namespace App\View\Client\Page;
use App\View\View;
class NotFound extends View
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
            <link href="public/Client/assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="public/Client/assets/css/font-awesome.min.css" rel="stylesheet">
            <link href="public/Client/assets/css/prettyPhoto.css" rel="stylesheet">
            <link href="public/Client/assets/css/price-range.css" rel="stylesheet">
            <link href="public/Client/assets/css/animate.css" rel="stylesheet">
            <link href="public/Client/assets/css/main.css" rel="stylesheet">
            <link href="public/Client/assets/css/responsive.css" rel="stylesheet">
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
            <div class="container text-center">
                <div class="logo-404">
                    <a href="index.html"><img src="public/Client/assets/images/home/logo.png" alt="" /></a>
                </div>
                <div class="content-404">
                    <img src="public/Client/assets/images/404/404.png" class="img-responsive" alt="" />
                    <h1><b>RẤT TIẾC!</b> Chúng tôi không thể tìm thấy trang này</h1>
                    <p>Ừm... Có vẻ như bạn đã làm điều gì đó sai. Trang mà bạn đang tìm kiếm đã biến mất.</p>
                    <h2><a href="/">Đưa tôi về Trang chủ</a></h2>

                </div>
            </div>
            <script src="public/Client/assets/js/jquery.js"></script>
            <script src="public/Client/assets/js/price-range.js"></script>
            <script src="js/jquery.scrollUp.min.js"></script>
            <script src="public/Client/assets/js/bootstrap.min.js"></script>
            <script src="public/Client/assets/js/jquery.prettyPhoto.js"></script>
            <script src="public/Client/assets/js/main.js"></script>
        </body>

        </html>

    <?php }
}