<?php
namespace App\View\Client\Component;

use App\View\View;

class Table extends View
{
    public static function render($data = [])
    {
        // var_dump($data['data']);
        $total_price = 0;
        $i = 0;
        if (count($data)):
            foreach ($data as $cart):
                $i++;
                if ($cart['data']):
                    // var_dump($item['data']);
                    ?>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/one.png" alt=""></a>
                        </td>
                        <td class="name_product">
                            <h5 class="truncate"><a href=""><?= $cart['data']['name'] ?></a></h5>
                            <p>ID sản phẩm: <?= $cart['data']['id'] ?></p>
                        </td>
                        <td class="cart_price">
                            <?php
                            if ($cart['data']['discount_price'] > 0):
                                ?>
                                <p><del class="text-danger"><?= number_format($cart['data']['price'], 0, ',', '.') ?> VND</del>
                                    <?= number_format($cart['data']['discount_price'], 0, ',', '.') ?> VND</p>
                                <?php
                            else:
                                ?>
                                <p>
                                    <?= number_format($cart['data']['price'], 0, ',', '.') ?> VND
                                </p>

                                <?php
                            endif;
                            ?>

                        </td>
                        <td class="cart_quantity">
                            <form action="/cart/update" method="post">
                                <input type="hidden" name="method" id="" value="PUT">
                                <input class="quantity form-control input-number number_cart" type="number" name="quantity"
                                    value="<?= $cart['quantity'] ?>" onchange="this.form.submit()" class="form-control" min=1>
                                <input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
                                <input type="hidden" name="update-cart-item">
                            </form>
                        </td>
                        <td class="cart_total">



                            <?php
                            if ($cart['data']['discount_price'] > 0):
                                $discount_price = $cart['quantity'] * $cart['data']['discount_price'];
                                $total_price += $discount_price;
                                ?>
                                <p class="cart_total_price"><?= number_format($discount_price, 0, ',', '.') ?> VND</p>

                                

                                <?php
                            else:
                                $unit_price = $cart['quantity'] * $cart['data']['price'];
                                $total_price += $unit_price;
                                ?>
                                <p class="cart_total_price"><?= number_format($unit_price, 0, ',', '.') ?> VND</p>

                                <?php
                            endif;
                            ?>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php
                else:
                endif;
            endforeach;
        else: ?>
        <?php
        endif;
    }
}