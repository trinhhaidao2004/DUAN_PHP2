<?php


namespace App\Models;

use App\Helpers\NotificationHelper;

class Email extends BaseModel   
{

    // public function getUserEmail($email) {
    //     $sql = "SELECT * FROM tbl_users WHERE userEmail = :email";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll();
        
    //     if ($result) {
    //         return $result;
    //     } else {
    //         echo "<h4 style='color:red'>Email không tồn tại</h4><br>";
    //     }
    // }
    // public function forgetPass($pass, $email) {
    //     $sql = "UPDATE tbl_users SET userPass = :pass WHERE userEmail = :email";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindParam(':pass', $pass);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->execute();
    // }
}
?>