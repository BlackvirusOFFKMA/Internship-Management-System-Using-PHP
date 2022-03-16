<?php

/**
 * single topic controller
 */
class Single_topic extends Controller
{
	
	public function index($id = '')
	{
		// code...
		$errors = array();
		if(!Auth::access('student'))
		{
			$this->redirect('access_denied');
		}

		$topics = new Topics_model();
		$row = $topics->first('topic_id',$id);

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','topics'];

		if($row){
			$crumbs[] = [$row->topic,''];
		}

		$limit = 10;
 		$pager = new Pager($limit);
 		$offset = $pager->offset;

		$page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
		$lect = new Topics_model();

		$results = false;

		if($page_tab == 'lecturers'){
			
			//display lecturers
			$query = "select * from topic where topic_id = :topic_id && disabled = 0 order by id desc limit $limit offset $offset";
			$lecturers = $lect->query($query,['topic_id'=>$id]);

			$data['lecturers'] 		= $lecturers;
		}else
		if($page_tab == 'students'){
			
			//display student
			$query = "select * from topic_students where topic_id = :topic_id && disabled = 0 order by id desc limit $limit offset $offset";
			$students = $lect->query($query,['topic_id'=>$id]);

			$data['students'] 		= $students;
		}

		$data['row'] 		= $row;
 		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;
		$data['pager'] 		= $pager;

		$this->view('single-topic',$data);
	}

	public function lectureradd($id = '')
	{

		$errors = array();
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$topics = new Topics_model();
		$row = $topics->first('topic_id',$id);

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','topics'];

		if($row){
			$crumbs[] = [$row->topic,''];
		}

		$page_tab = 'lecturer-add';
		$lect = new Topics_model();

		$results = false;
		
		if(count($_POST) > 0)
		{

			if(isset($_POST['search'])){

				if(trim($_POST['name']) != ""){

					//find lecturer
					$user = new User();
					$name = "%".trim($_POST['name'])."%";
					$query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'lecturer' limit 10";
					$results = $user->query($query,['fname'=>$name,'lname'=>$name,]);
				}else{
					$errors[] = "please type a name to find";
				}
			
			}else
			if(isset($_POST['selected'])){

				//add lecturer
				$query = "select disabled,id from topic_lecturers where user_id = :user_id && topic_id = :topic_id limit 1";
  
				if(!$check = $lect->query($query,[
					'user_id' => $_POST['selected'],
					'topic_id' => $id,
				])){

					$arr = array();
	 				$arr['user_id'] 	= $_POST['selected'];
	 				$arr['topic_id'] 	= $id;
					$arr['disabled'] 	= 0;

					$lect->insert($arr);

					$this->redirect('single_topic/'.$id.'?tab=lecturers');

				}else{

					//check if user is active
					if(isset($check[0]->disabled))
					{
						if($check[0]->disabled)
						{

							$arr = array();
			 				$arr['disabled'] 	= 0;
 							$lect->update($check[0]->id,$arr);

							$this->redirect('single_topic/'.$id.'?tab=lecturers');

						}else{

							$errors[] = "that lecturer already belongs to this topic";
						}
					}else{
						$errors[] = "that lecturer already belongs to this topic";
					}
						
				}
 
			}

		}

		$data['row'] 		= $row;
 		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;

		$this->view('single-topic',$data);
	}


	public function lecturerremove($id = '')
	{

		$errors = array();
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$topics = new Topics_model();
		$row = $topics->first('topic_id',$id);


		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','topics'];

		if($row){
			$crumbs[] = [$row->topic,''];
		}

		$page_tab = 'lecturer-remove';
		$lect = new Topics_model();

		$results = false;
		
		if(count($_POST) > 0)
		{

			if(isset($_POST['search'])){

				if(trim($_POST['name']) != ""){

					//find lecturer
					$user = new User();
					$name = "%".trim($_POST['name'])."%";
					$query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'lecturer' limit 10";
					$results = $user->query($query,['fname'=>$name,'lname'=>$name,]);
				}else{
					$errors[] = "please type a name to find";
				}
			
			}else
			if(isset($_POST['selected'])){

				//add lecturer
				$query = "select id from topic where user_id = :user_id && topic_id = :topic_id && disabled = 0 limit 1";
 
				if($row = $lect->query($query,[
					'user_id' => $_POST['selected'],
					'topic_id' => $id,
				])){

					$arr = array();
						$arr['disabled'] 	= 1;

					$lect->update($row[0]->id,$arr);

					$this->redirect('single_topic/'.$id.'?tab=lecturers');

				}else{
					$errors[] = "that lecturer was not found in this topic";
				}
 
			}

		}

		$data['row'] 		= $row;
 		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;

		$this->view('single-topic',$data);
	}


