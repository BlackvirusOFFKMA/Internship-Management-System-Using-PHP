<?php

/**
 * students controller
 */
class Students extends Controller
{

    function index()
    {
        // code...
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }

        $user = new User();

        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $query = "select * from users where rank in ('student') order by id desc limit $limit offset $offset";

        if(isset($_GET['find']))
        {
            $find = '%' . $_GET['find'] . '%';
            $query = "select * from users where rank in ('student') && (firstname like :find || lastname like :find) order by id desc limit $limit offset $offset";
            $arr['find'] = $find;
        }

        $data = $user->query($query,$arr);

        $crumbs[] = ['Dashboard',''];
        $crumbs[] = ['students','students'];

        if(Auth::access('lecturer')){
            $this->view('students',[
                'rows'=>$data,
                'crumbs'=>$crumbs,
                'pager'=>$pager,
            ]);
        }else{
            $this->view('access-denied');
        }
    }
}
