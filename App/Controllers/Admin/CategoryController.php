<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\View\Admin\Layout\Footer;
use App\View\Admin\Page\Category\Index;
use App\View\Admin\Page\Category\Add;
use App\View\Admin\Page\Category\Edit;
use App\View\Admin\Layout\Header;
use App\Helpers\NotificationHelper;
use App\Validations\CategoryValidation;

use App\View\Admin\Component\Notification;

class CategoryController
{
    public static function index()
    {
        $category = new Category();
        $data = $category->getAllCategory('!=',2);
    //   var_dump($data);
    //   die;
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }
    public static function add()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Add::render();
        Footer::render();
    }
    public static function addAction()
    {
        $is_valid = CategoryValidation::create();
        if (!$is_valid) {
            NotificationHelper::error('store_category', 'Thêm danh mục thất bại');
            header('location: /admin/categories/create');
            exit;
        }
        $name = $_POST['name'];
        $category = new Category();
        $is_exist = $category->getOneCategoryByName($name);
        if ($is_exist) {
            NotificationHelper::error('store_category2', 'Tên sản phẩm này đã tồn tại');
            header('location: /admin/categories/create');
            exit;
        }
        $data = [
            'name' => $name,
            'description' => $_POST['description'],
        ];
       
        $result = $category->createCategory($data);
        // var_dump($result);
        // die;
        if ($result) {
            NotificationHelper::success('create_category', 'Thêm danh mục thành công');
            header('location: /admin/categories');
        } else {
            NotificationHelper::error('create_category', 'Thêm danh mục thất bại');
            header('location: /admin/categories/create');
            exit;
        }
    }
    public static function edit($id)
    {
        $category = new Category();
        $data = $category->getOne($id);
        // var_dump($data);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Edit::render( $data);
        Footer::render();
    }
    public static function update($id)
    {
        $is_valid = CategoryValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('store_category', 'Cập nhật danh mục thất bại');
            header('location: /admin/categories/create');
            exit;
        }
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
        ];
        $name = $_POST['name'];
        $category = new Category();
        $is_exist = $category->getOneCategoryByName($name);
        if ($is_exist && $is_exist['id'] != $id) {
            NotificationHelper::error('update_product', 'Tên loại sản phẩm đã tồn tại!');
            header("Location: /admin/categories");
            exit();
        }
        $result = $category->updateCategory($id,$data);
        // var_dump($result);
        // die;
        if ($result) {
            NotificationHelper::success('create_category', 'Cập nhật danh mục thành công');
            header('location: /admin/categories');
        } else {
            NotificationHelper::error('create_category', 'Cập nhật danh mục thất bại');
            header('location: /admin/categories/edit'.$id);
            exit;
        }
    }

}