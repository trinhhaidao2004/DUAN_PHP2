<?php


namespace App\View\Admin\Component\Product;

use App\View\Admin\Component\Form;

trait Index
{
    public static function Form($title, $url = null, $submit = "", $data = [])
    {

        $data_products = $data['products'] ?? '';
        $data_categories = $data['categories'] ?? '';
        $currentURL = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
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
                                    Form::input(name: 'name', placeholder: 'tên sản phẩm', label: 'Tên sản phẩm', value: $data_products['name'] ?? '');
                                    Form::input(name: 'price', placeholder: 'giá', label: 'Giá sản phẩm (VND)', value: $data_products['price'] ?? '');
                                    Form::input(name: 'discount_price', placeholder: 'giá', label: 'Giá giảm (VND)', value: $data_products['discount_price'] ?? '');
                                    Form::image(name: 'image', value: $data_products['image'] ?? '');
                                    if ($currentURL === 'http://'. $_SERVER['HTTP_HOST'] .'/admin/products/create') {
                                        Form::select(name: 'is_featured',title: 'Sản phẩm nổi bật', data: ['0' => 'Binh thường', '1' => 'Nổi bật ']);
                                        Form::select(name: 'age',title: 'Độ tuổi', data: ['0' => 'Từ 3 -> 12 tuổi', '1' => 'Từ 12 -> 18 tuổi', '2' => 'Từ 18 tuổi trở lên']);
                                        Form::select(name: 'category_id',title: 'Danh mục sản phẩm', data: $data_categories);
                                    }else{
                                        Form::select_is_featured(data: $data_products['is_featured'],item:['0' => 'Binh thường', '1' => 'Nổi bật '],name: 'is_featured',title: 'Sản phẩm nổi bật' );
                                        Form::select_is_featured(data: $data_products['age'],item:['0' => 'Từ 3 -> 12 tuổi', '1' => 'Từ 12 -> 18 tuổi', '2' => 'Từ 18 tuổi trở lên'],name: 'age',title: 'Độ tuổi' );
                                        Form::select_category(title: 'Danh mục sản phẩm', data: $data);
                                    }
                                    Form::textarea(name: 'description', placeholder: 'Vui lòng nhập mô tả', value: $data_products['description'] ?? '');
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

