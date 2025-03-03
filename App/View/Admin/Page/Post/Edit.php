<?php
namespace App\View\Admin\Page\Post;

use App\View\Admin\Component\Post\Index as Edit_Product;
use App\View\View;

class Edit extends View
{
    use Edit_Product;
    public static function render($data = [])
    {
       self::Form(url: '/admin/posts/update/'.$data['id'],title:'Sửa bài viêt',submit:'Cập nhật',data:$data);
    }
}