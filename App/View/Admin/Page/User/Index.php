<?php
namespace App\View\Admin\Page\User;

use App\View\Admin\Component\User\IndexTrashCan;
use App\View\View;

class Index extends View
{

    use IndexTrashCan;
    public static function render($data = [])
    {
        self::content($data);
    }
}