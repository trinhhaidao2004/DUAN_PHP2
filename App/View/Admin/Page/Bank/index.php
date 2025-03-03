<?php

namespace App\View\Admin\Page\Bank;

use App\View\View;
use App\View\Admin\Component\Form as Table;
class index extends View
{
  public static function render($data = [])
  {
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    // var_dump($data);
    // die;
    ?>


    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card mb-3">
          <h5 class="card-header">Danh sách ngân hàng</h5>
          <div class="card-body">
            <!-- Basic Breadcrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="javascript:void(0);">Danh sách sản phẩm</a>
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="card">
          <!-- <h5 class="card-header">Table Basic</h5> -->
          <!-- <div class="card-header">
            <form action="/admin/products/search" method="get">
              <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                <input type="text" class="form-control" name="keywords"
                  value="<?= (isset($_SESSION['keywords']) ? $_SESSION['keywords'] : "") ?>" placeholder="Tìm kiếm"
                  aria-label="Tìm kiếm" aria-describedby="basic-addon-search31" />
              </div>

            </form>
          </div> -->
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead class="table-light">
                <tr>
                  <th style="width: 15px">Id</th>
                  <th>Tên ngân hàng</th>
                  <th>Tên tài khoản</th>
                  <th>Số tài khoản</th>
                  <th>Mã ngân hàng</th>
                  <th>Trạng thái</th>
                  <th>Tùy chỉnh</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <?php
                foreach ($data as $item):
                  ?>
                  <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['account_name'] ?></td>
                    <td><?= $item['account_number'] ?></td>
                    <td><?= $item['bank_code'] ?></td>
                    <td>
                      <?php
                      Table::status($item );
                      ?>
                    </td>
                    <td>
                      <?php
                        Table::edit_update(url: 'banks', item: $item['id']);
                      ?>
                    </td>
                  </tr>
                  <?php
                endforeach;


                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!--/ Basic Bootstrap Table -->

        <hr class="my-12" />

        <!-- Bootstrap Dark Table -->

        <!--/ Bootstrap Dark Table -->
      </div>


      <?php
  }
}
