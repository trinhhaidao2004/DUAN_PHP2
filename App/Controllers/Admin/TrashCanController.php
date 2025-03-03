<?php

namespace App\Controllers\Admin;

use App\Models\Product;
use App\View\Admin\Layout\Footer;
use App\View\Admin\Page\Product\Index;
use App\View\Admin\Page\Category\Index as Category;
use App\View\Admin\Page\Post\Index as Post;
use App\View\Admin\Page\User\Index as User;
use App\View\Admin\Layout\Header;
use App\View\Admin\Component\Notification;
use App\Helpers\NotificationHelper;
use App\Models\Category as ModelsCategory;
use App\Models\Post as ModelsPost;
use App\Models\User as ModelsUser;

class TrashCanController
{
    public static function product()
    {
        $product = new Product();
        $data = $product->getAllProductAdmin('=',2);
        // var_dump($data);
        // die;
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }
    public static function category()
    {
        $category = new ModelsCategory();
        $data = $category->getAllCategory('=',2);
        // var_dump($data);
        // die;
        Header::render();
        Category::render($data);
        Footer::render();
    }
    public static function post()
    {
        $post = new ModelsPost();
        $data = $post->getAll_Admin_TrashCan();
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Post::render($data);
        Footer::render();
    }
    public static function user()
    {
        $user = new ModelsUser();
        $data = $user->getAll_Admin_TrashCan();
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        User::render($data);
        Footer::render();
    }
}