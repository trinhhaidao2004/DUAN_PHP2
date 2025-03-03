<?php


namespace App\View\Admin\Component\User;

use App\View\Admin\Component\Form;

trait Index
{
    public static function Form($title, $url = null, $submit = "", $data = [])
    {
        ?>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row g-6 mb-6">
                    <!-- Basic -->
                    <div class="col-md-12">
                        <form action="<?= $url ?>" id="" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <h5 class="card-header"><?= $title ?></h5>
                                <div class="card-body demo-vertical-spacing demo-only-element">
                                    <?php
                                    Form::input(name: 'name', placeholder: 'họ và tên', label: 'Họ và tên', value: $data['name'] ?? '',id: $data['id'] ?? '');
                                    Form::input(name: 'username', placeholder: 'tên đăng nhập', label: 'Tên đăng nhập', value: $data['username'] ?? '',id: $data['id'] ?? '');
                                    Form::input(name: 'phone', placeholder: 'số điện thoại', label: 'Số điện thoại', value: $data['phone'] ?? '',id: $data['id'] ?? '');
                                    Form::input(name: 'email', type: 'email', placeholder: 'email', label: 'Email', value: $data['email'] ?? '',id: $data['id'] ?? '');
                                    Form::password(label: 'Mật khẩu', name: 'password',id: $data['id'] ?? '');
                                    Form::password(label: 'Nhập lại mật khẩu', name: 're_password',id: $data['id'] ?? '');
                                    // Form::select_is_featured(data: $data['role'] ?? '',name:'role',title: 'Phân quyền', item: ['0' => 'Quản trị viên', '1' => 'Khách hàng']);
                                    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                    if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users/create') {
                                        // Form::select(name:'role',title: 'Phân quyền', data: ['0' => 'Quản trị viên', '1' => 'Khách hàng']);
                                        Form::image(name: 'avatar', value: $data['avatar'] ?? '');
                                        Form::textarea(name: 'adress', placeholder: 'Vui lòng nhập địa chỉ', value: $data['adress'] ?? '', label: 'Địa chỉ');
                                        Form::button($submit);
                                    }
                                   
                                   
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Merged -->

                    <!-- Sizing -->

                    <!-- Checkbox and radio addons -->

                </div>
            </div>
        </div>
        <?php
    }

}

