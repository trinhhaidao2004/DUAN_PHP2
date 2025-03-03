<?php


namespace App\View\Admin\Component\Order;

use App\View\Admin\Component\Form as Table;

trait Index
{
    public static function content($title, $data = [])
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header"><?= $title ?? '' ?></h5>
                    <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                        <?php
                        $user_id = $data[0]['user_id'] ?? '';
                        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/user/order/' . $user_id) {
                            ?>
                            <div class="col-md-4 product_status m-3">
                                <select id="select-order" class="form-select text-capitalize">
                                    <option value="10" data-id="<?= $data[0]['user_id'] ?>">Tất cả</option>
                                    <option value="1" data-id="<?= $data[0]['user_id'] ?>">Chờ xử lí </option>
                                    <option value="2" data-id="<?= $data[0]['user_id'] ?>">Đã xác nhận</option>
                                    <option value="3">Đang chuẩn bị</option>
                                    <option value="4" data-id="<?= $data[0]['user_id'] ?>">Đang giao</option>
                                    <option value="5" data-id="<?= $data[0]['user_id'] ?>">Gia thành công</option>
                                    <option value="6" data-id="<?= $data[0]['user_id'] ?>">Chờ thanh toán</option>
                                    <option value="0" data-id="<?= $data[0]['user_id'] ?>">Đã hủy</option>
                                </select>
                            </div> <?php
                        }
                        ?>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Người mua</th>
                                    <th>Tài khoản</th>
                                    <th>Ngày mua</th>
                                    <th>Tổng giá trị đơn hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <?php
                                    if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/orders/trascan/1' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/orders/trascan/6'):
                                        ?>
                                        <th>Xác nhận đơn hàng</th>
                                    <?php endif; ?>
                                    <th>Chi tiết đơn hàng</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0 " id="order-list">

                                <?php if (count($data)):
                                    ?>
                                    <?php
                                    foreach ($data as $item):
                                        $address = $item['address'] . " " . $item['ward'] . " " . $item['district'] . " " . $item['province'];
                                        ?>
                                        <tr>
                                            <td><span>#<?= $item['id'] ?></span></td>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['email'] ?></td>

                                            <td><?= $item['date'] ?></td>
                                            <td>
                                                <?= number_format($item['total'], 0, ',', '.') ?> VND
                                            </td>
                                            <td>
                                                <?php
                                                if ($item['paymentMethod'] == 'PAYMENT') {
                                                    if ($item['orderStatus'] == 1) {
                                                        echo 'Chuyển khoản ngân hàng (Đã thanh toán)';
                                                    } else {
                                                        echo 'Chuyển khoản ngân hàng ';
                                                    }
                                                } else if ($item['paymentMethod'] == 'VNPAY') {
                                                    echo 'Thanh toán VNPAY (Đã thanh toán)';
                                                } else {
                                                    echo 'Thanh toán khi nhận hàng';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $address ?> </td>

                                            <?php
                                            if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/orders/trascan/1' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/orders/trascan/6'):
                                                if ($item['orderStatus'] == 1 || $item['orderStatus'] == 6):
                                                    ?>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch"
                                                                id="flexSwitchCheckChecked" data-id="<?= $item['id'] ?>"
                                                                data-status="<?= $item['orderStatus'] ?>">
                                                        </div>

                                                    <?php else: ?>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch"
                                                                id="flexSwitchCheckChecked" data-id="<?= $item['id'] ?>"
                                                                data-status="<?= $item['orderStatus'] ?>" checked>
                                                        </div>
                                                    </td>
                                                <?php endif;
                                            endif;
                                            ?>

                                            <td>
                                                <a href="/admin/orders/detail/<?= $item['id'] ?>" class="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                        style="fill: rgba(0, 0, 0, 1);">
                                                        <path
                                                            d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z">
                                                        </path>
                                                        <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path>
                                                    </svg> Chi tiết đơn hàng
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                else:
                                    ?>
                                    <h5 class="text-center text-danger m-2">Không có dữ liệu</h5>
                                    <?php
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#select-order').change(function () {
                    var selectedValue = parseInt($(this).val())
                    var selectedId = $(this).find('option:selected').data('id');
                    if (selectedValue) {
                        $.ajax({
                            url: '/handleOrderStatus',
                            method: 'POST', // Sử dụng POST thay vì GET
                            data: {
                                status: selectedValue,
                                userId: selectedId,
                            }, // Gửi trạng thái qua body của request
                            success: function (response) {
                                console.log(response);

                                // Render dữ liệu trả về vào phần danh sách
                                $('#order-list').html(response);
                            },
                            error: function (xhr, status, error) {
                                console.error('Error:', xhr.responseText);
                                alert('Có lỗi xảy ra khi lọc trạng thái đơn hàng!');
                            }
                        });
                    }
                });
            });
        </script>
        <?php
    }
}