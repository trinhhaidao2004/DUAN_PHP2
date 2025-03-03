<?php
namespace App\View\Admin\Page\Post;

use App\View\Admin\Component\Post\IndexTrashCan ;
use App\View\View;


class Index extends View
{

    use IndexTrashCan;
    public static function render($data = [])
    {
        self::content($data);
    }
}