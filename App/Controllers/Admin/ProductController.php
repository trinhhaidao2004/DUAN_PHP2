<?php

namespace App\Controllers\Admin;

use App\View\Admin\Layout\Footer;
use App\View\Admin\Page\Product\Index;
use App\View\Admin\Page\Product\Add;
use App\View\Admin\Page\Product\Edit;
use App\View\Admin\Layout\Header;
use App\Models\Product;
use App\Helpers\NotificationHelper;
use App\View\Admin\Component\Notification;
use App\Models\Category;
use App\Validations\ProductValidation;
use App\Validations\StatusValidation;


class ProductController
{
    public static function index()
    {
        $product = new Product();
        $data = $product->getAllProductAdmin();
        // echo '<pre>';
        // var_dump($data['products']);
        // die;
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }
    public static function add()
    {
        $categories = new Category();
        $data_categorys = $categories->getAllCategoryByStatus();
        $data = [
            'categories' => $data_categorys
        ];
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Add::render($data);
        Footer::render();
    }
    public static function addAction()
    {
        $is_valid = ProductValidation::create();
        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
            exit;
        }
        $name = $_POST['name'];
        $product = new Product();
        $is_exist = $product->getOneByName('name', $name);
        if ($is_exist) {
            NotificationHelper::error('store_product2', 'Tên sản phẩm này đã tồn tại');
            header('location: /admin/products/create');
            exit;
        }
        if (!isset($_POST['discount_price']) || $_POST['discount_price'] === '') {
            $_POST['discount_price'] = 0;
        }
        
        $data = [
            'name' => $name,
            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'description' => $_POST['description'],
            'is_featured' => $_POST['is_featured'],
            'age' => $_POST['age'],
            'category_id' => $_POST['category_id'],
        ];
        $is_upload = ProductValidation::updateImage();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        $result = $product->create($data);
        // var_dump($result);
        // die;
        if ($result) {
            NotificationHelper::success('create_product', 'Thêm sản phẩm thành công');
            header('location: /admin/products');
        } else {
            NotificationHelper::error('create_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
            exit;
        }
    }
    public static function edit($id)
    {
        $product = new Product();
        $data_products = $product->getOne($id);
        $categories = new Category();
        $data_categorys = $categories->getAllCategoryByStatus();

        $data = [
            'products' => $data_products,
            'categories' => $data_categorys
        ];
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit::render($data);
        Footer::render();
    }
    public static function update($id)
    {
        $is_valid = ProductValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Cập nhật sản phẩm thất bại');
            header('location: /admin/products/edit/'.$id);
            exit;
        }
        $name = $_POST['name'];
        $product = new Product();
        $is_exist = $product->getOneByName('name', $name);
        if ($is_exist && $is_exist['id'] != $id) {
            NotificationHelper::error('update_product', 'Tên sản phẩm đã tồn tại!');
            header("Location: /admin/products");
            exit();
        }
        if (!isset($_POST['discount_price']) || $_POST['discount_price'] === "") {
            $_POST['discount_price'] = 0;
        } 
        $data = [
            'name' => $name,
            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'description' => $_POST['description'],
            'is_featured' => $_POST['is_featured'],
            'age' => $_POST['age'],
            'category_id' => $_POST['category_id'],
        ];
        // var_dump($data);
        // die();
        $is_upload = ProductValidation::updateImage();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        $result = $product->update($id,$data);
        if ($result) {
            NotificationHelper::success('create_product', 'Cập nhật sản phẩm thành công');
            header('location: /admin/products');
        } else {
            NotificationHelper::error('create_product', 'Cập nhật sản phẩm thất bại');
            header('location: /admin/products/edit/'.$id);
            exit;
        }
    }
}