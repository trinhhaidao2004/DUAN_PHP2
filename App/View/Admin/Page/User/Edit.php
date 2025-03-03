<?php
namespace App\View\Admin\Page\User;

use App\View\Admin\Component\User\Index as Add_User;

class Edit
{
    use Add_User;
    public static function render($data = null)
    {
       self::Form(url:'/admin/users/update/'.$data['id'],title:'Chi tiết người dùng',submit:'Cập nhật',data:$data);
    }
}