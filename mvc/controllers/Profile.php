<?php

/**
 * home controller
 */
class Profile extends Controller
{
	
	function index($id = '')
	{
		// code...
		//check loggin
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		//specify the user
		$user = new User();
		$id = trim($id == '') ? Auth::getUser_id() : $id;

		$row = $user->first('user_id',$id);

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['profile','profile'];
		if($row){
			$crumbs[] = [$row->firstname,'profile'];
		}

		//get more info depending on tab
		$data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'info';

		if($data['page_tab'] == 'classes' && $row)
		{
			$class = new Classes_model();
 			$mytable = "class_students";
 			if($row->rank == "lecturer"){
 				$mytable = "class_lecturers";
 			}
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0";
			$data['stud_classes'] = $class->query($query,['user_id'=>$id]);

			$data['student_classes'] = array();
			if($data['stud_classes']){
				foreach ($data['stud_classes'] as $key => $arow) {
					// code...
					$data['student_classes'][] = $class->first('class_id',$arow->class_id);
				}
			}
			
		}

		$data['row'] = $row;
		$data['crumbs'] = $crumbs;

		if(Auth::access('lecturer') || Auth::i_own_content($row)){
			$this->view('profile',$data);
		}else{
			$this->view('access-denied');
		}
	}

		
	function edit($id = '')
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		$errors = array();

		$user = new User();
		$id = trim($id == '') ? Auth::getUser_id() : $id;
  
		if(count($_POST) > 0 && Auth::access('lecturer'))
		{

			//something was posted

			//check if passwords exist
			if(trim($_POST['password']) == "")
			{
				unset($_POST['password']);
				unset($_POST['password2']);
			}

			if($user->validate($_POST,$id))
 			{
 				//check for files
 				if($myimage = upload_image($_FILES))
 				{
 					$_POST['image'] = $myimage;
 				}

 				if($_POST['rank'] == 'admin' && $_SESSION['USER']->rank != 'admin')
				{
					$_POST['rank'] = 'admin';
				}

				$myrow = $user->first('user_id',$id);
				if(is_object($myrow)){
					$user->update($myrow->id,$_POST);
				}
 
 				$redirect = 'profile/edit/'.$id;
 				$this->redirect($redirect);
 			}else
 			{
 				//errors
 				$errors = $user->errors;
 			}
		}

		$row = $user->first('user_id',$id);

		$data['row'] = $row;
		$data['errors'] = $errors;

		if(Auth::access('lecturer') || Auth::i_own_content($row)){
			$this->view('profile-edit',$data);
		}else{
			$this->view('access-denied');
		}

	}

	function delete($id = '')
	{
		// code...
		//check loggin
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}
		$errors = array();
		//get user id
		$user = new User();
		$id = trim($id == '') ? Auth::getUser_id() : $id;
		
		if(Auth::access('lecturer'))
		{
			$user->delete($id);
			$redirect = 'users';
			$this->redirect($redirect);
		}
	}
}
