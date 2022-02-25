<?php

/**
 * users controller
 */
class Users extends Controller
{
	
	function index()
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$user = new User();
		$limit = 8;
		$pager = new Pager($limit);
		$offset = $pager->offset;
		$arr = array();
		$query = "select * from users where rank not in ('student') order by id desc limit $limit offset $offset";
		
		// $user_id = Auth::getUser_id();
		// $arr['user_id'] = $user_id;
		
 		if(isset($_GET['find']))
 		{
 			$find = '%' . $_GET['find'] . '%';
 			$query = "select * from users where rank not in ('student') && (firstname like :find || lastname like :find) order by id desc limit $limit offset $offset";
 			$arr['find'] = $find;
 		}

		$data = $user->query($query,$arr);
		
		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['staff','users'];

		if(Auth::access('admin')){

			$this->view('users',[
				'rows'=>$data,
				'crumbs'=>$crumbs,
				'pager'=>$pager,
			]);
		}else{
			$this->view('access-denied');
		}
	}
}
