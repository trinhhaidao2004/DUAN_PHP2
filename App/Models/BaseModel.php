<?php

namespace App\Models;

use App\Helpers\NotificationHelper;
use App\Interfaces\CrudInterface;
use Exception;

abstract class BaseModel implements CrudInterface
{
    protected $_conn;

    protected $table;
    protected $id;

    const STATUS_ALL = 2;
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;


    public function __construct()
    {
        $this->_conn = new Database();
    }

    public function getAllItem()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAll($colum = 'status', $operator = '!=', $int = 2)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE " . $colum . " " . $operator . " " . $int;
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAll_Admin_TrashCan()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE status = " . self::STATUS_ALL;

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAll_(int $transport, int $user_id)
    {
        $result = [];
        try {
            $sql = "SELECT orders.id, orders.total, orders.orderStatus, orders.date, orders.paymentMethod, orders.user_id , orders.transport
                FROM orders 
                WHERE orders.user_id = ? AND orders.transport = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $transport, $user_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOne(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE $this->id=?";
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
    public function create(array $data)
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

            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
    
    public function update(int $id, array $data)
    {
        try {
            $sql = "UPDATE $this->table SET ";
            foreach ($data as $key => $value) {
                $sql .= "$key = '$value', ";
            }
            $sql = rtrim($sql, ", ");

            $sql .= " WHERE $this->id=$id";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật dữ liệu: ', $th->getMessage());
            return false;
        }
    }
    public function delete(int $id): bool
    {try {
        $sql = "DELETE FROM $this->table WHERE $this->id = ?";
        $conn = $this->_conn->MySQLi();
        if ($conn) {
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("i", $id); // Giả sử $id là kiểu số nguyên
                $stmt->execute();
                
                // Kiểm tra xem có hàng nào bị ảnh hưởng không
                if ($stmt->affected_rows > 0) {
                    return $stmt->affected_rows;
                } else {
                    return false; // Không có hàng nào bị xóa (có thể id không tồn tại)
                }
            } else {
                error_log('Lỗi khi chuẩn bị truy vấn: ' . $conn->error);
                return false;
            }
        } else {
            error_log('Không thể kết nối đến cơ sở dữ liệu.');
            return false;
        }
    } catch (\Throwable $th) {
        error_log('Lỗi khi xóa dữ liệu: ' . $th->getMessage());
        return false;
    }
    
    }

    public function getAllByStatus()
    {
        $sql = "SELECT * FROM $this->table WHERE status !=" . self::STATUS_DISABLE;
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOneByName($colum,$name)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE {$colum}=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $name);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy bằng tên: ' . $th->getMessage());
            return $result;
        }
    }
    public function countTotal()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS total FROM $this->table";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi count tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
}
