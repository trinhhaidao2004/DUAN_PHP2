<?php
namespace App\View\Admin\Page\Category;

use App\View\Admin\Component\Category\Index as Add_Category;

class Add
{
    use Add_Category;
    public static function render($data = null)
    {
       self::Form(url: '/admin/categories/create',title:'Thêm danh mục',submit:'Thêm',data:$data);
    }
}