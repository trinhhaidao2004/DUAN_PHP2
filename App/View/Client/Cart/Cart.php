<?php
namespace App\View\Client\Cart;

use App\Helpers\AuthHelper;
use App\View\View;



class Cart extends View
{
	public static function render($data = [])
	{
		$is_login = AuthHelper::checkLogin();
		//var_dump($data);
		?>
		<section id="cart_items">
			<div class="container">
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image_product">Hình ảnh</td>
								<td class="description">Tên sản phẩm</td>
								<td class="price">Giá</td>
								<td class="quantity">Số lượng</td>
								<td class="total">Tổng</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php $total_price = 0;
							$total_number = 0;
							$i = 0;
							if (count($data)):
								foreach ($data as $cart):
									$i++;

									if ($cart['data']):
										// var_dump($item['data']);
										?>
										<tr>
											<td class="">

												<img src="<?= APP_URL ?>/public/Client/assets/images/home/<?= $cart['data']['image'] ?>"
													alt="" width="50%">
											</td>
											<td class="name_product">
												<h5 class="truncate"><a href="/products/details/<?= $cart['data']['id'] ?>"><?= $cart['data']['name'] ?></a></h5>
												<p>ID sản phẩm: <?= $cart['data']['id'] ?></p>
											</td>
											<td class="cart_price">
												<?php
												if ($cart['data']['discount_price'] > 0):
													?>
													<p><del class="text-danger"><?= number_format($cart['data']['price'], 0, ',', '.') ?>
															VND</del>
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
													<input class="quantity form-control input-number number_cart" type="number"
														name="quantity" value="<?= $cart['quantity'] ?>" onchange="this.form.submit()"
														class="form-control" min=1>
													<input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
													<input type="hidden" name="update-cart-item">
												</form>
											</td>
											<td class="cart_total">



												<?php
												if ($cart['data']['discount_price'] > 0):
													$discount_price = $cart['quantity'] * $cart['data']['discount_price'];
													$total_number += $cart['quantity'];
													$total_price += $discount_price;
													?>
													<p class="cart_total_price"><?= number_format($discount_price, 0, ',', '.') ?> VND</p>



													<?php
												else:
													$unit_price = $cart['quantity'] * $cart['data']['price'];
													$total_number += $cart['quantity'];
													$total_price += $unit_price;
													?>
													<p class="cart_total_price"><?= number_format($unit_price, 0, ',', '.') ?> VND</p>

													<?php
												endif;
												?>
											</td>
											<td class="cart_delete">
												<form action="/cart/delete" method="post">
													<input type="hidden" name="method" id="" value="DELETE">
													<input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
													<button type="submit" class="cart_quantity_delete">
														<i class="fa fa-times"></i>
													</button>
												</form>
												<!-- <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a> -->
											</td>
										</tr>
										<?php
									endif;
								endforeach;
							else: ?>
								<h5 class="text-center text-danger mt-2">Không có dữ liệu</h5>
								<?php
							endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</section> <!--/#cart_items-->

		<section id="do_action">
			<div class="container">
				<div class="heading">
					<!-- <h3>Bạn muốn làm gì tiếp theo?</h3>
					<p>Chọn nếu bạn có mã giảm giá hoặc điểm thưởng mà bạn muốn sử dụng hoặc muốn ước tính chi phí giao hàng.</p> -->
				</div>
				<div class="row">
					<div class="col-sm-6">

					</div>
					<div class="col-sm-6">
						<div class="total_area">
							<ul>
								<li>Tổng cộng giỏ hàng <span><?= number_format($total_price, 0, ',', '.') ?> VND</span></li>
								<li>Số lượng sản phẩm <span><?= $total_number ?></span></li>
								<li>Tổng<span><?= number_format($total_price, 0, ',', '.') ?> VND</span></li>
							</ul>

							<?php
							if ($is_login):
								?>
								<a class="btn btn-default check_out" href="/checkout">Thanh toán</a>
								<?php
							else:
								?>
								<a class="btn btn-default update" href="/account">Vui lòng đăng nhập để thanh toán</a>
								<?php
							endif;
							?>


						</div>
					</div>
				</div>
			</div>
		</section><!--/#do_action-->

		<?php
	}
}