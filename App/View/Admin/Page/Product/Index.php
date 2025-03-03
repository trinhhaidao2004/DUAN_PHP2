<?php
namespace App\View\Admin\Page\Product;

use App\View\Admin\Component\Product\IndexTrashCan ;

class Index
{

   use IndexTrashCan;
    public static function render($data = [])
    {
        self::content($data);
    }
}