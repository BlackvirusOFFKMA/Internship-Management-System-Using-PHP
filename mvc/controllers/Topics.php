<?php


/**
 * Topics controller
 */
class Topics extends Controller
{
	
	public function index()
	{
		// code...
		// check login
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$topics = new Topics_model();


		if(Auth::access('admin')){

			$query = "select * from topics order by id desc";

			$arr = array();

			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select * from topics where topic like :find order by id desc";
	 			$arr['find'] = $find;
	 		}

			$data = $topics->query($query,$arr);
 		}else{

 			$topic = new Topics_model();
 			$mytable = "topic_students";
 			if(Auth::getRank() == "lecturer"){
 				$mytable = "topic_lecturers";
 			}
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0";
 			$arr['user_id'] = Auth::getUser_id();

			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select topics.topic, {$mytable}.* from $mytable join topics on topics.topic_id = {$mytable}.topic_id where {$mytable}.user_id = :user_id && {$mytable}.disabled = 0 && topics.topic like :find ";
	 			$arr['find'] = $find;
	 		}

			$arr['stud_topics'] = $topic->query($query,$arr);

			$data = array();
			if($arr['stud_topics']){
				foreach ($arr['stud_topics'] as $key => $arow) {
					// code...
					$data[] = $topic->first('topic_id',$arow->topic_id);
				}
			}
 
 		}

		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','topics'];

		$this->view('topics',[
			'crumbs'=>$crumbs,
			'rows'=>$data
		]);
	}

	public function add()
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$errors = array();
		if(count($_POST) > 0)
 		{

			$topics = new Topics_model();
			if($topics->validate($_POST))
 			{
 				
 				$_POST['create_date'] = date("Y-m-d H:i:s");

 				$topics->insert($_POST);
 				$this->redirect('Topics');
 			}else
 			{
 				//errors
 				$errors = $topics->errors;
 			}
 		}

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','Topics'];
		$crumbs[] = ['Add','Topics/add'];

		$this->view('Topics.add',[
			'errors'=>$errors,
			'crumbs'=>$crumbs,
			
		]);
	}

	public function edit($id = null)
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$topics = new Topics_model();

		$errors = array();
		if(count($_POST) > 0 && Auth::access('lecturer'))
 		{

			if($topics->validate($_POST))
 			{
 				
 				$topics->update($id,$_POST);
 				$this->redirect('Topics');
 			}else
 			{
 				//errors
 				$errors = $topics->errors;
 			}
 		}

 		$row = $topics->where('id',$id);

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','topics'];
		$crumbs[] = ['Edit','Topics/edit'];

		if(Auth::access('lecturer') && Auth::i_own_content($row)){

			$this->view('topics.edit',[
				'row'=>$row,
				'errors'=>$errors,
				'crumbs'=>$crumbs,
			]);
		}else{
			$this->view('access-denied');
		}
	}

	public function delete($id = null)
	{
		// code...
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

 
		$topics = new Topics_model();

		$errors = array();

		if(count($_POST) > 0 && Auth::access('lecturer'))
 		{
 
 			$topics->delete($id);
 			$this->redirect('Topics');
 		 
 		}

 		$row = $topics->where('id',$id);

 		$crumbs[] = ['Dashboard',''];
		$crumbs[] = ['Topics','Topics'];
		$crumbs[] = ['Delete','Topics/delete'];

		if(Auth::access('lecturer') && Auth::i_own_content($row)){

			$this->view('Topics.delete',[
				'row'=>$row,
	 			'crumbs'=>$crumbs,
			]);
		}else{
			$this->view('access-denied');
		}
	}
	
}
