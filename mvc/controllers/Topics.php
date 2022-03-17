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
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$topics = new Topics_model();
		$students = new Students_model();
		$stud_id = Auth::getUser_id();

		//
		if (Auth::access('admin')) {

			$query = "select * from topics order by id desc";

			$arr = array();

			if (isset($_GET['find'])) {
				$find = '%' . $_GET['find'] . '%';
				$query = "select * from topics where topic like :find order by id desc";
				$arr['find'] = $find;
			}

			$data = $topics->query($query, $arr);

			$crumbs[] = ['Trang chủ', ''];
		$crumbs[] = ['Đề tài', 'topics'];

		$this->view('topics', [
			'crumbs' => $crumbs,
			'rows' => $data
		]);
		} elseif (Auth::access('lecturer')) {

			$topic = new Topics_model();

			$query = "select * from topics where user_id = :user_id && disabled = 0";
			$arr['user_id'] = Auth::getUser_id();

			if (isset($_GET['find'])) {
				$find = '%' . $_GET['find'] . '%';
				$query = "select topics.* from topics where topics.user_id = :user_id && topics.disabled = 0 && topics.topic like :find ";
				$arr['find'] = $find;
			}

			$arr['stud_topics'] = $topic->query($query, $arr);
			$data = array();
			if ($arr['stud_topics']) {
				foreach ($arr['stud_topics'] as $key => $arow) {
					// code...
					$data[] = $topic->first('topic_id', $arow->topic_id);
				}
			}

			$crumbs[] = ['Trang chủ', ''];
		$crumbs[] = ['Đề tài', 'topics'];

		$this->view('topics', [
			'crumbs' => $crumbs,
			'rows' => $data
		]);
		} elseif (Auth::getRank() == 'student' && !$students->is_registed($stud_id)) {
			$topic = new Topics_model();

			$query = "SELECT topics.* FROM topics LEFT JOIN topic_students on topics.topic_id = topic_students.topic_id GROUP BY topics.topic_id HAVING COUNT(topic_students.user_id) < topics.members ORDER BY id DESC";

			$arr = array();

			if (isset($_GET['find'])) {
				$find = '%' . $_GET['find'] . '%';
				$query = "SELECT topics.* FROM topics LEFT JOIN topic_students on topics.topic_id = topic_students.topic_id WHERE topics.topic like :find GROUP BY topics.topic_id HAVING COUNT(topic_students.user_id) < topics.members ORDER BY id DESC";
				$arr['find'] = $find;
			}

			$data = $topics->query($query, $arr);

			$crumbs[] = ['Trang chủ', ''];
		$crumbs[] = ['Đề tài', 'topics'];

		$this->view('topics', [
			'crumbs' => $crumbs,
			'rows' => $data
		]);
		} elseif ((Auth::getRank() == 'student') && $students->is_registed($stud_id)) {

			$errors = array();

			$students = new Students_model();
			
			$query = "SELECT * FROM topic_students WHERE user_id = '$stud_id'";
			
			$arr = array();

			$topic_stud = $students->query($query);
			$id = $topic_stud[0]->topic_id;
			$this->redirect('single_topic/' . $id . '?tab=students');
		}

		
	}

	public function add()
	{
		// code...
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$errors = array();
		if (count($_POST) > 0) {

			$topics = new Topics_model();
			if ($topics->validate($_POST)) {

				$_POST['create_date'] = date("Y-m-d H:i:s");

				$topics->insert($_POST);
				$this->redirect('Topics');
			} else {
				//errors
				$errors = $topics->errors;
			}
		}

		$crumbs[] = ['Trang chủ', ''];
		$crumbs[] = ['Đề tài', 'Topics'];
		$crumbs[] = ['Thêm', 'Topics/add'];

		$this->view('Topics.add', [
			'errors' => $errors,
			'crumbs' => $crumbs,

		]);
	}

	public function edit($id = null)
	{
		// code...
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$topics = new Topics_model();

		$errors = array();
		if (count($_POST) > 0 && Auth::access('lecturer')) {

			if ($topics->validate($_POST)) {
				print_r($_POST);
				$topics->update($id, $_POST);
				$this->redirect('Topics');
			} else {
				//errors
				$errors = $topics->errors;
			}
		}

		$row = $topics->where('id', $id);

		$crumbs[] = ['Trang chủ', ''];
		$crumbs[] = ['Đề tài', 'topics'];
		$crumbs[] = ['Chỉnh sửa', 'Topics/edit'];

		if (Auth::access('lecturer') && Auth::i_own_content($row)) {

			$this->view('topics.edit', [
				'row' => $row,
				'errors' => $errors,
				'crumbs' => $crumbs,
			]);
		} else {
			$this->view('access-denied');
		}
	}

	public function delete($id = null)
	{
		// code...
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}


		$topics = new Topics_model();

		$errors = array();

		if (count($_POST) > 0 && Auth::access('lecturer')) {

			$topics->Delete($id);
			$this->redirect('Topics');
		}

		$row = $topics->where('id', $id);

		$crumbs[] = ['Dashboard', ''];
		$crumbs[] = ['Topics', 'Topics'];
		$crumbs[] = ['Delete', 'Topics/delete'];

		if (Auth::access('lecturer') && Auth::i_own_content($row)) {

			$this->view('Topics.delete', [
				'row' => $row,
				'crumbs' => $crumbs,
			]);
		} else {
			$this->view('access-denied');
		}
	}

	
}
