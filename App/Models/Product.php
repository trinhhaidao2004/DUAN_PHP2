<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $table = 'products';
    protected $id = 'id';

    public function getAllProduct(int $row = 8)
    {
        $pages = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
       
       // $row = 4;
        $from = ($pages - 1) * $row;
        $result = [];
        try {
            $sql = "SELECT products.*,categories.status as category_status,
             categories.name as category_name,categories.id as categories_id FROM products INNER JOIN categories ON categories.id = products.category_id WHERE categories.status = 1 AND products.status = 1 ORDER BY products.id DESC LIMIT " . $from . "," . $row;
            $count = "SELECT COUNT(id) AS total FROM $this->table WHERE $this->table.status = 1";
            $result_count = $this->_conn->MySQLi()->query($count);

            // Lấy tổng số bài viết
            $total = $result_count->fetch_assoc()['total'];
            $result = $this->_conn->MySQLi()->query($sql);
            return [
                'products' => $result->fetch_all(MYSQLI_ASSOC), // Lấy danh sách bài viết
                'total' => intval($total), // Tổng số bài viết
                'current_page' => $pages, // Trang hiện tại
                'total_pages' => ceil($total / $row) // Tổng số trang
            ];
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }



    }
    public function getAllByAge($colum = 'status', $operator = '!=', int $int = 2)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE " . $colum . " " . $operator . " " . $int . " AND status = 1";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllLimit($colum = 'status', int $int = 1, int $number = 6)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE " . $colum . " = " . $int . "  limit " . $number . "";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }





    }
    public function getAllProductAdmin($operator = '!=', int $int = 2)
    {
        $pages = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
        $row = 5;
        $from = ($pages - 1) * $row;
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name as category_name FROM 
            products INNER JOIN categories ON categories.id = products.category_id 
            WHERE products.status " . $operator . " " . $int . " ORDER BY products.id DESC LIMIT " . $from . "," . $row;

            $count = "SELECT COUNT(id) AS total FROM $this->table WHERE $this->table.status " . $operator . " " . $int;
            $result_count = $this->_conn->MySQLi()->query($count);

            // Lấy tổng số bài viết
            $total = $result_count->fetch_assoc()['total'];
            $result = $this->_conn->MySQLi()->query($sql);
            return [
                'products' => $result->fetch_all(MYSQLI_ASSOC), // Lấy danh sách bài viết
                'total' => intval($total), // Tổng số bài viết
                'current_page' => $pages, // Trang hiện tại
                'total_pages' => ceil($total / $row) // Tổng số trang
            ];
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOneProduct($id, $operator = '=', int $int = 1)
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name as category_name FROM products INNER JOIN categories ON categories.id = products.category_id WHERE products.status " . $operator . " ? AND products.id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $int, $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function selectProductByCategory(int $category_id)
    {
        $result = [];
        $pages = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
        $row = 5;
        $from = ($pages - 1) * $row;

        try {
            $sql = "SELECT products.*, categories.name as category_name 
            FROM products 
            INNER JOIN categories ON categories.id = products.category_id 
            WHERE categories.status = 1 
            AND products.status = 1 
            AND categories.id = ? 
            ORDER BY products.id DESC 
            LIMIT ?, ?";
            $count = "SELECT COUNT(products.id) AS total 
              FROM products 
              INNER JOIN categories ON categories.id = products.category_id 
              WHERE categories.status = 1 
              AND products.status = 1 
              AND categories.id = ?";

            $conn = $this->_conn->MySQLi();

            // Chuẩn bị truy vấn đếm tổng số sản phẩm
            $stmtCount = $conn->prepare($count);
            $stmtCount->bind_param('i', $category_id);
            $stmtCount->execute();
            $total = $stmtCount->get_result()->fetch_assoc()['total'];

            // Chuẩn bị truy vấn lấy sản phẩm
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iii', $category_id, $from, $row);
            $stmt->execute();
            $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return [
                'products' => $products, // Danh sách sản phẩm
                'total' => intval($total), // Tổng số sản phẩm
                'current_page' => $pages, // Trang hiện tại
                'total_pages' => ceil($total / $row) // Tổng số trang
            ];
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }


    }
    public function countTotalProduct()
    {
        return $this->countTotal();
    }
    public function deleteProduct($id)
    {
        return $this->delete($id);
    }
    public function getAllProductByStatus()
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            WHERE products.status = " . self::STATUS_ENABLE . " 
              AND categories.status = " . self::STATUS_ENABLE . "
            ORDER BY products.id DESC";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllProductJoinCategoryDetail($id)
    {
        $result = [];
        try {
            $sql = "SELECT products.*,categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id 
            WHERE products.status =" . self::STATUS_ENABLE . "  
            AND  categories.status = " . self::STATUS_ENABLE . "  AND products.category_id =$id";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }


    public function createProduct(array $data)
    {

        try {
            $conn = $this->_conn->MySQLi();

            // Tạo danh sách các cột
            $columns = implode(", ", array_keys($data));

            // Tạo danh sách dấu chấm hỏi (?)
            $placeholders = implode(", ", array_fill(0, count($data), "?"));

            // Chuẩn bị câu lệnh SQL
            $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Lỗi khi chuẩn bị truy vấn: " . $conn->error);
            }

            // Gán kiểu dữ liệu cho từng giá trị
            $types = "";
            $values = [];
            foreach ($data as $key => $value) {
                if (is_int($value)) {
                    $types .= "i"; // INTEGER
                } elseif (is_float($value)) {
                    $types .= "d"; // DOUBLE
                } elseif (is_null($value)) {
                    $types .= "s"; // NULL được xử lý như STRING
                    $value = null; // Đảm bảo NULL thực sự
                } else {
                    $types .= "s"; // STRING
                }
                $values[] = $value;
            }

            // Bind tham số
            $stmt->bind_param($types, ...$values);

            // Thực thi truy vấn
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
    public function updateProduct(int $id, array $data)
    {
        try {
            $conn = $this->_conn->MySQLi();

            // Tạo danh sách các cột cần cập nhật
            $setClause = [];
            foreach ($data as $key => $value) {
                $setClause[] = "$key = ?";
            }
            $setClause = implode(", ", $setClause);

            // Chuẩn bị câu lệnh SQL
            $sql = "UPDATE $this->table SET $setClause WHERE $this->id = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Lỗi khi chuẩn bị truy vấn: " . $conn->error);
            }

            // Xử lý kiểu dữ liệu và giá trị tham số
            $types = "";
            $values = [];
            foreach ($data as $key => $value) {
                if (is_int($value)) {
                    $types .= "i"; // INTEGER
                } elseif (is_float($value)) {
                    $types .= "d"; // DOUBLE
                } elseif (is_null($value)) {
                    $types .= "s"; // NULL được xử lý như STRING
                    $value = null;
                } else {
                    $types .= "s"; // STRING
                }
                $values[] = $value;
            }

            // Thêm `$id` vào danh sách tham số
            $types .= "i";
            $values[] = $id;

            // Gán tham số vào câu lệnh SQL
            $stmt->bind_param($types, ...$values);

            // Thực thi truy vấn
            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi cập nhật dữ liệu: ' . $th->getMessage(), 0);
            return false;
        }
    }

    public function search($keyword)
    {
        $sql = "SELECT products.* , categories.name AS category_name 
                FROM products
                INNER JOIN categories ON products.category_id = categories.id
                WHERE products.name REGEXP '$keyword' 
                AND products.status = " . self::STATUS_ENABLE . "
                AND categories.status = " . self::STATUS_ENABLE;
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countProductByCategory()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS count,categories.name FROM products INNER JOIN categories on products.category_id = categories.id GROUP BY products.category_id;";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getTopViewedProducts()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table ORDER BY view DESC LIMIT 5";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị các sản phẩm có lượt xem nhiều nhất: ' . $th->getMessage());
            return $result;
        }
    }
    public function productsInnerJionOrderDetail($id)
    {
        $result = [];
        try {
            $sql = "SELECT products.id,order_detail.id as order_detail_id FROM products INNER JOIN order_detail ON order_detail.product_id = products.id WHERE products.id = ?;";
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
}