<?php
namespace App\View\Client\Product;


use App\View\Client\Component\Category;
use App\View\Client\Component\Product;
use App\View\View;
class Index extends View
{


	public static function render($data = [])
	{

		?>
		<section id="advertisement">
			<div class="container">
				<img src="public/Client/assets/images/home/product.jpg" alt="" />
			</div>
		</section>
		<section>
			<div class="container">
				<div class="row">
					<?php
					Category::render($data['categories']);
					?>
					<div class="col-sm-9 padding-right">
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
										<a class="page-link" href="<?= $currentPage > 1 ? '/products?pages=' . $prevPage : '#' ?>">
											<< </a>
									</li>
									<?php
									// var_dump($currentPage);
									for ($i = 1; $i <= $totalPages; $i++): ?>
										<li class="page-item ">
											<a class="page-link <?= $i === $currentPage ? 'active' : '' ?>"
												href="/products?pages=<?= $i ?>"><?= $i ?></a>
										</li>
									<?php endfor; ?>

									<?php
									$nextPage = $currentPage + 1;
									?>
									<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
										<a class="page-link"
											href="<?= $currentPage < $totalPages ? '/products?pages=' . $nextPage : '#' ?>">
											>> </a>
									</li>
								</ul>

							</div>
						</div>
					</div>
				</div>

			</div>
		</section>
		<?php
	}
}
