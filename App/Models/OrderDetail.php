<?php

namespace App\Models;

class OrderDetail extends BaseModel
{
    protected $table = 'order_detail';
    protected $id = 'id';
    public function getAllOrderDetail(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT products.name,products.image,order_detail.*,orders.total,orders.orderStatus,orders.name,orders.phone,orders.province,orders.district,orders.ward,orders.address,users.email FROM `products`INNER JOIN order_detail 
            on products.id = order_detail.product_id INNER JOIN orders on orders.id = order_detail.order_id INNER JOIN users ON orders.user_id = users.id WHERE orders.id = ? AND users.id =".$_SESSION['user']['id'];
           
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllOrderDetailIdAdmin(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT orders.*,order_detail.*,users.name as user_name,users.email,users.phone as user_phone ,products.image,products.name as product_name
            FROM orders INNER JOIN order_detail ON order_detail.order_id = orders.id 
            INNER JOIN users ON orders.user_id = users.id INNER JOIN products on order_detail.product_id = products.id WHERE orders.id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOneorderDetail($id)
    {
        return $this->getOne($id);
    }

    public function createorderDetail($data)
    {
        return $this->create($data);
    }
    public function updateorderDetail($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countTotalorderDetail()
    {
        return $this->countTotal();
    }
    public function deleteorderDetail($id)
    {
        return $this->delete($id);
    }


}
