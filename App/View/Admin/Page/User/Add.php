<?php
namespace App\View\Admin\Page\User;

use App\View\Admin\Component\User\Index as Add_User;

class Add
{
    use Add_User;
    public static function render($data = null)
    {
       self::Form(url:'/admin/users/create',title:'Thêm người dùng',submit:'Thêm');
    }
}