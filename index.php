<?php
ob_start();
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('error_log', './logs/php/php-errors.log');

use App\Router;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once 'config.php';

use App\Helpers\AuthHelper;

AuthHelper::middleware();
// *** Client
Router::get('/', ["controller" => "Client\\HomeController", "action" => "index"]);
Router::get('/products', ["controller" => "Client\\ProductController", "action" => "index"]);
Router::get('/products/details/{id}', ["controller" => "Client\\ProductController", "action" => "detail"]);
Router::get('/posts', ["controller" => "Client\\PostController", "action" => "index"]);
Router::get('/post/single/{id}', ["controller" => "Client\\PostController", "action" => "detal"]);
Router::get('/contact', ["controller" => "Client\\ConTactController", "action" => "index"]);

Router::get('/cart', ["controller" => "Client\\CartController", "action" => "index"]);
Router::post('/cart/add', ["controller" => "Client\\CartController", "action" => "add"]);
Router::post('/cart/update', ["controller" => "Client\\CartController", "action" => "update"]);
Router::post('/cart/delete', ["controller" => "Client\\CartController", "action" => "deleteItem"]);
Router::get('/checkout', ["controller" => "Client\\CartController", "action" => "checkout"]);
// đặt hàng 
Router::post('/order', ["controller" => "Client\\CartController", "action" => "order"]);
Router::get('/thanks', ["controller" => "Client\\HomeController", "action" => "thanks"]);
Router::get('/thanks/order', ["controller" => "Client\\HomeController", "action" => "thanksOrder"]);
Router::post('/cancel', ["controller" => "Client\\PaymentController", "action" => "updateOrder"]);
Router::get('/cancel/order/{id}', ["controller" => "Client\\PaymentController", "action" => "cancelOrder"]);

// thanh toán qua ví 
Router::post('/order/balance', ["controller" => "Client\\PaymentController", "action" => "OrderBalance"]);






Router::get('/account', ["controller" => "Client\\AuthController", "action" => "index"]);
Router::post('/register/new', ["controller" => "Client\\AuthController", "action" => "addRegister"]);
Router::post('/login', ["controller" => "Client\\AuthController", "action" => "loginAction"]);
// edit và update account
Router::get('/account/edit/{id}', ["controller" => "Client\\AuthController", "action" => "edit"]);
Router::post('/account/update/{id}', ["controller" => "Client\\AuthController", "action" => "updateAccount"]);

// edit và update password
Router::get('/account/password/{id}', ["controller" => "Client\\AuthController", "action" => "indexPassword"]);
Router::post('/account/update/password/{id}', ["controller" => "Client\\AuthController", "action" => "updatePassword"]);
Router::get('/account/trashcan/{id}', ["controller" => "Client\\AuthController", "action" => "indexTrashcan"]);
Router::post('/account/update/trashcan/{id}', ["controller" => "Client\\AuthController", "action" => "updateTrashcan"]);

// quên mật khẩu
Router::get('/forgetpass', ["controller" => "Client\\AuthController", "action" => "forgetPassword"]);
Router::post('/account/forgetpass/password', ["controller" => "Client\\AuthController", "action" => "forgetPasswordAction"]);
Router::get('/token', ["controller" => "Client\\AuthController", "action" => "token"]);
Router::post('/account/token/password', ["controller" => "Client\\AuthController", "action" => "forgetTokenAction"]);


// lịch sử đơn hàng
// lọc đơn hàng theo trạng thái
Router::post('/trashcan/select/order', ["controller" => "Client\\ComponentController", "action" => "selectOrderByStatus"]);
// chi tiết đơn 
Router::get('/trashcan/order/detail/{id}', ["controller" => "Client\\AuthController", "action" => "detailOrder"]);


Router::get('/login-google', ["controller" => "Client\\GoogleController", "action" => "loginGoogle"]);
Router::get('/login-googleAction', ["controller" => "Client\\GoogleController", "action" => "callbackGoogle"]);




//Admin
Router::get('/admin', ["controller" => "Admin\\HomeController", "action" => "index"]);

Router::post('/statistical', ["controller" => "Admin\\HomeController", "action" => "statistical"]);


Router::get('/admin/products', ["controller" => "Admin\\ProductController", "action" => "index"]);
Router::get('/admin/products/create', ["controller" => "Admin\\ProductController", "action" => "add"]);
Router::post('/admin/products/create', ["controller" => "Admin\\ProductController", "action" => "addAction"]);
Router::get('/admin/products/edit/{id}', ["controller" => "Admin\\ProductController", "action" => "edit"]);
Router::post('/admin/products/update/{id}', ["controller" => "Admin\\ProductController", "action" => "update"]);
Router::post('/admin/products/delete/{id}', ["controller" => "Admin\\ComponentController", "action" => "deleteItem"]);
Router::get('/admin/products/delete/model/{id}', ["controller" => "Admin\\ComponentController", "action" => "delete"]);




