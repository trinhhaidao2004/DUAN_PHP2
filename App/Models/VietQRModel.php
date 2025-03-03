<?php 
namespace App\Models;

class VietQRModel {
    private $clientId;
    private $apiKey;
    private $url;

    public function __construct() {
        $this->clientId = 'cf9770e4-c277-4b60-aeef-4704bbb45e55';
        $this->apiKey = '1ea58ef8-d572-425f-a1a6-43a752d6ab68';
        $this->url = 'https://api.vietqr.io/v2/generate'; 
    }

    public function generateQRCode($accountNo, $accountName, $acqId, $addInfo, $amount, $template = 'compact') {
        
        $data = [
            'accountNo' => $accountNo,
            'accountName' => $accountName,
            'acqId' => $acqId,
            'addInfo' => $addInfo,
            'amount' => $amount,
            'template' => $template,
        ];

        // Khởi tạo cURL
        $ch = curl_init();

        // Thiết lập các tuỳ chọn cho cURL
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-client-id: ' . $this->clientId,
            'x-api-key: ' . $this->apiKey,
            'Content-Type: application/json',
        ]);

        // Gửi request và nhận kết quả trả về
        $response = curl_exec($ch);
//    var_dump($response);
//    die;
        // Kiểm tra lỗi cURL
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        // Đóng kết nối cURL
        curl_close($ch);

        // Giải mã kết quả trả về từ API
        return json_decode($response, true);
    }
}
