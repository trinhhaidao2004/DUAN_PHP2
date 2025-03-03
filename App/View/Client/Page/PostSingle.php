<?php
namespace App\View\Client\Page;

use App\View\View;

class PostSingle extends View
{
	public static function render($data = [])
	{
		// var_dump($data);
		?>

		<section>
			<div class="container">
				<div class="row">
					
					<div class="col-sm-12">
						<div class="blog-post-area">
							<h2 class="title text-center">Chi tiết bài viết</h2>
							<div class="single-blog-post">
								<h3><?= $data['title'] ?></h3>
								<div class="post-meta">
									<ul>
										<li><i class="fa fa-user"></i><?= $data['author'] ?></li>
										<!-- <li><i class="fa fa-clock-o"></i> 1:33 pm</li> -->
										<li><i class="fa fa-calendar"></i><?= $data['created_at'] ?></li>
									</ul>
									<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
									</span>
								</div>
								<h4 class="text-primary">
									Nội dung bài viết :
								</h4>
								<p>
									<?= $data['content'] ?>
								</p>
								
							</div>
						</div><!--/blog-post-area-->
					</div>
				</div>
			</div>
		</section>
		<?php

	}
}


