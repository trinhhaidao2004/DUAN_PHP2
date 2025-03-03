<?php

namespace App\Models;

class Order extends BaseModel
{
    protected $table = 'orders';
    protected $id = 'id';


    public function getAllorder()
    {

        $result = [];
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE user_id =" . $_SESSION['user']['id'] . " ORDER BY id DESC";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllorderByStatus($colum = 'status', $operator = '!=', int $int = 2)
    {

        $result = [];
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE " . $colum . " " . $operator . " " . $int . " AND user_id =" . $_SESSION['user']['id'] . " ORDER BY id DESC";
            // var_dump($sql);
            // die;
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllorderByStatusAdmin($colum = 'status', $operator = '!=', int $int = 2)
    {
        $result = [];
        try {
            $sql = "SELECT orders.*, users.email FROM orders INNER JOIN users on users.id = orders.user_id WHERE " . $colum . " " . $operator . " " . $int . " ORDER BY id DESC";
            // var_dump($sql);
            // die;
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }

    }
    public function getAllOrderUserByStatus($userId, $OrderStatus)
    {
        $result = [];
        try {
            $sql = "SELECT orders.*, users.email FROM orders INNER JOIN users on users.id = orders.user_id WHERE users.id = ? AND orders.orderStatus = ? ORDER BY id DESC";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $userId, $OrderStatus);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }

    }
    public function getOneorder($id)
    {
        return $this->getOne($id);
    }

    public function createorder($data)
    {
        return $this->create($data);
    }
    public function updateorder($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countTotalorder()
    {
        return $this->countTotal();
    }
    public function deleteorder($id)
    {
        return $this->delete($id);
    }
    public function getAllOrderbyUser_id()
    {
        $result = [];
        try {
            $sql = "SELECT orders.id,orders.total,orders.orderStatus,orders.date,orders.paymentMethod,orders.user_id FROM orders WHERE orders.user_id =" . $_SESSION['user']['id'] . " AND orders.transport =2";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function createOder(array $data)
    {
        // $sql ="INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')";

        // $result = $this->_conn->connect()->query($sql);
        // return $result;

        try {
            $sql = "INSERT INTO $this->table (";
            foreach ($data as $key => $value) {
                $sql .= "$key, ";
            }
            // INSERT INTO $this->table (name, description, status, 
            $sql = rtrim($sql, ", ");
            // INSERT INTO $this->table (name, description, status
            $sql .= " ) VALUES (";
            // INSERT INTO $this->table (name, description, status) VALUES (
            foreach ($data as $key => $value) {
                $sql .= "'$value', ";
            }

            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1', 
            $sql = rtrim($sql, ", ");
            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1'

            $sql .= ")";
            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $conn->insert_id;
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

    public function StatisticalOrder($subdays)
    {
        $result = [];
        try {
            // Truy vấn SQL: sử dụng INTERVAL để tính toán ngày bắt đầu từ số ngày được truyền vào ($subdays)
            $sql = "SELECT DATE(date) AS order_day,  COUNT(*) AS total_orders,  SUM(total) AS total_value FROM  orders WHERE  date >= DATE_SUB(CURRENT_DATE, INTERVAL '$subdays' DAY) AND date < DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY) GROUP BY DATE(date) ORDER BY order_day;";
            // Thực thi truy vấn và lấy kết quả
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOneOrderByStatus($id)
    {

        $result = [];
        try {
            $sql = "SELECT id, orderStatus ,total, paymentMethod	 FROM orders WHERE id=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllOderByUser($id)
    {

        $result = [];
        try {
            $sql = "SELECT orders.*, users.email FROM orders INNER JOIN users on users.id = orders.user_id WHERE users.id = ? ORDER BY id DESC;
";
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
}
