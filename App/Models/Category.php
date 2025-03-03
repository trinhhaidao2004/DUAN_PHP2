<?php

namespace App\Models;

class Category extends BaseModel
{
    protected $table = 'categories';
    protected $id = 'id';



    public function getAllCategory($operator = '!=', int $int = 2)
    {
        $pages = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
        $row = 2;
        $from = ($pages - 1) * $row;

        $result = [];
        try {
            $sql = "SELECT c.*, COUNT(p.id) AS total_products \n"

                . "FROM categories c \n"

                . "LEFT JOIN products p ON c.id = p.category_id \n"

                . "WHERE c.status " . $operator . $int . " \n"

                . "GROUP BY c.id \n"

                . "ORDER BY c.id DESC \n"

                . "LIMIT " . $from . "," . $row . ";";
            // var_dump($sql);
            // die;
            $count = "SELECT COUNT(id) AS total FROM $this->table WHERE $this->table.status " . $operator . "" . $int;
            $result_count = $this->_conn->MySQLi()->query($count);
            // Lấy tổng số bài viết
            $total = $result_count->fetch_assoc()['total'];
            $result = $this->_conn->MySQLi()->query($sql);
            return [
                'categories' => $result->fetch_all(MYSQLI_ASSOC), // Lấy danh sách bài viết
                'total' => intval($total), // Tổng số bài viết
                'current_page' => $pages, // Trang hiện tại
                'total_pages' => ceil($total / $row) // Tổng số trang
            ];
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }




    // public function getAllCategory()
    // {
    //     $result = [];
    //     try {
    //         $sql = "SELECT c.*, COUNT(p.id) AS total_products FROM categories c LEFT JOIN products p ON c.id = p.category_id where c.status != 2  GROUP BY c.id ;";
    //         $result = $this->_conn->MySQLi()->query($sql);
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     } catch (\Throwable $th) {
    //         error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
    //         return $result;
    //     }
    // }
    public function getOneCategory($id)
    {
        return $this->getOne($id);
    }

    public function createCategory($data)
    {
        return $this->create($data);
    }
    public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
    public function getAllCategoryByStatus()
    {
        return $this->getAllByStatus();
    }
    public function getAllByStatus()
    {
        $sql = "SELECT * FROM $this->table WHERE status = 1";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getOneCategoryByName($name)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE name=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $name);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy loại sản phẩm bằng tên: ' . $th->getMessage());
            return $result;
        }
    }
    public function countTotalCategory()
    {
        return $this->countTotal();
    }
    public function getAllCategoryProductByStatus(int $id)
    {



        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name 
                 FROM products 
                 INNER JOIN categories ON products.category_id = categories.id WHERE categories.status != 0 AND products.category_id = $id";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }

    }

    public function search($keyword)
    {
        $sql = "SELECT categories.* FROM categories WHERE categories.name REGEXP '$keyword' ";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
