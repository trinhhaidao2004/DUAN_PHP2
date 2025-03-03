<?php
namespace App\View\Client;

use App\View\Client\Component\Category;
use App\View\Client\Component\Navbar_product;
use App\View\Client\Component\Product;
use App\View\Client\Component\Product_slides;
use App\View\View;

class Index extends View
{
	public static function render($data = [])
	{
		?>
		<section id="slider">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="item active item_slides">
								<img src="<?= APP_URL ?>/public/Client/assets/images/home/10.png" class="girl img-responsive"
									alt="" width="100%" />
							</div>
							<div class="item  item_slides">
								<img src="<?= APP_URL ?>/public/Client/assets/images/home/11.png" class="girl img-responsive"
									alt="" width="100%" />
							</div>
							<div class="item item_slides">
								<img src="<?= APP_URL ?>/public/Client/assets/images/home/16.png" class="girl img-responsive"
									alt="" width="100%" />
							</div>
						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>

			</div>
		</section><!--/slider-->

		<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-12 padding-right">

						<div class="features_items" id="product-list-select"><!--features_items-->
							<h2 class="title text-center">Danh sách sản phẩm</h2>
							<?php
							Product::render($data['products']['products']);
							?>
						</div><!--features_items-->
						<div class="d-fle-pages">
							<div class="pagination-area">
								<ul class="pagination d-flex justify-content-center">
									<?php
									$currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
									$totalPages = $data['products']['total_pages'];
									$prevPage = $currentPage - 1;
									?>
									<li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
										<a class="page-link" href="<?= $currentPage > 1 ? '/?pages=' . $prevPage : '#' ?>">
											<< </a>
									</li>
									<?php
									// var_dump($currentPage);
									for ($i = 1; $i <= $totalPages; $i++): ?>
										<li class="page-item ">
											<a class="page-link <?= $i === $currentPage ? 'active' : '' ?>"
												href="/?pages=<?= $i ?>"><?= $i ?></a>
										</li>
									<?php endfor; ?>

									<?php
									$nextPage = $currentPage + 1;
									?>
									<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
										<a class="page-link"
											href="<?= $currentPage < $totalPages ? '/?pages=' . $nextPage : '#' ?>">
											>> </a>
									</li>
								</ul>


							</div>
						</div>
						<?php
						Navbar_product::render($data);
						?>
					</div>
				</div><!--features_items-->
			</div>
			
		</section>

		<?php

	}
}