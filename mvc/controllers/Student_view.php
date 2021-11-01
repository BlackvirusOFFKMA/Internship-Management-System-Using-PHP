<?php
    class Student_view extends Controller {
        private $MaSV = $_SESSION['MaSV'];
        private $student;
        private $class;
        private $teacher;
        private $grade;
        function __construct()
        {
            if(!isset($_SESSION['username'])) {
                header("Location: http://localhost/Internship-Management-System-Using-PHP/Internship-Management-System-Using-PHP/login");
            }
        }

        //display form to get student information
        function Get_student_infor() {
            
        }

        //show student all information
        function Show () {
            
        }
    }
?>