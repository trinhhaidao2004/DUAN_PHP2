<?php
namespace App\View\Admin\Page\Category;

use App\View\Admin\Component\Category\Index as Edit_Category;
use App\View\View;

class Edit extends View
{
    use Edit_Category;
    public static function render($data = [])
    {
       self::Form(url:'/admin/categories/update/'.$data['id'],title:'Sửa danh mục',submit: 'Cập nhật', data: $data);
    }
}