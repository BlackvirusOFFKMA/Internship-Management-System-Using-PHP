<?php
    class Studen_view_model extends DB {
        function __construct(){}

        function getStudent($MaSV) {
            $sql = "SELECT * FROM sinhvien WHERE MaSV = '$MaSV'";
            $result = mysqli_query($this->conn,$sql);

        }

        function setStudent ($MaSV) {
            $sql = "SELECT * FROM sinhvien WHERE MaSV = '$MaSV'";
            $
        }
    }
?>
