<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\View\Admin\Layout\Footer;
use App\View\Admin\Page\Post\Index;
use App\View\Admin\Page\Post\Add;
use App\View\Admin\Page\Post\Edit;
use App\View\Admin\Layout\Header;
use App\Helpers\NotificationHelper;
use App\Validations\PostValidation;
use App\Validations\ProductValidation as PostValidationImage;
use App\View\Admin\Component\Notification;

class PostController
{
    public static function index()
    {
        $post = new Post();
        $data = $post->getAll();
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
        $is_valid = PostValidation::create();
        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/posts/create');
            exit;
        }
       
        $post = new Post();
        $data = [
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'summary' => $_POST['summary'],
            'content' => $_POST['content'],
        ];
        $is_upload = PostValidationImage::updateImage();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        // var_dump($data);
        // die;
        $result = $post->createPost($data);
        if ($result) {
            NotificationHelper::success('create_product', 'Thêm bài viết thành công');
            header('location: /admin/posts');
        } else {
            NotificationHelper::error('create_product', 'Thêm bài viết thất bại');
            header('location: /admin/posts/create');
            exit;
        }
    }
    public static function edit($id)
    {
        $post = new Post();
        $data = $post->getOne($id);
        Header::render();
        Edit::render($data);
        Footer::render();
    }

    public static function update($id)
    {
        $is_valid = PostValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/posts/create');
            exit;
        }
        $post = new Post();
        $data = [
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'summary' => $_POST['summary'],
            'content' => $_POST['content'],
        ];
        $is_upload = PostValidationImage::updateImage();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        // var_dump($data);
        // die;
        $result = $post->updatePost($id,$data);
        if ($result) {
            NotificationHelper::success('create_product', 'Thêm bài viết thành công');
            header('location: /admin/posts');
        } else {
            NotificationHelper::error('create_product', 'Thêm bài viết thất bại');
            header('location: /admin/posts/edit/'.$id);
            exit;
        }
    }
}