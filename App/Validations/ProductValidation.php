<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class ProductValidation
{

    public static function create()
    {

        $is_valid = true;
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        // Tên đăng nhập
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Không để trống tên');
            $is_valid = false;
        }

        // giá tiền
        if (!isset($_POST['price']) || $_POST['price'] === '') {
            NotificationHelper::error('price', 'Không để trống giá tiền');
            $is_valid = false;
        } else if ((int) $_POST['price'] <= 0) {
            NotificationHelper::error('price', 'Giá tiền phải lớn hơn 0');
            $is_valid = false;
        }
        // bắt lỗi ảnh ở trang thêm còn trang edit thì không
        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/products/create') {
            if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
                NotificationHelper::error('image', 'Vui lòng chọn một hình ảnh.');
                $is_valid = false;
            }
        }
        if (!isset($_POST['age']) || $_POST['age'] === '') {
            NotificationHelper::error('age', 'Không để trống độ tuổi');
            $is_valid = false;
        }
        // Loại sản phẩm
        // if (!isset($_POST['category_id']) || $_POST['category_id'] === '') {
        //     NotificationHelper::error('category_id_Product', 'Không được để trống danh mục sản phẩm!');
        //     $is_valid = false;
        // }
        // Nổi bật
        if (!isset($_POST['is_featured']) || $_POST['is_featured'] === '') {
            NotificationHelper::error('is_featured', 'Không để trống nổi bật');
            $is_valid = false;
        }
        // Mật khẩu
        if (!isset($_POST['description']) || $_POST['description'] === '') {
            NotificationHelper::error('status', 'Không để trống mô tả');
            // var_dump($_POST['status']);
            $is_valid = false;
        }

        return $is_valid;
    }

    public static function edit()
    {
        return self::create();
    }
    public static function updateImage($inputName = 'image')
    {
        if (!isset($_FILES[$inputName]) || !file_exists($_FILES[$inputName]['tmp_name']) || !is_uploaded_file($_FILES[$inputName]['tmp_name'])) {
            return false;
        }
        // Thư mục lưu file ảnh
        $target_dir = 'public/Client/assets/images/home/';
        // Kiểm tra loại file có hợp lệ không
        $imageFileType = strtolower(pathinfo(basename($_FILES[$inputName]['name']), PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($imageFileType, $allowedTypes)) {
            NotificationHelper::error('type_upload', 'Chỉ chấp nhận file ảnh JPG, JPEG, PNG, GIF, WEBP');
            return false;
        }

        // Đặt tên file mới theo thời gian để tránh trùng lặp
        $nameImage = date('YmdHis') . '.' . $imageFileType;

        // Đường dẫn đầy đủ file 
        $target_file = $target_dir . $nameImage;

        if (!move_uploaded_file($_FILES[$inputName]['tmp_name'], $target_file)) {
            NotificationHelper::error('move_upload', 'Không thể tải ảnh vào trong thư mục lưu trữ');
            return false;
        }

        return $nameImage;
    }
}