Router::get('/admin/categories', ["controller" => "Admin\\CategoryController", "action" => "index"]);
Router::get('/admin/categories/create', ["controller" => "Admin\\CategoryController", "action" => "add"]);
Router::post('/admin/categories/create', ["controller" => "Admin\\CategoryController", "action" => "addAction"]);
Router::get('/admin/categories/edit/{id}', ["controller" => "Admin\\CategoryController", "action" => "edit"]);
Router::post('/admin/categories/update/{id}', ["controller" => "Admin\\CategoryController", "action" => "update"]);
Router::post('/admin/categories/delete/{id}', ["controller" => "Admin\\ComponentController", "action" => "deleteItem"]);
Router::get('/admin/categories/delete/model/{id}', ["controller" => "Admin\\ComponentController", "action" => "delete"]);




Router::get('/admin/posts', ["controller" => "Admin\\PostController", "action" => "index"]);
Router::get('/admin/posts/create', ["controller" => "Admin\\PostController", "action" => "add"]);
Router::post('/admin/posts/create', ["controller" => "Admin\\PostController", "action" => "addAction"]);
Router::get('/admin/posts/edit/{id}', ["controller" => "Admin\\PostController", "action" => "edit"]);
Router::post('/admin/posts/update/{id}', ["controller" => "Admin\\PostController", "action" => "update"]);
Router::post('/admin/posts/delete/{id}', ["controller" => "Admin\\ComponentController", "action" => "deleteItem"]);
Router::get('/admin/posts/delete/model/{id}', ["controller" => "Admin\\ComponentController", "action" => "delete"]);



Router::get('/admin/users', ["controller" => "Admin\\UserController", "action" => "index"]);
Router::get('/admin/users/create', ["controller" => "Admin\\UserController", "action" => "add"]);
Router::post('/admin/users/create', ["controller" => "Admin\\UserController", "action" => "addAction"]);
Router::get('/admin/users/edit/{id}', ["controller" => "Admin\\UserController", "action" => "edit"]);
Router::post('/admin/users/update/{id}', ["controller" => "Admin\\UserController", "action" => "update"]);
// LỊCH SỬ MUA HÀNG
Router::get('/admin/user/order/{id}', ["controller" => "Admin\\UserController", "action" => "historyIndex"]);
Router::post('/handleOrderStatus', ["controller" => "Admin\\UserController", "action" => "historyOrderStatus"]);




Router::get('/admin/banks', ["controller" => "Admin\\BankController", "action" => "index"]);
Router::get('/admin/banks/create', ["controller" => "Admin\\BankController", "action" => "add"]);
Router::post('/admin/banks/create', ["controller" => "Admin\\BankController", "action" => "addAction"]);
Router::get('/admin/banks/edit/{id}', ["controller" => "Admin\\BankController", "action" => "edit"]);
Router::post('/admin/banks/update/{id}', ["controller" => "Admin\\BankController", "action" => "update"]);
Router::post('/admin/banks/delete/{id}', ["controller" => "Admin\\ComponentController", "action" => "deleteItem"]);
Router::get('/admin/banks/delete/model/{id}', ["controller" => "Admin\\ComponentController", "action" => "delete"]);



// udate trạng thái tài khoản usres
Router::post('/admin/users/delete/{id}', ["controller" => "Admin\\ComponentController", "action" => "deleteItem"]);
Router::get('/admin/users/delete/model/{id}', ["controller" => "Admin\\ComponentController", "action" => "delete"]);





// orrder ddang xuwr lis 
Router::get('/admin/orders/trascan/{id}', ["controller" => "Admin\\OrderController", "action" => "index"]);

Router::get('/admin/orders/confirmed', ["controller" => "Admin\\OrderController", "action" => "confirmed"]);


Router::get('/admin/orders/detail/{id}', ["controller" => "Admin\\OrderController", "action" => "detail"]);

// thùng rác 
Router::get('/admin/trashcan/products', ["controller" => "Admin\\TrashCanController", "action" => "product"]);
Router::get('/admin/trashcan/categories', ["controller" => "Admin\\TrashCanController", "action" => "category"]);
Router::get('/admin/trashcan/posts', ["controller" => "Admin\\TrashCanController", "action" => "post"]);
Router::get('/admin/trashcan/users', ["controller" => "Admin\\TrashCanController", "action" => "user"]);




// lọc danh sách theo danh mục bên trang chủ
Router::post('/categories/select/products', ["controller" => "Client\\ComponentController", "action" => "selectProductByCategory"]);
Router::post('/age/products', ["controller" => "Client\\ComponentController", "action" => "selectProductByAge"]);
// lọc danh sách theo danh mục bên trang sản phẩm
Router::post('/categories/products', ["controller" => "Client\\ComponentController", "action" => "selectProductByCategory"]);
// update trạng thái chung cho admin trừ users
Router::post('/update/status', ["controller" => "Admin\\ComponentController", "action" => "updateStatusCheckout"]);


Router::get('/notfound', ["controller" => "Client\\HomeController", "action" => "notfound"]);
Router::get('/logout', ["controller" => "Client\\AuthController", "action" => "logout"]);

Router::dispatch();

