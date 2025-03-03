<?php
namespace App\View\Client\Component;

use App\View\View;

class Category extends View
{
    public static function render($data = [])
    {
        // var_dump($data);
        ?>

        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Danh mục sản phẩm</h2>
                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="/products" class="category-product" data-id="0">
                                    <span class="badge pull-right"></span>
                                    Tất cả
                                </a>
                            </h4>
                        </div>
                        <?php if (count($data)):
                            foreach ($data as $item): ?>
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#" class="category-product" data-id="<?= $item['id'] ?>">
                                            <span class="badge pull-right"></span>
                                            <?= $item['name'] ?>
                                        </a>
                                    </h4>
                                </div>
                            <?php endforeach;
                        else: ?>
                            <h5 class="text-center text-danger mt-2">Không có dữ liệu</h5>
                        <?php endif; ?>
                    </div>
                </div><!--/category-products-->
                <div class="brands_products"><!--brands_products-->
                    <h2>Theo độ tuổi</h2>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#" data-id="0" class="category-age-product"> Từ 3 -> 12 tuổi.</a></li>
                            <li><a href="#" data-id="1" class="category-age-product"> Từ 12 -> 18 tuổi</a></li>
                            <li><a href="#" data-id="2" class="category-age-product">Từ 18 tuổi trở lên </a></li>
                        </ul>
                    </div>
                </div><!--/brands_products-->
            </div>
        </div>
      


        <?php


    }
}