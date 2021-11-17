<?php
    class Student_view extends Controller {
        //protected $MaSV = $_SESSION['MaSV'];

        function __construct()
        {
            if(!isset($_SESSION['MaSV'])) {
                header("Location: http://localhost/Internship-Management-System-Using-PHP/Internship-Management-System-Using-PHP/login");
            }
        }

        //display form to get student information
        function Get_infor() {
            $model = $this->model('Student_view_model');
            $student = $model->getStudent($_SESSION['MaSV']);
            
        }

        //show student all information
        function Show () {
            
        }
    }
?>