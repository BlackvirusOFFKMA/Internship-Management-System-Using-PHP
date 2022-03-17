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

		$crumbs[] = ['Trang chủ',''];
		$crumbs[] = ['Hồ sơ','profile'];
		if($row){
			$crumbs[] = [$row->firstname,'profile'];
		}

		//get more info depending on tab
		$data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'info';

		if($data['page_tab'] == 'topics' && $row)
		{
			$topic = new Topics_model();
 			$mytable = "topic_students";
 			if($row->rank == "lecturer"){
 				$mytable = "topic";
 			}
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0";
			$data['stud_topics'] = $topic->query($query,['user_id'=>$id]);

			$data['student_topics'] = array();
			if($data['stud_topics']){
				foreach ($data['stud_topics'] as $key => $arow) {
					// code...
					$data['student_topics'][] = $topic->first('topic_id',$arow->topic_id);
				}
			}
			
		}
		//get score data
		//$class = 'score';
		// $score =(object) $user->get_extra_data($id,'score');
		$score =(object) $user->get_score($id);
		if(empty($score->score)) 
		{
			$score->score = "No score given";
			(object) $score;
		}

		//get topic data
		//$class = 'topic';
		// $topic =(object) $user->get_extra_data($id,'topic');
		$topic =(object) $user->get_topic_name($id);
		
		if(empty($topic->topic)) 
		{
			$topic->topic = "No topic given";
			(object) $topic;
		}

		$data['score'] = $score;
		$data['topic'] = $topic;
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
 				// check for files
 				if($myimage = upload_image($_FILES))
 				{
					$user->update_image($id,$myimage);
					unset($_POST['image']);
 				}


 				if($_POST['rank'] == 'admin' && $_SESSION['USER']->rank != 'admin')
				{
					$_POST['rank'] = 'admin';
				}

				$myrow = $user->first('user_id',$id);
				//update score
				$score = $_POST['score'];
				$user->update_score($id,$score);
				unset($_POST['score']);

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
		$score = (object)$user->get_extra_data($id,'score');
		if(empty($score->score)) 
		{
			$score->score = "";
			(object) $score;
		}

		$data['score']  = $score;
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
