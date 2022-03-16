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
 		}elseif (Auth::access('lecturer')){

 			$topic = new Topics_model();
 			$mytable = "topics";
 			
 			
			$query = "select * from $mytable where user_id = :user_id && disabled = 0";
 			$arr['user_id'] = Auth::getUser_id();

			if(isset($_GET['find']))
	 		{
	 			$find = '%' . $_GET['find'] . '%';
	 			$query = "select topics.* from topics where topics.user_id = :user_id && topics.disabled = 0 && topics.topic like :find ";
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
 		}elseif (Auth::get)

		$crumbs[] = ['Trang chủ',''];
		$crumbs[] = ['Đề tài','topics'];

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

 		$crumbs[] = ['Trang chủ',''];
		$crumbs[] = ['Đề tài','Topics'];
		$crumbs[] = ['Thêm','Topics/add'];

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
 				print_r($_POST);
 				$topics->update($id,$_POST);
 				$this->redirect('Topics');
 			}else
 			{
 				//errors
 				$errors = $topics->errors;
 			}
 		}

 		$row = $topics->where('id',$id);

 		$crumbs[] = ['Trang chủ',''];
		$crumbs[] = ['Đề tài','topics'];
		$crumbs[] = ['Chỉnh sửa','Topics/edit'];

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
 
 			$topics->Delete($id);
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
	//không hiểu sao thêm phần lấy số lượng sinh viên của đề tài thì xuất hiện lỗi
	public function view_topic($id = null)	
	{
		//check user
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		$crumbs[] = ['Trang chủ',''];
		$crumbs[] = ['Đề tài','topics'];

		//get topic infor
		$topics = new Topics_model();
		$data = $topics->get_single_topic($id);

		//get number of student
		$amount = $topics->amount_student($id);

		$crumbs[] = [$data->topic_id,''];

		$this->view('topic-register',[
			'crumbs'=>$crumbs,
			'amount'=>$amount,
			'data'=>$data
		]);
	}

	public function register($id = null)
	{
		//check user
		if(!Auth::logged_in())
		{
			$this->redirect('login');
		}

		if (isset($_GET['regist'])) {

            $topics = new Topics_model();

			$amount = $topics->amount_student($id);
			$single_topic = $topics->get_single_topic($id);

			if($amount->amount = $single_topic->amount) 
			{

			}
			else
			{
				$this->errors['topic'] = "Quá giới hạn học sinh cho đe";
			}
            if ($user->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");

                if (Auth::access('lecturer')) {

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

		$errors = array();

		//$this->view('topic-register');
	}
}
