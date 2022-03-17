<?php

/**
 * login controller
 */
class Signup extends Controller
{

    function index()
    {
        // code...
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $mode = isset($_GET['mode']) ? $_GET['mode'] : '';
        $errors = array();
        if (count($_POST) > 0) {

            $user = new User();

            if ($user->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");

                if (Auth::access('admin')) {

                    if ($_POST['rank'] == 'admin' && $_SESSION['USER']->rank != 'admin') {
                        $_POST['rank'] = 'admin';
                    }

                    $user->insert($_POST);
                    // $user->make_user_id($_POST);
                    if($_POST['rank'] = 'student') {
                        $scores = new Scores_model();
                        $scores->insert($user->make_user_id($_POST)['user_id']);
                    }
                }

                $redirect = $mode == 'users';
                $this->redirect($redirect);
            } else {
                //errors
                $errors = $user->errors;
            }
        }

        if (Auth::access('admin')) {
            $this->view('signup', [
                'errors' => $errors,
                'mode' => $mode,
            ]);
        } else {
            $this->view('access-denied');
        }
    }
}
