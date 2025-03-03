<?php
namespace App\View\Client\Component;

use App\View\View;

class Navbar_product extends View
{
    public static function render($data = [])
    {
    //    var_dump($data['categories'][0]['name']);
    //    die;
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $firstItem = reset($data);
        ?>
        <div class="category-tab"> <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tshirt" class="category-filter" data-id="0" data-toggle="tab">Tất cả</a></li>
                    <?php if (count($data['categories'])):
                        foreach ($data['categories'] as $item): ?>
                            <li class="<?= $item === $firstItem ? 'active' : '' ?> "><a href="#tshirt" class="category-filter"
                                    data-id="<?= $item['id'] ?>" data-toggle="tab"><?= $item['name'] ?></a></li>
                            <?php
                        endforeach;
                    else: ?>
                        <h5 class="text-center text-danger mt-2">Không có dữ liệu</h5>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="product-list">
                    <!-- Lấy tất cả sp bằng ajax ròi  -->
                </div>
            </div>
        </div>
        <?php
    }
}