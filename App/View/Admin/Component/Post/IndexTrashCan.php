<?php


namespace App\View\Admin\Component\Post;

use App\View\Admin\Component\Form as Table;

trait IndexTrashCan
{
    public static function content($data = []): void
    {
        // var_dump($data);
        // die;
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?>
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Product List Widget -->
                <!-- Product List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title">Danh sách bài viết </h5>
                        <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                            <div class="col-md-4 product_status"><select id="ProductStatus" class="form-select text-capitalize">
                                    <option value="">Hiển thị</option>
                                    <option value="Scheduled">Ẩn</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php if (count($data)): ?>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 15px">Id</th>
                                        <th>Tiêu đề </th>
                                        <th>Hình ảnh </th>
                                        <th>Mô tả ngắn</th>
                                        <?php
                                        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/posts'):
                                            ?>
                                            <th>Trạng thái</th>
                                            <?php
                                        endif;
                                        ?>

                                        <th>Tùy chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
                                    foreach ($data as $item):
                                        ?>
                                        <tr>
                                            <td><?= $item['id'] ?></td>
                                            <td>
                                                <h6 class="small-description name_item">
                                                    <?= $item['title'] ?>
                                                </h6>
                                            </td>
                                            <td><img src="<?= APP_URL ?>/public/Client/assets/images/home/<?= $item['image'] ?>" alt=""
                                                    width="100px"></td>
                                            <td>
                                                <div class="small-description" id="itemsummary">
                                                    <?= $item['summary'] ?>
                                                </div>
                                            </td>
                                            <?php
                                            if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/posts'):
                                                ?>
                                                <td>
                                                    <?php
                                                    Table::status($item);
                                                    ?>
                                                </td>
                                                <?php
                                            endif;
                                            ?>

                                            <td>
                                                <?php
                                                if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/posts') {
                                                    Table::edit_update(url: 'posts', item: $item['id']);
                                                } else {
                                                    Table::edit_update_trashcan(url: 'posts', item: $item['id']);
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
                    <?php else: ?>
                        <h5 class="text-center text-danger mt-2">Không có dữ liệu</h5>
                    <?php endif; ?>
                </div>

            </div>


        </div>
        <?php
    }
}