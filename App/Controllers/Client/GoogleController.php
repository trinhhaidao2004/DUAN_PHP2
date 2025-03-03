<?php

namespace App\Controllers\Client;

use Google\Client;
use Google\Service\Oauth2;
use App\Models\User;
use App\Helpers\AuthHelper;
use App\Validations\AuthValidation;
use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;

class GoogleController
{
    private $gClient;

    public function __construct()
    {

        $this->gClient = new Client();
        $this->gClient->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $this->gClient->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $this->gClient->setRedirectUri($_ENV['GOOGLE_REDIRECT_URL']);
        $this->gClient->addScope("email");
        $this->gClient->addScope("profile");
    }


    public function loginGoogle()
    {
        $authUrl = $this->gClient->createAuthUrl();
        header('Location: ' . $authUrl);
        exit;
    }
    public function callbackGoogle()
    {

        if (!isset($_GET['code']) || empty($_GET['code'])) {
            NotificationHelper::success('code', 'Không tìm thấy mã Google!');
            header('Location: /login');
            exit;
        }
        $token = $this->gClient->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            die("Lỗi khi lấy token: " . $token['error_description']);
        }

        $this->gClient->setAccessToken($token);

        $google_oauth = new Oauth2($this->gClient);
        $data = $google_oauth->userinfo->get();

       

        if ($data['email'] === $_ENV['ACCOUNT_ADMIN']) {
            $role = 0;
        }else{
            $role = 1;
        }
        $dataUser = [
            'google_id' => $data['id'],
            'email' => $data['email'],
            'username' => $data['name'],
            'name' => $data['given_name'],
            'avatar' => $data['picture'],
            'role' => $role,
        ];
      
        $user = AuthHelper::checkExistedInfo('google_id', $dataUser['google_id']);
        if ($user) {
            AuthHelper::updateSession($user['id']);
            AuthHelper::updateCookie($user['id']);
        } else {
            $user = new User();
            $result = $user->createUser($dataUser);
            if ($result) {
                $user = AuthHelper::checkExistedInfo('google_id', $dataUser['google_id']);
                AuthHelper::updateSession($user['id']);
                AuthHelper::updateCookie($user['id']);
            } else {
                NotificationHelper::error('Login_gg', 'Đăng nhập thất bại');
            }
        }
        header('Location: /');
        exit;
    }
}
