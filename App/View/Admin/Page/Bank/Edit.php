<?php

namespace App\View\Admin\Page\Bank;

use App\View\View;

class Edit extends View
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
                            
                            <div class="card-body">
                                <div class="">
                                    <h2 class="text-center">Sửa thông tin ngân hàng </h2>
                                </div>
                            </div>
                            <div class="card-body pt-4">
                                <form action="/admin/banks/<?=$data['id']?>" id="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="method" id="" value="PUT">
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Tên ngân hàng<span class="text-danger">
                                                    *</span></label>
                                            <input class="form-control" type="text" id="name" name="name" value="<?=$data['name']?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Tên tài khoản<span class="text-danger">
                                                    *</span></label>
                                            <input class="form-control" type="text" id="name" name="account_name" value="<?=$data['account_name']?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Số tài khoản<span class="text-danger">
                                                    *</span></label>
                                            <input class="form-control" type="text" value="<?=$data['account_number']?>" name="account_number"
                                                 />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="bank_code"> Ngân hàng <span class="text-danger">
                                                    *</span></label>
                                            <select id="status" name="bank_code" class="select2 form-select">
                                                <option value="">Chọn ngân hàng </option>
                                                <option value="970436" <?php if ($data['bank_code'] == 970436) echo 'selected="selected"'; ?>>Vietcombank</option>
                                                <option value="970423" <?php if ($data['bank_code'] == 970423) echo 'selected="selected"'; ?>>TPBank</option>
                                                <option value="970403" <?php if ($data['bank_code'] == 970403) echo 'selected="selected"'; ?>>Sacombank</option>
                                                <option value="970422" <?php if ($data['bank_code'] == 970422) echo 'selected="selected"'; ?>>MBBank</option>
                                                <option value="970422" <?php if ($data['bank_code'] == 970407) echo 'selected="selected"'; ?>>Techcombank</option>
                                            </select>
                                        </div>
                                       
                                        <div class="mt-6">
                                            <button type="submit" class="btn btn-primary me-3" name>Cập nhật</button>
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