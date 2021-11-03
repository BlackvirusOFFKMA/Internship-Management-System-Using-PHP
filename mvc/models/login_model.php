<?php
    class Login_model extends DB{
        public function Check_user($user,$pass){
            $sql = "SELECT * FROM account WHERE username = '$user' AND password = '$pass'";
            $result = mysqli_query($this->conn,$sql);
            $a = mysqli_num_rows($result);
            return $a;
        }
    }
?>