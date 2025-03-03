<?php

namespace App\Controllers\Client;

use App\View\Client\Layout\Footer;
use App\View\Client\Page\Contact;
use App\View\Client\Component\Notification;
use App\Helpers\NotificationHelper;

use App\View\Client\Layout\Header;


class ConTactController
{
    public static function index()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Contact::render();
        Footer::render();
    }
   
}

