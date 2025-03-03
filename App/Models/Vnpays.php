<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class Vnpays extends BaseModel
{
    protected $table = 'vnpays';
    protected $id = 'id';


    public function getAllvnpays()
    {

        $result = [];
        try {
            $sql = "SELECT orders.id AS orders_id, orders.total, orders.paymentMethod, orders.user_id,  vnpays.id AS vnpay_id,  vnpays.vnp_BankCode,vnpays.vnp_PayDate, vnpays.vnp_TransactionStatus, vnpays.order_id FROM orders INNER JOIN vnpays ON vnpays.order_id = orders.id WHERE orders.user_id =".$_SESSION['user']['id'];
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function createVnpay($data)
    {
        return $this->create($data);
    }
}