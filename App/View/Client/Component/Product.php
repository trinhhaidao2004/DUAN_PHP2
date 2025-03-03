<?php
namespace App\View\Client\Component;

use App\View\View;

class Product extends View
{
    public static function render($data = [])
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?>

        <?php
        if (count($data)):
            ?>
            <?php
            foreach ($data as $item):
                if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/'):
                    ?>
                    <div class="col-sm-3">
                        <?php
                else:
                    ?>
                        <div class="col-sm-4">
                            <?php
                endif;
                ?>
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="<?= APP_URL ?>/public/Client/assets/images/home/<?= $item['image'] ?>" alt="" />
                                    <?php
                                    if ($item['discount_price'] > 0):
                                        ?>
                                        <h5><del><?= number_format($item['price'], 0, ',', '.') ?> VND</del>
                                            <?= number_format($item['discount_price'], 0, ',', '.') ?> VND</h5>

                                        <?php
                                    else:
                                        ?>
                                        <h5><?= number_format($item['price'], 0, ',', '.') ?> VND</h5>
                                    <?php endif; ?>
                                    <p class="small-description"><?= $item['name'] ?></p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                                        hàng</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <?php
                                        if ($item['discount_price'] > 0):
                                            ?>
                                            <h5><del><?= number_format($item['price'], 0, ',', '.') ?> VND</del>
                                                <?= number_format($item['discount_price'], 0, ',', '.') ?> VND</h5>

                                            <?php
                                        else:
                                            ?>
                                            <h5><?= number_format($item['price'], 0, ',', '.') ?> VND</h5>
                                        <?php endif; ?>
                                        <p class="small-description "><?= $item['name'] ?></p>
                                        <a href="/products/details/<?= $item['id'] ?>" class="btn btn-default add-to-cart">Chi tiết sản
                                            phẩm</a>
                                        <form action="/cart/add" method="post">
                                            <input type="hidden" name="method" id="" value="POST">
                                            <input type="hidden" name="id" id="" value="<?= $item['id'] ?>" required>
                                            <button type="submit" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Thêm vào
                                                giỏ hàng</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
            endforeach;
        else:
            ?>
                <h5 class="text-center text-danger mt-2">Không có dữ liệu</h5>
                <?php
        endif;
        ?>
            <br />
            <?php
    }
}