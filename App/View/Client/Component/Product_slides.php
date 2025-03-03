<?php
namespace App\View\Client\Component;

use App\View\View;

class Product_slides extends View
{
    public static function render($data = [])
    {
        ?>
        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Sản phẩm giảm giá</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?= APP_URL ?>/public/Client/assets/images/home/hinh-anh-sach.jpg" alt="" />
                                        <h2><del>56 VND</del> 52 VND</h2>

                                        <p>Thánh Thạch Rave - Tập 2 - Tặng Kèm Bookmark Plue</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                            giỏ hàng</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="item">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="public/Client/assets/images/home/hinh-anh-sach.jpg" alt="" />
                                        <h2><del>56 VND</del> 52 VND</h2>

                                        <p>Thánh Thạch Rave - Tập 2 - Tặng Kèm Bookmark Plue</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                            giỏ hàng</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->
        <?php

    }
}