<?php
namespace App\View\Client\Layout;

use App\Controllers\Client\PaymentController;
use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\View\View;

class Header extends View
{


    public static function render($data = [])
    {
        if(isset($_SESSION['information']['PaymentMethod']) && $_SESSION['information']['PaymentMethod'] === 'PAYMENT'){
			PaymentController::updateOrder();
			NotificationHelper::unsetorder();
		}
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);

        $is_login = AuthHelper::checkLogin();
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
            <header id="header"><!--header-->
                <div class="header_top"><!--header_top-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="contactinfo">
                                    <ul class="nav nav-pills">
                                        <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                        <li><a href="#"><i class="fa fa-envelope"></i> bookstore@gmail.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="social-icons pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header_top-->

                <div class="header-middle"><!--header-middle-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="logo pull-left">
                                    <a href="/"><img src="<?= APP_URL ?>/public/Client/assets/images/home/logo 1.png" alt=""
                                            width="100%" /></a>
                                </div>

                            </div>
                            <div class="col-sm-8">
                                <div class="shop-menu pull-right">
                                    <ul class="nav navbar-nav">
                                        <?php
                                        if ($is_login):
                                            ?>
                                            <li>
                                                <?php $userId = $_SESSION['user']['id'] ?? ''; ?>
                                                <a href="/account/edit/<?= $userId ?>"
                                                    class="<?= ($path === "/account/edit/$userId") ? 'active' : '' ?>">
                                                    <i class="fa fa-user"></i>
                                                    <?= $_SESSION['user']['name'] ?? $_COOKIE['user']['name'] ?>
                                                </a>
                                            </li>
                                            <?php
                                        else:
                                            ?>
                                            <li><a href="/account" class="<?= ($path === '/account') ? 'active' : '' ?>"><i
                                                        class="fa fa-lock"></i> Đăng nhập</a></li>
                                            <?php
                                        endif;
                                        ?>
                                        <li><a href="/cart" class="<?= ($path === '/cart') ? 'active' : '' ?>"><i
                                                    class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header-middle-->

                <div class="header-bottom"><!--header-bottom-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                                        data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="mainmenu pull-left">
                                    <ul class="nav navbar-nav collapse navbar-collapse">
                                        <li><a href="/" class="<?= ($path === '/') ? 'active' : '' ?>">Trang chủ</a></li>
                                        <li class="dropdown"><a href="/products"
                                                class="<?= ($path === '/products') ? 'active' : '' ?>">Sản phẩm</a>

                                        </li>
                                        <!-- <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                            <ul role="menu" class="sub-menu">
                                                <li><a href="shop.html">Products</a></li>
                                                <li><a href="product-details.html">Product Details</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="cart.html">Cart</a></li>
                                                <li><a href="login.html">Login</a></li>
                                            </ul>
                                        </li> -->
                                        <li class="dropdown"><a href="/posts"
                                                class="<?= ($path === '/posts') ? 'active' : '' ?>">Bài viết</a>
                                        </li>
                                        <!-- <li><a href="404.html">404</a></li> -->
                                        <li><a href="/contact" class="<?= ($path === '/contact') ? 'active' : '' ?>">Liên hệ</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <form action="/" method="GET" class="search_box pull-right">
                                    <input type="text" name="query" id="search-input" placeholder="Tìm kiếm" />
                                    <button type="submit" id="search-button" style="display: none;">Search</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div><!--/header-bottom-->
            </header><!--/header-->

            <?php

    }
}
