<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\View\Admin\Layout\Footer;
use App\View\Admin\Index;
use App\View\Admin\Layout\Header;
use App\View\Admin\Page\NotFound;

class HomeController
{
    public static function index()
    {
        $user = new User();
        $total_user = $user->countTotalUser();
        //var_dump( $total_user);
        $product = new Product();
        $total_product = $product->countTotalProduct();
        $product_by_category = $product->countProductByCategory();
        $product_view = $product->getTopViewedProducts();
        $category = new Category();
        $total_category = $category->countTotalCategory();
        $comment = new Comment();
        $total_comment = $comment->countTotalComment();
        $comment_by_product = $comment->countCommentByProduct();

        $data = [
            'total_user' => $total_user['total'],
            'total_product' => $total_product['total'],
            'total_category' => $total_category['total'],
            //'total_comment' => $total_comment['total'],
            'product_by_category' => $product_by_category,
            'comment_by_product' => $comment_by_product,
            'product_view' => $product_view,
        ];
        Header::render();
        Index::render($data );
        Footer::render();
    }
    
    public static function statistical()
    {
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $subdays = intval($date);
        $order = new Order();
        $data = $order->StatisticalOrder($subdays);
       // var_dump($data);
        echo $data = json_encode($data);
    }
}

