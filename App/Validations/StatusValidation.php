<?php

namespace App\Validations;


use App\Models\Bank;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Helpers\NotificationHelper;

class StatusValidation
{


    public static function model($id, $url, $data = [],$pages= null)
    {
        // $currentPage = $_GET['pages'];
        // $currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
        // var_dump($pages);
        // die;
        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products?pages=' . $pages) {
            $products = new Product();
            $return = $products->update($id, $data);
        } else if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories' || $url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/categories?pages=' . $pages) {
            $categories = new Category();
            $return = $categories->update($id, $data);
        } elseif ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/posts') {
            $posts = new Post();
            $return = $posts->update($id, $data);
        } elseif ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users') {
            $users = new User();
            $return = $users->update($id, $data);
        }elseif ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/banks') {
            $users = new Bank();
            $return = $users->update($id, $data);
        }
         return $return;
    }
    public static function updateStatus($url, $id, $data_status, $model, $success_error)
    {
        if ($data_status !== 2) {
            $data = [
                'status' => 2,
            ];
            $result = $model->update($id, $data);
            if ($result) {
                NotificationHelper::success('create_product', 'Xóa ' . $success_error . ' thành công');
                header('location: /admin/' . $url);
            } else {
                NotificationHelper::error('create_product', 'Xóa ' . $success_error . ' thất bại');
                header('location: /admin/' . $url);
                exit;
            }
        } else {
            $data = [
                'status' => 1,
            ];
            $result = $model->update($id, $data);
            if ($result) {
                NotificationHelper::success('create_product', 'Khôi phục ' . $success_error . ' thành công');
                header('location: /admin/trashcan/' . $url);
            } else {
                NotificationHelper::error('create_product', 'Khôi phục ' . $success_error . ' thất bại');
                header('location: /admin/trashcan/' . $url);
                exit;
            }
        }
    }
    public static function delete($url, $id, $model, $success_error)
    {
        $result = $model->delete($id);
        if ($result) {
            NotificationHelper::success('create_product', 'Xóa ' . $success_error . ' thành công');
            header('location: /admin/trashcan/' . $url);
        } else {
                NotificationHelper::error('create_product', 'Xóa ' . $success_error . ' thất bại');
                header('location: /admin/trashcan/' . $url);
                exit;
           

        }

    }
}




