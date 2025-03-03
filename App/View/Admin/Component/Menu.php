<?php
namespace App\View\Admin\Component;

class Menu
{


    public static function hmenu($url = null, $class_a = 'menu-link menu-toggle', $class_icon = null, $label = null)
    {
        ?>
        <a href="<?= $url ?>" class="<?= $class_a ?>">
            <i class="<?= $class_icon ?>"></i>
            <div class="text-truncate" data-i18n="Layouts"><?= $label ?></div>
        </a>
        <?php
    }
    public static function vmenu($url = null, $label = null,$path_url = null)
    {
        $url_ = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $path = parse_url($url_, PHP_URL_PATH); 
        ?>
        <li class="menu-item <?= ($path == $path_url) ? ' active ' : '' ?>">
            <a href="<?= $url ?>" class="menu-link" >
                <div class="text-truncate" data-i18n="Without menu"><?= $label ?></div>
            </a>
        </li>
        <?php

    }
}