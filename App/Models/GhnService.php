<?php

namespace App\Models;

class GhnService
{
    private $apiUrl = 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create';
    private $token = '2854bda0-abb0-11ef-9dc7-a66496990e59';
    private $shopId = 5483618;

    public function createShippingOrder($data)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Token: ' . $this->token,
                'ShopId: ' . $this->shopId,
            ],
            CURLOPT_POSTFIELDS => json_encode($data), 
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if ($error) {
            throw new \Exception('cURL Error: ' . $error);
        }

        return json_decode($response, true);
    }
}
