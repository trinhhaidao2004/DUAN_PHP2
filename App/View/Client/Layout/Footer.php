<?php
namespace App\View\Client\Layout;

use App\View\Client\Component\Form;
use App\View\View;

class Footer extends View
{


	public static function render($data = [])
	{
		?>

		<footer id="footer"><!--Footer-->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="companyinfo">
								<img src="<?= APP_URL ?>/public/Client/assets/images/home/logo 1.png" alt="" width="">
							</div>
						</div>
						<div class="col-sm-7">
							<div class="col-sm-3">
								<div class="video-gallery text-center">
									<a href="https://www.youtube.com/watch?v=3EA10-gy-pg">
										<div class="iframe-img">
											<img src="<?= APP_URL ?>/public/Client/assets/images/home/video1.jpg" alt="" />
										</div>
										<div class="overlay-icon">
											<i class="fa fa-play-circle-o"></i>
										</div>
									</a>
									<p>Sách video kho miễn phí</p>
									<h2>24/03/2022</h2>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="video-gallery text-center">
									<a href="https://www.youtube.com/watch?v=vvKUuFk_uWI">
										<div class="iframe-img">
											<img src="<?= APP_URL ?>/public/Client/assets/images/home/video2.jpg" alt="" />
										</div>
										<div class="overlay-icon">
											<i class="fa fa-play-circle-o"></i>
										</div>
									</a>
									<p>Sách Kệ Thư viện Đọc bởi Continuous 4K</p>
									<h2>24/03/2024</h2>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="video-gallery text-center">
									<a href="https://www.youtube.com/watch?v=M_VyUAtvz8I">
										<div class="iframe-img">
											<img src="<?= APP_URL ?>/public/Client/assets/images/home/video3.jpg" alt="" />
										</div>
										<div class="overlay-icon">
											<i class="fa fa-play-circle-o"></i>
										</div>
									</a>
									<p>Đọc sách theo tâm trạng, mua sắm</p>
									<h2>11/06/2024</h2>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="video-gallery text-center">
									<a href="https://www.youtube.com/watch?v=_meVfEgUNeo">
										<div class="iframe-img">
											<img src="<?= APP_URL ?>/public/Client/assets/images/home/video4.jpg" alt="" />
										</div>
										<div class="overlay-icon">
											<i class="fa fa-play-circle-o"></i>
										</div>
									</a>
									<p>Corner Bookstore New York cho sách hư cấu và sách phi hư cấu</p>
									<h2>30/6/2025</h2>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="footer-widget">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Dịch vụ</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Trợ giúp trực tuyến</a></li>
									<li><a href="#">Liên hệ với chúng tôi</a></li>
									<li><a href="#">Trang thái đơn hàng</a></li>
									<li><a href="#">Thay đổi vị trí</a></li>
									<li><a href="#">Câu hỏi thường gặp</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Cửa hàng Quock</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Sách</a></li>
									<li><a href="#">Thẻ quà tặng</a></li>
									<li><a href="#">Sách mới</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Chính sách</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Điều khoản sử dụng</a></li>
									<li><a href="#">Chính sách quyền riêng tư</a></li>
									<li><a href="#">Chính sách hoàn tiền</a></li>
									<li><a href="#">Hệ thống thanh toán</a></li>
									<li><a href="#">Hệ thống hỗ trợ</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Về Shopper</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Thông tin cửa hàng</a></li>
									<li><a href="#">Tin tức và sự kiện </a></li>
									<li><a href="#">Vị trí cửa hàng</a></li>
									<li><a href="#">Chương trình cộng tác viên</a></li>
									<li><a href="#">Bản quyền</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3 col-sm-offset-1">
							<div class="single-widget">
								<h2>Giới thiệu về BookStore</h2>
								<form action="#" class="searchform">
									<?php Form::input('email', 'Địa chỉ email của bạn', class: '');
									Form::button_icon('submit', class: 'btn btn-default', class_icon: 'fa fa-arrow-circle-o-right');
									?>
									<p>Nhận thông tin cập nhật mới nhất từ ​​trang web của chúng tôi và tự cập nhật cho mình...
									</p>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
						<p class="pull-right">Designed by <span><a target="_blank"
									href="http://www.themeum.com">Themeum</a></span></p>
					</div>
				</div>
			</div>

		</footer><!--/Footer-->
		<script src="<?= APP_URL ?>/public/Client/assets/js/jquery.js"></script>
		<script src="<?= APP_URL ?>/public/Client/assets/js/bootstrap.min.js"></script>
		<script src="<?= APP_URL ?>/public/Client/assets/js/jquery.scrollUp.min.js"></script>
		<script src="<?= APP_URL ?>/public/Client/assets/js/price-range.js"></script>
		<script src="<?= APP_URL ?>/public/Client/assets/js/jquery.prettyPhoto.js"></script>
		<script src="<?= APP_URL ?>/public/Client/assets/js/main.js"></script>

		<!-- Thêm thư viện Bootstrap nếu chưa có -->
		<!-- có script 174 hoặc 165 thì ajax mới chạy được  -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- đoạn script xử lí ajax -->
		<script src="<?= APP_URL ?>/public/Client/assets/js/ajax.js"></script>

		<script>
			// <![CDATA[  <-- For SVG support
			if ('WebSocket' in window) {
				(function () {
					function refreshCSS() {
						var sheets = [].slice.call(document.getElementsByTagName("link"));
						var head = document.getElementsByTagName("head")[0];
						for (var i = 0; i < sheets.length; ++i) {
							var elem = sheets[i];
							var parent = elem.parentElement || head;
							parent.removeChild(elem);
							var rel = elem.rel;
							if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
								var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
								elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
							}
							parent.appendChild(elem);
						}
					}
					var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
					var address = protocol + window.location.host + window.location.pathname + '/ws';
					var socket = new WebSocket(address);
					socket.onmessage = function (msg) {
						if (msg.data == 'reload') window.location.reload();
						else if (msg.data == 'refreshcss') refreshCSS();
					};
					if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
						console.log('Live reload enabled.');
						sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
					}
				})();
			}
			else {
				console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
			}
			// ]]>
		</script>
		
		</body>

		</html>
		<?php

	}
}