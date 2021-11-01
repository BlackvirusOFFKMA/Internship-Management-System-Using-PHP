<?php
    class DB {
        public $conn;
        protected $servername = "localhost";
        protected $username = "root";
        protected $password = "";
        protected $dbname = "qlsvtt";

        function __construct()
        {
            $this->conn = new mysqli($this->servername,$this->username,$this->password);
            mysqli_select_db($this->conn, $this->dbname);
        }
    }

?>