	public function studentadd($id = '')
	{

		$errors = array();
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$topics = new Topics_model();
		$row = $topics->first('topic_id',$id);

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','topics'];

		if($row){
			$crumbs[] = [$row->topic,''];
		}

		$page_tab = 'student-add';
		$stud = new Students_model();

		$results = false;
		
		if(count($_POST) > 0)
		{

			if(isset($_POST['search'])){

				if(trim($_POST['name']) != ""){

					//find student
					$user = new User();
					$name = "%".trim($_POST['name'])."%";
					$query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'student' limit 10";
					$results = $user->query($query,['fname'=>$name,'lname'=>$name,]);
				}else{
					$errors[] = "please type a name to find";
				}
			
			}else
			if(isset($_POST['selected'])){

				//add student
				$query = "select disabled,id from topic_students where user_id = :user_id && topic_id = :topic_id limit 1";
  
				if(!$check = $stud->query($query,[
					'user_id' => $_POST['selected'],
					'topic_id' => $id,
				])){

					$arr = array();
	 				$arr['user_id'] 	= $_POST['selected'];
	 				$arr['topic_id'] 	= $id;
					$arr['disabled'] 	= 0;
					// $arr['date'] 		= date("Y-m-d H:i:s");

					$stud->insert($arr);
					//add topic id to score table
					$scores = new Scores_model();
					$scores->update($arr['user_id'],$arr['topic_id']);

					$this->redirect('single_topic/'.$id.'?tab=students');

				}else{

					//check if user is active
					if(isset($check[0]->disabled))
					{
						if($check[0]->disabled)
						{

							$arr = array();
			 				$arr['disabled'] 	= 0;
 							$stud->update($check[0]->id,$arr);

							$this->redirect('single_topic/'.$id.'?tab=students');

						}else{

							$errors[] = "that student already belongs to this topic";
						}
					}else{
						$errors[] = "that student already belongs to this topic";
					}
 				}
 
			}

		}

		$data['row'] 		= $row;
 		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;

		$this->view('single-topic',$data);
	}


	public function studentremove($id = '')
	{

		$errors = array();
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$topics = new Topics_model();
		$row = $topics->first('topic_id',$id);


		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','topics'];

		if($row){
			$crumbs[] = [$row->topic,''];
		}

		$page_tab = 'student-remove';
		$stud = new Students_model();

		$results = false;
		
		if(count($_POST) > 0)
		{

			if(isset($_POST['search'])){

				if(trim($_POST['name']) != ""){

					//find student
					$user = new User();
					$name = "%".trim($_POST['name'])."%";
					$query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'student' limit 10";
					$results = $user->query($query,['fname'=>$name,'lname'=>$name,]);
				}else{
					$errors[] = "please type a name to find";
				}
			
			}else
			if(isset($_POST['selected'])){

				//add student
				$query = "select id from topic_students where user_id = :user_id && topic_id = :topic_id && disabled = 0 limit 1";
 
				if($row = $stud->query($query,[
					'user_id' => $_POST['selected'],
					'topic_id' => $id,
				])){

					$arr = array();
						$arr['disabled'] 	= 1;

					$stud->update($row[0]->id,$arr);

					$this->redirect('single_topic/'.$id.'?tab=students');

				}else{
					$errors[] = "that student was not found in this topic";
				}
 
			}

		}

		$data['row'] 		= $row;
 		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;

		$this->view('single-topic',$data);
	}
		
}
