<?php
namespace App\View\Admin\Component\Order;



trait Detail
{
    public static function content($title = '', $data = [])
    {
        if (count($data['orderDetail'])) {
            $address = $data['orderDetail'][0]['address'] . " " . $data['orderDetail'][0]['ward'] . " " . $data['orderDetail'][0]['district'] . " " . $data['orderDetail'][0]['province'];
        }
        ?>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">Chi tiết đơn hàng - <?= $title ?></h5>
                    <div class="row g-6">
                        <div class="col-md">
                            <div class="accordion mt-4" id="accordionExample">
                                <div class="row d-flex order-item">
                                    <div class="col-sm-4">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button type="button" class="accordion-button collapsed order-button"
                                                    data-bs-toggle="collapse" data-bs-target="#accordionOne"
                                                    aria-expanded="false" aria-controls="accordionOne">
                                                    Khách hàng
                                                </button>
                                            </h2>

                                            <div id="accordionOne" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p class="p-item">Tên khách hàng : <b><?= $data['orderDetail'][0]['user_name'] ?></b></p>
                                                    <p class="p-item">Email : <b><?= $data['orderDetail'][0]['email'] ?></b></p>
                                                    <p class="p-item">Số điện thoại : <b><?= $data['orderDetail'][0]['user_phone'] ?></b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button type="button" class="accordion-button collapsed order-button"
                                                    data-bs-toggle="collapse" data-bs-target="#accordionTwo"
                                                    aria-expanded="false" aria-controls="accordionTwo">
                                                    Người nhận
                                                </button>
                                            </h2>
                                            <div id="accordionTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p class="p-item">Tên khách hàng : <b><?= $data['orderDetail'][0]['name'] ?></b></p>
                                                    <p class="p-item">Số điện thoại : <b><?= $data['orderDetail'][0]['phone'] ?></b></p>
                                                    <p class="p-item">Địa chỉ : <b><?= $address ?></b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button type="button" class="accordion-button collapsed order-button"
                                                    data-bs-toggle="collapse" data-bs-target="#accordionThree"
                                                    aria-expanded="false" aria-controls="accordionThree">
                                                    Đơn hàng
                                                </button>
                                            </h2>
                                            <div id="accordionThree" class="accordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p class="p-item">Mã đơn hàng : # <b><?= $data['order_id'] ?> </b></p>
                                                    <p class="p-item">Ngày đặt hàng : <b> <?= $data['orderDetail'][0]['date'] ?></b> </p>
                                                    <p class="p-item">Phương thức  : <b><?php
                                                    if ($data['orderDetail'][0]['paymentMethod'] == 'PAYMENT') {
                                                        echo 'Chuyển khoản ngân hàng';
                                                    } else if ($data['orderDetail'][0]['paymentMethod'] == 'VNPAY') {
                                                        echo 'Thanh toán VNPAY';
                                                    } else {
                                                        echo 'Thanh toán khi nhận hàng';
                                                    }
                                                    ?></b></p>
                                                    <p class="p-item">Trạng thái : <b><?= $title ?></b></p>
                                                    <p class="p-item">Tổng số tiền :
                                                        <b><?= number_format($data['orderDetail'][0]['total'], 0, ',', '.') ?>
                                                            VND </b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 15px">Id</th>
                                    <th>Tên sản phẩm </th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Giá giảm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng cộng</th>


                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php if (count($data['orderDetail'])):

                                    foreach ($data['orderDetail'] as $item):
                                        ?>
                                        <tr>
                                            <td><?= $item['product_id'] ?></td>
                                            <td><?= $item['product_name'] ?></td>
                                            <td><img src="<?= APP_URL ?>/public/Client/assets/images/home/<?= $item['image'] ?>" alt=""
                                                    width="100px">
                                            </td>
                                            <td>
                                                <?php
                                                if ($item['originalPrice'] > 0):
                                                    ?>
                                                    <span><?= number_format($item['originalPrice'], 0, ',', '.') ?> VND</span>
                                                    <?php
                                                else:
                                                    ?>
                                                    <?= number_format($item['unitPrice'], 0, ',', '.') ?> VND
                                                </td>
                                            <?php endif; ?>
                                            <td>
                                                <?php
                                                if ($item['originalPrice'] > 0):
                                                    ?>
                                                    <span><?= number_format($item['unitPrice'], 0, ',', '.') ?> VND</span>
                                                    <?php
                                                else:
                                                    ?>
                                                    <span>Không có giá giảm</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td>
                                                <span><?= number_format($item['totalPrice'], 0, ',', '.') ?> VND</span>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                else: ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        </div>

        
        <?php
    }
}