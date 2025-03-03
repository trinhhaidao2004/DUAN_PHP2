<?php
namespace App\View\Admin\Page\Order;

use App\View\Admin\Component\Order\Index as IndexOrder;

class Index
{
    use IndexOrder;
    public static function render($title = '', $data = [])
    {
        self::content(title: $title, data: $data);
    }
}