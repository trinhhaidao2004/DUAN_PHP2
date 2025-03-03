<?php
namespace App\View\Client\Cart;

use App\View\Client\Component\Form;
use App\View\Client\Component\Table;
use App\View\View;
use App\View\Client\Component\Notification;
use App\Helpers\NotificationHelper;
use App\Models\User;

class Checkout extends View
{
	public static function render($data = [])
	{
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
												<h5 class="truncate"><a href=""><?= $cart['data']['name'] ?></a></h5>
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
												<?= $cart['quantity'] ?>
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
										</tr>
										<?php
									endif;
								endforeach;
								?>
								<tr>
									<td colspan="4">&nbsp;</td>
									<td colspan="2">
										<table class="table table-condensed total-result">
											<tr>
												<td>
													Tổng cộng giỏ hàng</td>
												<td><?= number_format($total_price, 0, ',', '.') ?> VND</td>
											</tr>

											<tr class="shipping-cost">
												<td>Chi phí vận chuyển </td>
												<td>30.000 VND</td>
											</tr>
											<tr>
												<td>Tổng cộng </td>
												<td><span class="total-display"><?= number_format($total_price, 0, ',', '.') ?>
														VND</span></td>
											</tr>
										</table>
									</td>
								</tr>
								<?php
							else: ?>
								<h5 class="text-center text-danger mt-2">Không có dữ liệu</h5>
								<?php
							endif; ?>
						</tbody>
					</table>
				</div>
				<?php
				Notification::render();
				NotificationHelper::unset();
				?>
				<form action="/order" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="shopper-informations">
								<div class="row">
									<h2 class="title text-center">Thông tin giao hàng</h2>
									<div class="col-sm-6 my-3 form_checkout">
										<?php
										Form::input('name', 'Họ và tên', class: 'form-control', placeholder: 'Vui lòng nhập họ và tên');
										?>
									</div>
									<div class="col-sm-6  my-3 form_checkout">
										<?php
										Form::input('phone', 'Số điện thoại', class: 'form-control', placeholder: 'Vui lòng nhập email');
										?>
									</div>
									<div class="col-md-6 my-3 ">
										<div class="form-group">
											<label for="country">Tỉnh</label>
											<div class="select-wrap">
												<div class="icon"><span class="ion-ios-arrow-down"></span></div>
												<select id="province" name="province" class="select-form-order">
												</select>
											</div>
										</div>
									</div>
									<input type="hidden" id="province-input" value="" name="province_">
									<div class=" col-md-6">
										<div class="form-group">
											<label for="country">Huyện</label>
											<div class="select-wrap">
												<div class="icon"><span class="ion-ios-arrow-down"></span></div>
												<select name="district" id="district" class="select-form-order">
													<option value="">Chọn quận</option>
												</select>
											</div>
										</div>
									</div>
									<input type="hidden" id="district-input" name="district_">
									<div class="col-md-6">
										<div class="form-group">
											<label for="country">Phường/Xã</label>
											<div class="select-wrap">
												<div class="icon"><span class="ion-ios-arrow-down"></span></div>
												<select name="ward" id="ward" class="select-form-order">
													<option value="">Chọn phường</option>
												</select>
											</div>
										</div>
									</div>
									<input type="hidden" id="ward-input" name="ward_">


									<div class="col-sm-12 my-3 form_checkout">
										<?php
										Form::textarea('address', 'Vui lòng nhập địa chỉ ', 'Địa chỉ')
											?>
									</div>
									<!-- <div class="col-sm-12">
									<div class="blog-post-area">
										<h2 class="title text-center">Thông tin giao hàng</h2>
										<div class="single-blog-post">
											<h3>Tên khách hàng : <strong>Trịnh Hải Đảo</strong></h3>
											<h3>Số điện thoại : <strong>0839644625</strong></h3>
											<h3>Địa chỉ giao hàng : <strong>Kinh Hòn Bắc, Khánh Bình Tây, Trần Văn Thời, Cà
													Mau</strong>
											</h3>
											<a class="btn btn-primary" href="">Thay đổi địa chỉ giao hàng</a>
										</div>
									</div>
								</div> -->
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<h2 class="title text-center">Phương thức</h2>
							<div class="step-one">
								<h2 class="heading">Phương thức thanh toán</h2>
							</div>
							<div class="checkout-options">
								<ul class="nav">
									<li>
										<label><input type="radio" name="PaymentMethod" value="COD"> Thanh
											toán khi nhận hàng</label>
									</li>
									<li>
										<label><input type="radio" name="PaymentMethod" value="VNPAY">
											VNPay</label>
									</li>
									<li>
										<label><input type="radio" name="PaymentMethod" value="PAYMENT">
											Chuyển khoản ngân hàng</label>
									</li>
									<?php
									$user = new User();
									$balance = $user->getBalance($_SESSION['user']['id']);
									if ($balance['balance'] > 0): ?>
										<li>
											<label><input type="radio" name="PaymentMethod" value="BLANCE"
													data-balance="<?= $balance['balance'] ?>" data-total="<?= $total_price ?>">
												Số dư trong ví : <span
													class="balance-display"><?= number_format($balance['balance'], 0, ',', '.') ?>
													VND</span>
											</label>
										</li>

										
									<?php endif; ?>
									<input type="hidden" name="total" value="<?= $total_price ?? '' ?>">
									<input type="hidden" name="balance" value="<?= $balance['balance'] ?? '' ?>">
								</ul>
							</div>
							<div class="step-one">
								<h2 class="heading">Phương thức vận chuyển</h2>
							</div>
							<div class="checkout-options">
								<ul class="nav item-nav-checkout">
									<li>
										<label><input type="radio" name="delivery" value="conomy"> Giao hàng tiết kiệm</label><img src="/public/Client/assets/images/home/Logo-GHTK-Slogan-768x576.webp" alt=""
										width="20%">
									</li>
									<li>
										<label><input type="radio" name="delivery" value="fast"> Giao hàng nhanh</label>
										<img src="/public/Client/assets/images/home/Logo-GHN-Slogan-En.webp" alt="" width="15%" class="ml-2">
									</li>

								</ul>
							</div><!--/checkout-options-->
							<div class="register-req">
								<p>Vui lòng sử dụng Đăng ký và Thanh toán để dễ dàng truy cập vào lịch sử đơn hàng của bạn hoặc
									sử
									dụng
									Thanh toán với tư cách là Khách</p>
							</div><!--/register-req-->
						</div>
					</div>
					<div class="payment-options d_flex_checkout">
						<?php Form::input(type: 'submit', class: 'btn btn-primary button_checkout', value: 'Đặt hàng'); ?>
					</div>
				</form>
			</div>
		</section> <!--/#cart_items-->


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
			integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
			crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"
			integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
			crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script>
			const host = "https://provinces.open-api.vn/api/";
			var callAPI = (api) => {
				return axios.get(api)
					.then((response) => {
						renderData(response.data, "province");
					});
			}
			callAPI('https://provinces.open-api.vn/api/?depth=1');
			var callApiDistrict = (api) => {
				return axios.get(api)
					.then((response) => {
						renderData(response.data.districts, "district");
					});
			}
			var callApiWard = (api) => {
				return axios.get(api)
					.then((response) => {
						renderData(response.data.wards, "ward");
					});
			}

			var renderData = (array, select) => {
				let row = ' <option  value="">Vui lòng chọn</option>';
				array.forEach(element => {
					row += `<option value="${element.code}">${element.name}</option>`
				});
				document.querySelector("#" + select).innerHTML = row
			}
			$("#province").change(() => {
				callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
				printResult();
			});
			$("#district").change(() => {
				callApiWard(host + "d/" + $("#district").val() + "?depth=2");
				printResult();
			});
			$("#ward").change(() => {
				printResult();
			})
			var printResult = () => {
				if ($("#district").val() !== "" && $("#province").val() !== "" && $("#ward").val() !== "") {
					// Lấy giá trị từ các dropdown
					let province = $("#province option:selected").text();
					let district = $("#district option:selected").text();
					let ward = $("#ward option:selected").text();
					// Lưu giá trị vào input
					$("#province-input").val(province);
					$("#district-input").val(district);
					$("#ward-input").val(ward);
					// Debug (Kiểm tra giá trị được lưu)
					console.log("Tỉnh:", province, "Huyện:", district, "Phường:", ward);
				}
			};
		</script>


		<!-- ajaxtính ví  -->
		<script>
			$(document).ready(function () {
				var defaultTotal = $('.total-display').data('default-total');

				$('input[name="PaymentMethod"]').on('change', function () {
					var paymentMethod = $(this).val();
					var balance_input = $('input[name="balance"]').val();
					var total_input = $('input[name="total"]').val();
					// Chỉ chạy AJAX khi phương thức thanh toán là 'BLANCE' và input đang hiển thị
					if (paymentMethod === 'BLANCE' && $(this).is(':visible')) {
						var balance = $(this).data('balance');
						var total = $(this).data('total');

						$.ajax({
							url: '/order/balance',
							type: 'POST',
							data: {
								payment_method: 'BLANCE',
								balance: balance,
								total: total
							},
							dataType: 'json',
							success: function (response) {
								console.log(response.total);
								$('.balance-display').text(numberWithCommas(response.balance) + ' VND');
								$('.total-display').text(numberWithCommas(response.total) + ' VND');
							},
							error: function () {
								alert('Đã có lỗi xảy ra!');
							}
						});
					} else {
						console.log('Phương thức thanh toán khác:', paymentMethod);
						$('.balance-display').text(numberWithCommas(balance_input) + ' VND');
						$('.total-display').text(numberWithCommas(total_input) + ' VND');
					}
				});
			});

			// Hàm định dạng số có dấu phẩy
			function numberWithCommas(x) {
				return parseFloat(x).toLocaleString('vi-VN', { style: 'decimal', maximumFractionDigits: 0 });
			}


		</script>
		<?php
	}
}