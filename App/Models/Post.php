<?php

namespace App\Models;


class Post extends BaseModel
{
    protected $table = 'posts';
    protected $id = 'id';



    public function getAllPost()
    {
        // Xác định số trang hiện tại
        $pages = isset($_GET['pages']) ? intval($_GET['pages']) : 1;

        $row = 10; // Số lượng bài viết mỗi trang
        $from = ($pages - 1) * $row; // Vị trí bắt đầu của bản ghi

        $result = [];
        try {
            // Truy vấn dữ liệu bài viết
            $sql = "SELECT * FROM $this->table WHERE status = 1 ORDER BY id DESC LIMIT $from, $row";

            // Truy vấn số lượng bài viết
            $count = "SELECT COUNT(id) AS total FROM $this->table WHERE status = 1";

            // Thực hiện truy vấn
            $result = $this->_conn->MySQLi()->query($sql);
            $result_count = $this->_conn->MySQLi()->query($count);

            // Lấy tổng số bài viết
            $total = $result_count->fetch_assoc()['total']; // Sử dụng fetch_assoc để lấy kết quả

            // Trả về kết quả
            return [
                'posts' => $result->fetch_all(MYSQLI_ASSOC), // Lấy danh sách bài viết
                'total' => intval($total), // Tổng số bài viết
                'current_page' => $pages, // Trang hiện tại
                'total_pages' => ceil($total / $row) // Tổng số trang
            ];
        } catch (\Throwable $th) {
            // Ghi log lỗi và trả về kết quả rỗng
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function countPost()
    {

    }
    public function getOnePost($id)
    {
        return $this->getOne($id);
    }

    public function createPost($data)
    {
        return $this->create($data);
    }
    public function updatePost($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletePost($id)
    {
        return $this->delete($id);
    }

    

    public function getAllPostByStatusRecycle()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM posts WHERE status= 0";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function search($keyword)
    {
        $sql = "SELECT posts.* FROM posts WHERE posts.title REGEXP '$keyword' ";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAllPostLimit4()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 4 ";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
}