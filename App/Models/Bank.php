<?php

namespace App\Models;

class Bank extends BaseModel
{
    protected $table = 'banks';
    protected $id = 'id';

    public function getAllClientBank()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE status = 1";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOneBank($id)
    {
        return $this->getOne($id);
    }

    public function createBank($data)
    {
        return $this->create($data);
    }
    public function updateBank($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteBank($id)
    {
        return $this->delete($id);
    }
    public function getAllBankByStatus()
    {
        return $this->getAllByStatus();
    }
    public function countTotalBank()
    {
        return $this->countTotal();
    }
   
}
