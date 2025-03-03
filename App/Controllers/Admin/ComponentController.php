<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Validations\StatusValidation;
use App\Validations\StatusValidation as Delete;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;

class ComponentController
{
    public static function updateStatusCheckout()
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $intId = intval($id);
        $intStatus = intval($status);
        $pages = isset($_POST['pages']) ? $_POST['pages'] : '';
        // update trạng thái đơn hàng
        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/orders/trascan/1') {
            if ($intStatus == 1) {
                $data = [
                    'orderStatus' => 2,
                ];
                $order = new Order();
                $result = $order->update($intId, $data);
                if ($result) {
                   exit();
                }
            }
        }
        if ( $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/orders/trascan/6') {
            if ($intStatus == 6 ) {
                $data = [
                    'orderStatus' => 1,
                ];
                $order = new Order();
                $result = $order->update($intId, $data);
                if ($result) {
                   exit();
                }
            }
        }
        // update trạng thái sp , danh mục .....
        // var_dump($pages);
        // die;
        if ($intStatus == 1) {
            $data = [
                'status' => 0,
            ];
            StatusValidation::model($intId, $url, $data, $pages);
        } else {
            $data = [
                'status' => 1,
            ];
            StatusValidation::model($intId, $url, $data, $pages);
        }
    }

    public static function deleteItem($id)
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products/delete/' . $id) {
            $products = new Product();
            $result = $products->productsInnerJionOrderDetail($id);
            if ($result) {
                NotificationHelper::error('products_orderdetail', 'Sản phẩm đã có trong các đơn hàng không thể xóa');
                header('location: /admin/products');
                exit();
            }
            $data = $products->getOne($id);
            StatusValidation::updateStatus(url: 'products', id: $id, data_status: $data['status'], model: $products, success_error: 'sản phẩm');
        } else if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories/delete/' . $id) {
            $categories = new Category();
            $result = $categories->getAllCategory($id);
            if ($result) {
                NotificationHelper::error('products_orderdetail', 'Sản phẩm đã có trong các đơn hàng không thể xóa');
                header('location: /admin/products');
                exit();
            }
            $data = $categories->getOne($id);
            StatusValidation::updateStatus(url: 'categories', id: $id, data_status: $data['status'], model: $categories, success_error: 'danh mục');
        } elseif ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/posts/delete/' . $id) {
            $posts = new Post();
            $data = $posts->getOne($id);
            StatusValidation::updateStatus(url: 'posts', id: $id, data_status: $data['status'], model: $posts, success_error: 'bài viết');
        } elseif ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users/delete/' . $id) {
            $users = new User();
            $data = $users->getOne($id);
            StatusValidation::updateStatus(url: 'users', id: $id, data_status: $data['status'], model: $users, success_error: 'người dùng');
        }

    }
    public static function delete($id)
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products/delete/model/' . $id) {
            $model = new Product();
            //$data = $model->getOne($id);
            Delete::delete(url: 'products', id: $id, model: $model, success_error: 'sản phẩm');
        } else if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories/delete/model/' . $id) {
            $model = new Category();
            Delete::delete(url: 'categories', id: $id, model: $model, success_error: 'danh mục');
        } elseif ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/posts/delete/model/' . $id) {
            $model = new Post();
            Delete::delete(url: 'posts', id: $id, model: $model, success_error: 'bài viết');
        } elseif ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users/delete/model/' . $id) {
            $model = new User();
            Delete::delete(url: 'users', id: $id, model: $model, success_error: 'người dùng');
        }
    }
}