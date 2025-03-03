<?php
namespace App\View\Client\Page;

use App\View\Client\Component\Category;
use App\View\View;

class Post extends View
{
	public static function render($data = [])
	{
		//var_dump($data);
		?>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<!-- <div class="left-sidebar">

							<div class="brands_products">
								<h2>Danh mục bài viết</h2>
								<div class="brands-name">
									<ul class="nav nav-pills nav-stacked">
										<li><a href="/"> <span class="pull-right">(50)</span>Từ 3 -> 12 tuổi.</a></li>
										<li><a href="#"> <span class="pull-right">(56)</span>Từ 12 -> 18 tuổi</a></li>
										<li><a href="#"> <span class="pull-right">(27)</span>Từ 18 tuổi trở lên </a></li>
									</ul>
								</div>
							</div>
						</div> -->
					</div>
					<div class="col-sm-9">
						<div class="blog-post-area">
							<h2 class="title text-center">Danh sách bài viết</h2>
							<?php if (count($data)):
								foreach ($data as $item): ?>

									<div class="single-blog-post">
										<h3><?=$item['title']?></h3>
										<div class="post-meta">
											<ul>
												<li><i class="fa fa-user"></i> <?=$item['author']?></li>
												<!-- <li><i class="fa fa-clock-o"></i> 1:33 pm</li> -->
												<li><i class="fa fa-calendar"></i> <?=$item['created_at']?></li>
											</ul>
											<span>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-half-o"></i>
											</span>
										</div>
										<a href="">
										<img src="<?= APP_URL ?>/public/Client/assets/images/home/<?= $item['image'] ?>" alt=""
										width="100%">
										</a>
										<p><?=$item['summary']?></p>
										<a class="btn btn-primary" href="/post/single/<?= $item['id'] ?>">Chi tiết bài viết</a>
									</div>

									<?php
								endforeach;
							else: ?>
							<?php endif; ?>



							<!-- <div class="pagination-area">
								<ul class="pagination">
									<li><a href="" class="active">1</a></li>
									<li><a href="">2</a></li>
									<li><a href="">3</a></li>
									<li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
								</ul>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php

	}
}
