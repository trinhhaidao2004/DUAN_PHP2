<?php

namespace App\View\Admin\Page\Bank;

use App\View\View;

class Create extends View
{
    public static function render($data = null)
    {
        ?>
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-6">
                            <!-- Account -->
                            <div class="card-body">
                                <div class="">
                                    <h2 class="text-center">Thêm mới ngân hàng </h2>
                                </div>
                            </div>
                            <div class="card-body pt-4">
                                <form action="/admin/banks" id="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="method" id="" value="POST">
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Tên ngân hàng<span class="text-danger">
                                                    *</span></label>
                                            <input class="form-control" type="text" id="name" name="name"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Tên tài khoản<span class="text-danger">
                                                    *</span></label>
                                            <input class="form-control" type="text" id="account_name" name="account_name"  />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Số tài khoản<span class="text-danger">
                                                    *</span></label>
                                            <input class="form-control" type="text" id="account_number" name="account_number"
                                                autofocus />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="bank_code"> Ngân hàng <span class="text-danger">
                                                    *</span></label>
                                            <select id="status" name="bank_code" class="select2 form-select">
                                                <option value="">Chọn ngân hàng </option>
                                                <option value="970436">Vietcombank</option>
                                                <option value="970423">TPBank</option>
                                                <option value="970403">Sacombank</option>
                                                <option value="970422">MBBank</option>
                                                <option value="970407">Techcombank</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="status"> Trạng thái <span class="text-danger">
                                                    *</span></label>
                                            <select id="status" name="status" class="select2 form-select">
                                                <option value="">Chọn trang thái </option>
                                                <option value="1">Hoạt động </option>
                                                <option value="0">Không hoạt động </option>
                                            </select>
                                        </div>
                                        <div class="mt-6">
                                            <button type="" class="btn btn-primary me-3" name>Thêm</button>
                                            <button type="reset" class="btn btn-outline-secondary" name>Nhập lại</button>
                                        </div>
                                </form>
                            </div>
                            <!-- /Account -->
                        </div>
                    </div>
                </div>
            </div>
            <?php

    }
}