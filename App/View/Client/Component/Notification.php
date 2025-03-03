<?php

namespace App\View\Client\Component;

use App\View\View;

class Notification extends View
{
    public static function render($data = null)
    {
        if (isset($_SESSION['success'])):
            foreach ($_SESSION['success'] as $key => $value):
                ?>
                <div class="container w-50">
                    <div class="alert alert-success alert-dismissible" id="eroor">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?= $value ?></strong>
                    </div>
                </div>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        if (isset($_SESSION['error'])):
            foreach ($_SESSION['error'] as $key => $value):
                ?>
                <div class="container w-50">
                    <div class="alert alert-danger alert-dismissible" id="eroor">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?= $value ?></strong>
                    </div>
                </div>

                <?php
            endforeach;

        endif;
    }
}

?>