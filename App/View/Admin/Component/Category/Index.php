<?php


namespace App\View\Admin\Component\Category;

use App\View\Admin\Component\Form;

trait Index 
{
    public static function Form($title,$url = null, $submit = "", $data = [])
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
                                    Form::input(name: 'name', placeholder: 'tên danh mục', label: 'Tên danh mục', value: $data['name'] ?? '');
                                    Form::textarea(name:'description',placeholder: 'Vui lòng nhập mô tả', value: $data['description'] ?? '');
                                    Form::button($submit);
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

