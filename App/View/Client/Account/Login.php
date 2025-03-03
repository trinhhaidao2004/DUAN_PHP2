<?php
namespace App\View\Client\Account;

use App\View\Client\Component\Form;
use App\View\View;


class Login extends View
{
	public static function render($data = [])
	{
		?>
		<section id="form">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="login-form"><!--login form-->
							<h2>Đăng nhập</h2>
							<form action="/login" method="post">
								<?php
								Form::input('email', 'Email', type: 'email', class: '', placeholder: 'Vui long nhập email');
								Form::input('password', 'Mật khẩu', type: 'password', class: '', placeholder: 'Vui long nhập mật khẩu');
								?>
								<div class="d_flex_forgetpass">
									<span>
										<input type="checkbox" class="checkbox" name="remember">
										Lưu Mật khẩu
									</span>
									<p class="my-5"><a href="/forgetpass" class="mr-2">Quên mật khẩu ?</a> </p>

								</div>


								<?php
								Form::button(value: 'Đăng nhập', class: 'btn btn-default');
								?>
								<div class="item-google">
									<a class="item-a-google" href="/login-google" width="100%">
										<p class="item-p-google">Đăng nhập với</p><img
											src="<?= getenv(APP_URL) ?>public/Client/assets/images/home/google.png" alt=""
											width="40px" class="mr-3">
									</a>
								</div>
								
							</form>
						</div><!--/login form-->
					</div>
					<div class="col-sm-1">
						<h2 class="or">Hoặc</h2>
					</div>
					<div class="col-sm-4">
						<div class="signup-form">
							<h2>Đăng ký</h2>
							<form action="/register/new" method="post">
								<?php
								Form::input('name', label: 'Họ và tên', class: '', placeholder: 'Vui lòng nhập họ và tên');
								Form::input('email', label: 'Email', type: 'email', class: '', placeholder: 'Vui lòng nhập email');
								Form::input('phone', label: 'Số điện thoại', class: '', placeholder: 'Vui lòng nhập số điện thoại');
								Form::input('password', label: 'Mật khẩu', type: 'password', class: '', placeholder: 'Vui lòng nhập mật khẩu');
								Form::input('re_password', label: 'Nhập lai mật khẩu', type: 'password', class: '', placeholder: 'Vui lòng nhập lại mật khẩu');
								Form::button(value: 'Đăng ký', class: 'btn btn-default');
								?>

							</form>
						</div><!--/sign up form-->
					</div>
				</div>
			</div>
		</section><!--/form-->
		<?php
	}
}



