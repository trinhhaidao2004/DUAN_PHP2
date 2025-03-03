<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class PostValidation
{

  public static function create()
  {
    $is_valid = true;
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // Tên đăng nhập
    if (!isset($_POST['title']) || $_POST['title'] === '') {
      NotificationHelper::error('title', 'Không để trống tiêu đề');

      $is_valid = false;
    }
    if ($url === 'http://'. $_SERVER['HTTP_HOST'] .'/admin/posts/create') {
      if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        NotificationHelper::error('image', 'Vui lòng chọn một hình ảnh.');
        $is_valid = false;
      }
    }
    if (!isset($_POST['summary']) || $_POST['summary'] === '') {
      NotificationHelper::error('summary', 'Không để trống mô tả ngắn');

      $is_valid = false;
    }

    if (!isset($_POST['content']) || $_POST['content'] === '') {
      NotificationHelper::error('content', 'Không để trống mô tả');

      $is_valid = false;
    }
    return $is_valid;
  }

  public static function edit()
  {
    return self::create();

  }







  public static function uploadImage()
  {
    if (!file_exists($_FILES['img']['tmp_name']) || (!is_uploaded_file($_FILES['img']['tmp_name']))) {
      return false;
    }

    /// Nơi lưu trữ hình ảnh trong source code
    $target_dir = 'public/uploads/posts/';

    // Kiểm tra loại file upload có hợp lệ hay không
    $imageFileType = strtolower(pathinfo(basename($_FILES['img']['name']), PATHINFO_EXTENSION));

    if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
      NotificationHelper::error('type', 'Chỉ nhận file ảnh JPG, PNG, JPEG, GIF');
    }

    // thay đổi tên file thành dạng năm tháng ngày giờ
    $nameImage = date('YmdHmi') . '.' . $imageFileType;

    // đường dẫn đầy đủ để chuyển file
    $target_file = $target_dir . $nameImage;

    if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
      NotificationHelper::error('move_upload', 'Không thể tải ảnh về thư mục lưu trữ');
      return false;
    }

    return $nameImage;
  }

}