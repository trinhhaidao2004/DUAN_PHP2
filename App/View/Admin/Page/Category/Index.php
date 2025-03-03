<?php
namespace App\View\Admin\Page\Category;


use App\View\Admin\Component\Category\IndexTrashCan;
use App\View\View;

class Index extends View
{
    use IndexTrashCan;
    public static function render($data = [])
    {
        self::content($data );
    }
}