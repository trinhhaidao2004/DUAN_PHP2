<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class User extends BaseModel
{
    protected $table = 'users';
    protected $id = 'id';



    public function getUsers($colum = 'status', $operator = '!=', $int = 2)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE " . $colum . " " . $operator . " " . $int . " ORDER BY (role = 0) DESC, id ASC; ";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOneUser($id)
    {
        return $this->getOne($id);
    }
    public function getBalance($id)
    {
        $result = [];
        try {
            $sql = "SELECT balance FROM $this->table WHERE $this->id=?";
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

    public function createUser(array $data)
    {
        try {
            $sql = "INSERT INTO $this->table (";
            foreach ($data as $key => $value) {
                $sql .= "$key, ";
            }
            $sql = rtrim($sql, ", ");
            $sql .= " ) VALUES (";
            foreach ($data as $key => $value) {
                $sql .= "'$value', ";
            }
            $sql = rtrim($sql, ", ");
            $sql .= ")";
        
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            
            if ($stmt->execute()) {
                return $conn->insert_id; // Trả về ID vừa thêm
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
        
    }
    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
    public function getAllCategoryByStatus()
    {
        return $this->getAllByStatus();
    }
    public function countTotalUser()
    {
        return $this->countTotal();
    }
    public function getOneUserByUsername(string $email)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM users WHERE email=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $email);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOneUserByToken($token)
    {
        $result = [];
        try {
            $sql = "SELECT users.id, users.token FROM users WHERE token=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $token);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOneUserByInfo($column, $info)
    {
        $this->id = $column;
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE $this->id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $info);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Đã xảy ra lỗi khi lấy dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
}