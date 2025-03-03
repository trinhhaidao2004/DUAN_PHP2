<?php


namespace App\View\Admin\Component\Product;

use App\View\Admin\Component\Form as Table;

trait IndexTrashCan
{
    public static function content($data = [])
    {
        //  var_dump($data);
        //  die;
        $currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;

        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?>

        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Product List Widget -->
                <!-- Product List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title">Danh sách sản phẩm </h5>
                        <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                            <div class="col-md-4 product_status"><select id="ProductStatus" class="form-select text-capitalize">
                                    <option value="">Tiểu thuyết</option>
                                    <option value="Scheduled">Truyện tranh</option>
                                    <option value="Publish">Văn học</option>
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
                                        <th>Tên sản phẩm </th>
                                        <th>Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Giá giảm</th>
                                        <th>Danh mục</th>
                                        <th>Độ tuổi</th>
                                        <?php
                                        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products?pages=' . $currentPage):
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
                                    foreach ($data['products'] as $item):
                                        ?>
                                        <tr>
                                            <td><?= $item['id'] ?></td>
                                            <td>
                                                <h6 class="small-description name_item">
                                                    <?= $item['name'] ?>
                                                </h6> 
                                                <span
                                                    class="small-description text-truncate d-flex align-items-center text-heading">

                                                </span>
                                            </td>
                                            <td><img src="<?= APP_URL ?>/public/Client/assets/images/home/<?= $item['image'] ?>" alt=""
                                                    width="100px"></td>

                                            <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                                            <td>
                                                <?php
                                                if ($item['discount_price'] > 0):
                                                    ?>
                                                    <span><?= number_format($item['discount_price'], 0, ',', '.') ?> VND</span>
                                                    <?php
                                                else:
                                                    ?>
                                                    <span>Chưa có giá giảm</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $item['category_name'] ?></td>
                                            <td>
                                                <?php
                                                if ($item['age'] == 0) {
                                                    echo 'Từ 3 -> 12 tuổi';
                                                } else if ($item['age'] == 1) {
                                                    echo 'Từ 12 -> 18 tuổi';
                                                } else {
                                                    echo 'Từ 18 tuổi trở lên';
                                                }
                                                ?>
                                            </td>
                                            <?php
                                            if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products?pages=' . $currentPage):
                                                ?>
                                                <td>
                                                    <?php
                                                    Table::status($item, $currentPage);
                                                    ?>
                                                </td>
                                                <?php
                                            endif;
                                            ?>
                                            <td>
                                                <?php
                                                if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products?pages=' . $currentPage) {
                                                    Table::edit_update(url: 'products', item: $item['id']);
                                                } else {
                                                    Table::edit_update_trashcan(url: 'products', item: $item['id']);
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
                <div class="row my-5 justify-content-center">
                    <nav aria-label="...">
                        <ul class="pagination d-flex justify-content-center">
                            <?php
                            $currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
                            $totalPages = $data['total_pages'];
                            $prevPage = $currentPage - 1;
                            ?>
                            <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link"
                                    href="<?= $currentPage > 1 ? '/admin/products?pages=' . $prevPage : '#' ?>">
                                    << </a>
                            </li>

                            <?php
                            for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="/admin/products?pages=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php
                            $nextPage = $currentPage + 1;
                            ?>
                            <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link"
                                    href="<?= $currentPage < $totalPages ? '/admin/products?pages=' . $nextPage : '#' ?>">
                                    >> </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>

        </div>



        <?php
    }
}