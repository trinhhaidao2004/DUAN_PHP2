<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class CategoryValidation {

 public static function create(){
  $is_valid = true;

  // Tên đăng nhập
  if (!isset($_POST['name']) || $_POST['name'] === '') {
   NotificationHelper::error('name', 'Không để trống tên danh mục');
   $is_valid = false;
  }

  if (!isset($_POST['description']) || $_POST['description'] === '') {
   NotificationHelper::error('description', 'Không để trống mô tả');
   $is_valid = false;
  } 

  return $is_valid;
 }

 public static function edit(){
  return self::create();
 }
}