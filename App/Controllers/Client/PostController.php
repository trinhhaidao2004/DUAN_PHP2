<?php

namespace App\Controllers\Client;

use App\Models\Post;
use App\View\Client\Layout\Footer;
use App\View\Client\Layout\Header;
use App\View\Client\Page\PostSingle;
use App\View\Client\Component\Notification;
use App\Helpers\NotificationHelper;
use App\View\Client\Page\Post as PagePost;

class PostController
{
    public static function index()
    {
        $post = new Post();
        $data = $post->getAll(operator: '=',int: 1);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        PagePost::render($data);
        Footer::render();
    }
    public static function detal($id)
    {
       // echo 'mnujuh9h';
        $post = new Post();
        $data = $post->getOne($id);
        //var_dump($data);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        PostSingle::render( $data);
        Footer::render();
    }
}

