<?php
namespace App\View\Client\Product;

use App\View\View;
use App\View\Client\Component\Category;
use App\View\Client\Component\Navbar_product;
use App\View\Client\Component\Product;
use App\View\Client\Component\Product_slides;
class ProductDetails extends View
{


	public static function render($data = [])
	{
		// var_dump($data['id']);
		?>
		<section>
			<div class="container">
				<div class="row">
					<?php
					Category::render();
					?>

					<div class="col-sm-9 padding-right">
						<div class="product-details"><!--product-details-->
							<div class="col-sm-5">
								<div class="view-product">
									<img src="<?= APP_URL ?>/public/Client/assets/images/home/<?= $data['products']['image'] ?>"
										alt="" />

								</div>

							</div>
							<div class="col-sm-7">
								<div class="product-information"><!--/product-information-->
									<!-- <img src="<?= APP_URL ?>/public/Client/assets/images/product-details/new.jpg" class="newarrival" alt="" /> -->
									<h2><?= $data['products']['name'] ?></h2>
									<p>Web ID: <?= $data['products']['id'] ?></p>
									<img src="<?= APP_URL ?>/public/Client/assets/images/product-details/rating.png" alt="" />
									<div class="price">
										<?php
										if ($data['products']['discount_price'] > 0):
											?>

											<del class="text-danger"><?= number_format($data['products']['price'], 0, ',', '.') ?>
												VND</del><span><?= number_format($data['products']['discount_price'], 0, ',', '.') ?>
												VND</span>

											<?php
										else:
											?>
											<span><?= number_format($data['products']['price'], 0, ',', '.') ?> VND</span>
										<?php endif; ?>
									</div>
									<form action="/cart/add" method="post">
										<span>
											<label>Quantity:</label>
											<input type="number" id="quantity" name="number"
												class="" value="1" min="1" max="100">
											<input type="hidden" name="id" id="" value="<?= $data['products']['id'] ?>">
											<button type="submit" class="btn btn-fefault cart">
												<i class="fa fa-shopping-cart"></i>
												Thêm vào giỏ hàng
											</button>
										</span>
									</form>
									<p><b>Tình trạng:</b> Còn hàng</p>
									<p><b>Tình trạng:</b> Mới</p>
									<p><b>Danh mục:</b> <?= $data['products']['category_name'] ?></p>
									<a href=""><img src="<?= APP_URL ?>/public/Client/assets/images/product-details/share.png"
											class="share img-responsive" alt="" /></a>
								</div><!--/product-information-->
							</div>
						</div><!--/product-details-->

						<?php


						Navbar_product::render($data);
						?>



					</div>
				</div>
			</div>
		</section>

		<?php
	}
}