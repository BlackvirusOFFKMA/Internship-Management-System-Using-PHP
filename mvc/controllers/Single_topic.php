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
		// if (!Auth::access('student')) {
		// 	$this->redirect('access_denied');
		// }

		$topics = new Topics_model();
		$students = new Students_model();
		$stud_id = Auth::getUser_id();
		if (Auth::getRank() == 'student' && !$students->is_registed($stud_id)) {
			$crumbs[] = ['Trang chủ', ''];
			$crumbs[] = ['Đề tài', 'topics'];

			//get topic infor
			$topics = new Topics_model();
			$row = $topics->first('topic_id', $id);

			//get number of student
			$amount = $students->amount_student($id);

			if ($row) {
				$crumbs[] = [$row->topic, ''];
			}

			$data['row'] = $row;
			$data['crumbs'] = $crumbs;
			$data['amount'] = $amount;
			$data['errors'] 	= $errors;
			$this->view('single-topic-register', $data);
		} else {
			$topics = new Topics_model();

			$row = $topics->first('topic_id', $id);

			$crumbs[] = ['Dashboard', ''];
			$crumbs[] = ['Topics', 'topics'];

			if ($row) {
				$crumbs[] = [$row->topic, ''];
			}

			$limit = 10;
			$pager = new Pager($limit);
			$offset = $pager->offset;

			$page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'students';
			$lect = new Topics_model();

			$results = false;

			if ($page_tab == 'students') {

				//display student
				$query = "select users.* from topic_students join users on topic_students.user_id = users.user_id where topic_id = :topic_id && disabled = 0 order by id desc limit $limit offset $offset";
				$students = $lect->query($query, ['topic_id' => $id]);

				$data['students'] 		= $students;
			}

			$data['row'] 		= $row;
			$data['crumbs'] 	= $crumbs;
			$data['page_tab'] 	= $page_tab;
			$data['results'] 	= $results;
			$data['errors'] 	= $errors;
			$data['pager'] 		= $pager;

			$this->view('single-topic', $data);
		}
	}

	public function studentadd($id = '')
	{

		$errors = array();
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$topics = new Topics_model();
		$row = $topics->first('topic_id', $id);

		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['Topics', 'topics'];

		if ($row) {
			$crumbs[] = [$row->topic, ''];
		}

		$page_tab = 'student-add';
		$stud = new Students_model();

		$results = false;

		if (count($_POST) > 0) {

			if (isset($_POST['search'])) {

				if (trim($_POST['name']) != "") {

					//find student
					$user = new User();
					$name = "%" . trim($_POST['name']) . "%";
					$query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'student' limit 10";
					$results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
				} else {
					$errors[] = "please type a name to find";
				}
			} else
			if (isset($_POST['selected'])) {

				//add student
				$query = "select disabled,id from topic_students where user_id = :user_id && topic_id = :topic_id limit 1";

				if (!$check = $stud->query($query, [
					'user_id' => $_POST['selected'],
					'topic_id' => $id,
				])) {

					$arr = array();
					$arr['user_id'] 	= $_POST['selected'];
					$arr['topic_id'] 	= $id;
					$arr['disabled'] 	= 0;
					// $arr['date'] 		= date("Y-m-d H:i:s");

					$stud->insert($arr);
					//add topic id to score table
					$scores = new Scores_model();
					$scores->update($arr['user_id'], $arr['topic_id']);

					$this->redirect('single_topic/' . $id . '?tab=students');
				} else {

					//check if user is active
					if (isset($check[0]->disabled)) {
						if ($check[0]->disabled) {

							$arr = array();
							$arr['disabled'] 	= 0;
							$stud->update($check[0]->id, $arr);

							$this->redirect('single_topic/' . $id . '?tab=students');
						} else {

							$errors[] = "that student already belongs to this topic";
						}
					} else {
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

		$this->view('single-topic', $data);
	}


	public function studentremove($id = '')
	{

		$errors = array();
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$topics = new Topics_model();
		$row = $topics->first('topic_id', $id);


		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['Topics', 'topics'];

		if ($row) {
			$crumbs[] = [$row->topic, ''];
		}

		$page_tab = 'student-remove';
		$stud = new Students_model();

		$results = false;

		if (count($_POST) > 0) {

			if (isset($_POST['search'])) {

				if (trim($_POST['name']) != "") {

					//find student
					$user = new User();
					$name = "%" . trim($_POST['name']) . "%";
					$query = "select * from users where (firstname like :fname || lastname like :lname) && rank = 'student' limit 10";
					$results = $user->query($query, ['fname' => $name, 'lname' => $name,]);
				} else {
					$errors[] = "please type a name to find";
				}
			} else
			if (isset($_POST['selected'])) {

				//add student
				$query = "select id from topic_students where user_id = :user_id && topic_id = :topic_id && disabled = 0 limit 1";

				if ($row = $stud->query($query, [
					'user_id' => $_POST['selected'],
					'topic_id' => $id,
				])) {

					$arr = array();
					$arr['disabled'] 	= 1;

					$stud->update($row[0]->id, $arr);

					$this->redirect('single_topic/' . $id . '?tab=students');
				} else {
					$errors[] = "that student was not found in this topic";
				}
			}
		}

		$data['row'] 		= $row;
		$data['crumbs'] 	= $crumbs;
		$data['page_tab'] 	= $page_tab;
		$data['results'] 	= $results;
		$data['errors'] 	= $errors;

		$this->view('single-topic', $data);
	}

	public function register($id = null)
	{
		//check user
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$errors = array();

		// if regist

		$user_id = Auth::getUser_id();

		$topics = new Topics_model();
		$students = new Students_model();
		// số lượng sinh viên đã đăng kí đề tài này
		$amount = $students->amount_student($id);
		//lấy tất cả thông tin của đề tài đang chọn(bao gồm số sinh viên tối đa của đề tài)
		$single_topic = $topics->get_single_topic($id);

		$arr['user_id'] = $user_id;
		$arr['topic_id'] = $id;

		if (!$students->is_registed($user_id)) {
			//nếu chưa thì bắt đầu
			$students->insert($arr); //gọi hàm này để insert cho nhanh.Nếu k dc thì viết cái query insert vào
			$scores = new Scores_model();
			$scores->update($arr['user_id'], $arr['topic_id']);
			$this->redirect('single_topic/' . $id . '?tab=students');
		}
		
		if ($amount = $single_topic->members) {
			$errors['topic'] = "Quá giới hạn học sinh cho đề tài này";
			//trả lại thông báo
		} else {
			//Tiến hành đăng kí đề tài cho sinh viên
			// kiểm tra đã đăng kí đề tài nào trước chưa
			if (!$students->is_registed($user_id)) {
				//nếu chưa thì bắt đầu
				$students->insert($arr); //gọi hàm này để insert cho nhanh.Nếu k dc thì viết cái query insert vào
				$scores = new Scores_model();
				$scores->update($arr['user_id'], $arr['topic_id']);
				$this->redirect('single_topic/' . $id . '?tab=students');
			} else {
				$errors['check'] = "Bạn đã đăng kí một đề tài khác nên không thể đăng kí đề tài này";
			}
		}

		$data['errors'] = $errors;

		// $this->view('single-topic', $data);

	}

	//cancel regist
	public function unregist($id = null)
	{
		//check user
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		//lấy thông tin user
		$user = new User();
		$user_id = trim($id == '') ? Auth::getUser_id() : $id;

		$student = new Students_model();
		$student->delete($user_id);
	}
}
