<?php
    class Student_view_model extends DB {
        //get student information
        public function getStudent($MaSV) {
            $sql = "SELECT * FROM sinhvien WHERE MaSV = '$MaSV'";
            $result = mysqli_query($this->conn,$sql);
            $a = mysqli_fetch_assoc($result);   
            return $a;
        }
        //get teacher information
        public function getTeacher($MaSV) {
            $sql = "";
            $result = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($result);
        }
        //get class information
        public function getClass($MaSV) {
            $sql = "SELECT lop.MaLop,lop.TenLop FROM sinhvien,lop WHERE sinhvien.MaLop = lop.MaLop AND sinhvien.MaSV = '$MaSV' ";
            $result = mysqli_query($this->conn,$sql);
            return mysqli_fetch_assoc($result);
        }

    }
?>
