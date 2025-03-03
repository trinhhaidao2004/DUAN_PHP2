<?php

namespace App\View\Admin\Component;

use App\View\View;

class Notification extends View
{
    public static function render($data = [])
    {
        if (isset($_SESSION['success'])):
            foreach ($_SESSION['success'] as $key => $value):
                ?>
                <div class="alert alert-success" id="alert" role="alert">
                    <?= $value ?>
                </div>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        if (isset($_SESSION['error'])):
            foreach ($_SESSION['error'] as $key => $value):
                ?>
                <div class="alert alert-danger" id="alert" role="alert">
                <?= $value ?>
                </div>
                <?php
            endforeach;

        endif;
    }
}

?>