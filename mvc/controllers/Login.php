<?php
    class Login extends Controller{
        private $user;
        private $pass;
        function __construct()
        {
            if(isset($_POST['username']) and isset($_POST['password'])) {
                $user = $_POST['username'];
                $pass = $_POST['password'];

                $checker = $this->model('login_model');
                $result = $checker->Check_user($user,$pass);
                if ($result == 1) {
                    $_SESSION['MaSV'] = $user;
                    header('location: http://localhost/Internship-Management-System-Using-PHP/Internship-Management-System-Using-PHP/Student_view/Get_student_infor');//them duong dan den trang chu
                }
            }
        }

        function call_view() {
            $this->view('login');
        }

    }
?>