<?php
namespace App\View\Admin\Page\Product;

use App\View\Admin\Component\Product\Index as Edit_Product;
use App\View\View;

class Edit  extends View
{
    use Edit_Product;
    public static function render($data = [])
    {
       
       self::Form(url:'/admin/products/update/'.$data['products']['id'],title:'Sửa sản phẩm',submit:'Cập nhật',data: $data);
    }
}