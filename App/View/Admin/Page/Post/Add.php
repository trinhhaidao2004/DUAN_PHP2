<?php
namespace App\View\Admin\Page\Post;

use App\View\Admin\Component\Post\Index as Add_Product;

class Add
{
    use Add_Product;
    public static function render($data = null)
    {
       
       self::Form(url: '/admin/posts/create', title:'Thêm bài viết',submit:'Thêm', data:$data);
    }
}