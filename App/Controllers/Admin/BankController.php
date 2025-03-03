<?php

namespace App\Controllers\Admin;
use App\Views\Admin\Pages\Auth\Login;
use App\View\Admin\Layout\Footer;
use App\View\Admin\Layout\Header;
use App\View\Admin\Component\Notification;
use App\Helpers\NotificationHelper;
use App\Models\Bank;
use App\Validations\BankValidation;
use App\View\Admin\Page\Bank\Create;
use App\View\Admin\Page\Bank\index;
use App\Validations\ProductValidation;
use App\View\Admin\Page\Bank\Edit;
use App\Helpers\AuthHelper;

class BankController
{
    public static function index()
    {
       // AuthHelper::checkPermission([0, 5]);
        $bank = new Bank();
        $data = $bank->getAll();
        // var_dump($data);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }
    public static function add()
    {

       // AuthHelper::checkPermission([0, 5]);
        // var_dump($data);
       // echo 'fjghu8y8uy  ';
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }
    public static function store()
    {
       
        $is_valid = BankValidation::create();

        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
           
            header('location: /admin/banks/create');
            exit;
        }
        $data = [
            'name' => $_POST['name'],
            'account_name' => $_POST['account_name'],
            'account_number' => $_POST['account_number'],
            'bank_code' => $_POST['bank_code'],
            'status' => $_POST['status'],
        ];
        
        $bank = new Bank();
        $result = $bank->create($data);

        if ($result) {
            NotificationHelper::success('create_product', 'Thêm ngân hàngm thành công');
            header('location: /admin/banks');
        } else {
            NotificationHelper::error('create_product', 'Thêm ngân hàng thất bại');
            header('location: /admin/banks/create');
            exit;
        }
    }

    public static function edit($id)
    {

        $bank = new Bank();
        $data = $bank->getOne($id);
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        Edit::render($data);
        Footer::render();
    }
    public static function update($id)
    {
        $is_valid = BankValidation::create();
        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header("location: /admin/banks/$id");
            exit;
        }
        $data = [
            'name' => $_POST['name'],
            'account_name' => $_POST['account_name'],
            'account_number' => $_POST['account_number'],
            'bank_code' => $_POST['bank_code'],
            'status' => $_POST['status'],
        ];
        $bank = new Bank();
        $result = $bank->updateBank ($id,$data);
        if ($result) {
            NotificationHelper::success('update_products', 'Cập nhật sản phẩm thành công!');
            header('Location: /admin/banks');
        } else {
            NotificationHelper::error('update_products', 'Cập nhật sản phẩm thất bại!');
            header("Location: /admin/banks/$id");
        }
    }
}