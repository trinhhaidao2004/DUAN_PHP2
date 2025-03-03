<?php
namespace App\View\Admin\Page\Order;

use App\View\Admin\Component\Order\Detail as DetailOrder;

class Detail
{
    use DetailOrder;
    public static function render($title = '', $data = [])
    {
        self::content(title: $title, data: $data);
    }
}