<?php
namespace App\View\Admin\Page\Product;

use App\View\Admin\Component\Product\Index as Add_Product;

class Add
{
    use Add_Product;
    public static function render($data = null)
    {
       self::Form(url:'/admin/products/create',title:'Thêm sản phẩm',submit:'Thêm',data:$data);
    }
}