<?php


namespace App\View\Admin\Component\User;

use App\View\Admin\Component\Form as Table;

trait IndexTrashCan
{
    public static function content($data = [])
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?>
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Product List Widget -->
                <!-- Product List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title">Danh sách người dùng </h5>
                        <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                            <div class="col-md-4 product_status">
                                <select id="ProductStatus" class="form-select text-capitalize">
                                    <option value="">Hiển thị</option>
                                    <option value="Scheduled">Ẩn</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (count($data)):
                        ?>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Họ và Tên</th>
                                        <th>Ảnh đại diện</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa Chỉ</th>
                                        <?php
                                        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users'):
                                            ?>
                                            <th>Trạng thái</th>
                                            <?php
                                        endif;
                                        ?>
                                        <th>Quyền</th>
                                        <th>Tùy chỉnh</th>
                                        <th>Đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php

                                    foreach ($data as $item):
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $item['id'] ?>
                                            </td>
                                            <td>
                                                <?= $item['name'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($item['google_id'] && $item['avatar']) {
                                                    echo ' <img src="' . $item['avatar'] . '"
                                                        alt="Avatar" class="rounded-circle" width="60px" height="60px" />';
                                                } else if ($item['avatar']) {
                                                    echo ' <img src="<?= APP_URL ?>/public/Client/assets/images/home/' . $item['avatar'] . '" alt="Avatar"
                                                        class="rounded-circle" width="60px" height="60px" />';
                                                } else {
                                                    echo '   <img src="/public/Client/assets/images/home/user.png" alt="Avatar"
                                                        class="rounded-circle" width="60px" height="60px" />';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= $item['email'] ?>
                                            </td>
                                            <td>
                                                <?= $item['phone'] ?>
                                            </td>
                                            <td class="small-description">
                                                <span class="small-description text-truncate d-flex align-items-center text-heading">
                                                    small-descriptionsmall-descriptionsmall-descriptionsmall-descriptionsmall-descriptionsmall-descriptionsmall-descriptionsmall-descriptionsmall-descriptionsmall-description
                                                </span>
                                            </td>
                                            <?php
                                            if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users'):
                                                ?>
                                                <td>

                                                    <?php
                                                    if ($item['role'] != 0) {
                                                        Table::status($item);
                                                    } else {
                                                        echo ' <p class="text-primary p-item">Quản trị viên</p>';
                                                    }

                                                    ?>
                                                </td>
                                                <?php
                                            endif;
                                            ?>
                                            <td><?= ($item['role'] == 0) ? '<p class="text-primary p-item">Quản trị viên</p> ' : 'Khách hàng' ?>
                                            </td>
                                            <td>
                                                <?php

                                                if ($item['role'] != 0) {
                                                    if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users') {
                                                        Table::edit_update(url: 'users', item: $item['id']);
                                                    } else {
                                                        Table::edit_update_trashcan(url: 'users', item: $item['id']);
                                                    }
                                                } else {
                                                    echo ' <p class="text-primary p-item">Quản trị viên</p>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users') {
                                                    ?>
                                                    <a href="/admin/user/order/<?= $item['id'] ?>" class="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                            style="fill: rgba(0, 0, 0, 1);">
                                                            <path
                                                                d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z">
                                                            </path>
                                                            <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path>
                                                        </svg> Lịch sử mua hàng
                                                    </a>
                                                    <?php
                                                }

                                                ?>
                                            </td>

                                        </tr>

                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    else:
                        ?>
                        <h5 class="text-center text-danger mt-2">Không có dữ liệu</h5>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>

        <?php
    }
}