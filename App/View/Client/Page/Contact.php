<?php
namespace App\View\Client\Page;

use App\View\Client\Component\Form;

use App\View\View;
class Contact extends View
{
	public static function render($data = [])
	{
		?>



		<div id="contact-page" class="container">
			<div class="bg">
				<div class="row">
					<div class="col-sm-12">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d497.0619907570106!2d104.81237443773686!3d9.17957529551059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1737708728743!5m2!1svi!2s"
							width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="contact-form">
						<h2 class="title text-center">Liên hệ</h2>
						<div class="status alert alert-success" style="display: none"></div>
						<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
							<div class="form-group col-md-6">
								<?php Form::input('name', 'Họ và tên', '');
								?>
							</div>
							<div class="form-group col-md-6">
							<?php Form::input('email', 'Email', 'email'); ?>
							</div>
							
							<div class="form-group col-md-12">
							<?php Form::textarea('textarea', 'Nội dung gửi'); ?>

							</div>
							<div class="form-group col-md-12">
							<?php Form::input(name:'submit',type:'submit',class:'btn btn-primary pull-right',value:'Gửi'); ?>
							</div>
						</form>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="contact-info">
						<h2 class="title text-center">Thông tin liên hệ</h2>
						<address>
							<p>Book Store</p>
							<p>Kinh Hòn Bắc, Khánh Bình Tây, Trần Văn Thời, Cà Mau</p>
							<p>Số Điện Thoại: +2346 17 38 93</p>
							<p>Email: bookstore@gmail.com</p>
						</address>
						<div class="social-networks">
							<h2 class="title text-center">Mạng xã hội</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		</div><!--/#contact-page-->



		<?php

	}
}