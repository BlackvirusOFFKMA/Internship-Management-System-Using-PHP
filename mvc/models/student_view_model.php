<?php
    class Student_view_model extends DB {
        
        public function getStudent($MaSV) {
            if(!$this->conn) { echo 'Connection fail'.mysqli_connect_errno();}

            $sql = "SELECT * FROM sinhvien WHERE MaSV = '$MaSV'";
            $result = mysqli_query($this->conn,$sql);
            $b = mysqli_num_rows($result);
            $a = mysqli_fetch_assoc($result);   
            return $a;
        }
    }
?>
