<?php

namespace App\Controllers\Client;

use App\Models\Category;
use App\View\Client\Layout\Footer;
use App\View\Client\Product\Index;
use App\View\Client\Layout\Header;
use App\View\Client\Product\ProductDetails;
use App\Models\Product;
use App\View\Client\Component\Notification;
use App\Helpers\NotificationHelper;
use App\View\Client\Component\Product as ComponentProduct;

class ProductController
{
    public static function index()
    {
        $product = new Product();
        $category = new Category();
        $data = [
            'products' => $product->getAllProduct(6),
            'categories' => $category->getAll('status', '=', 1) // Lấy tất cả danh mục sản phẩm trạng thái 1
        ];
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }
    public static function detail($id)
    {
        $product = new Product();
        $category = new Category();
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $data = [
            'products' => $product->getOneProduct($id),
            'products_limit' => $product->getAllLimit(),
            'categories' => $category->getAll('status', '=', 1) // Lấy tất cả danh mục sản phẩm trạng thái 1
        ];
        if ($data['products'] == false){
            header('Location: /notfound');
        }else{
            Header::render();
            ProductDetails::render($data);
            Footer::render();
            
        }
        
    }
   
}


