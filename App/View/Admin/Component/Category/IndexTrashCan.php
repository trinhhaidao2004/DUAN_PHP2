<?php


namespace App\View\Admin\Component\Category;

use App\View\Admin\Component\Form as Table;

trait IndexTrashCan
{
    public static function content($data = [])
    {
        // var_dump($data);
        // die;
        $currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title">Danh sách danh mục </h5>
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
                                        <th>Tên sản phẩm </th>
                                        <?php
                                        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories?pages=' . $currentPage):
                                            ?>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Trạng thái</th>
                                            <?php
                                        endif;
                                        ?>
                                        <th>Tùy chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
                                    foreach ($data['categories'] as $item):
                                        ?>
                                        <tr>
                                            <td><?= $item['id'] ?></td>
                                            <td>
                                                <h6 class="small-description name_item">
                                                    <?= $item['name'] ?>
                                                </h6> <span
                                                    class="small-description text-truncate d-flex align-items-center text-heading">
                                                    <?= $item['description'] ?>
                                                </span>

                                            </td>
                                            <?php
                                            if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories'|| $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories?pages=' . $currentPage ):
                                                ?>
                                                <td> <?= $item['total_products'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($item['id'] != 18) {
                                                        Table::status($item,  $currentPage);
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                            endif;
                                            ?>
                                            <td>
                                                <?php
                                                if ($item['id'] != 18) {
                                                    if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories?pages=' . $currentPage) {
                                                        Table::edit_update(url: 'categories', item: $item['id']);
                                                    } else {
                                                        Table::edit_update_trashcan(url: 'categories', item: $item['id']);
                                                    }
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
                            $totalPages = $data['total_pages'] ?? '';
                            // var_dump($data['total_pages']);
                            // die;
                            $prevPage = $currentPage - 1;
                            ?>
                            <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link"
                                    href="<?= $currentPage > 1 ? '/admin/categories?pages=' . $prevPage : '#' ?>">
                                    << </a>
                            </li>

                            <?php
                            for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="/admin/categories?pages=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php
                            $nextPage = $currentPage + 1;
                            ?>
                            <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link"
                                    href="<?= $currentPage < $totalPages ? '/admin/categories?pages=' . $nextPage : '#' ?>">
                                    >> </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <?php
    }
}