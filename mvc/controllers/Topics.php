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
		} elseif (Auth::getRank() == 'student') {
			$topic = new Topics_model();

			$query = "SELECT topics.* FROM topics LEFT JOIN topic_students on topics.topic_id = topic_students.topic_id GROUP BY topics.topic_id HAVING COUNT(topic_students.user_id) < topics.members ORDER BY id DESC";

			$arr = array();

			if (isset($_GET['find'])) {
				$find = '%' . $_GET['find'] . '%';
				$query = "SELECT topics.* FROM topics LEFT JOIN topic_students on topics.topic_id = topic_students.topic_id WHERE topics.topic like :find GROUP BY topics.topic_id HAVING COUNT(topic_students.user_id) < topics.members ORDER BY id DESC";
				$arr['find'] = $find;
			}

			$data = $topics->query($query, $arr);
		}

		$crumbs[] = ['Trang chủ', ''];
		$crumbs[] = ['Đề tài', 'topics'];

		$this->view('topics', [
			'crumbs' => $crumbs,
			'rows' => $data
		]);
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
	//không hiểu sao thêm phần lấy số lượng sinh viên của đề tài thì xuất hiện lỗi
	public function view_topic_register($id = null)
	{
		//check user
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}

		$crumbs[] = ['Trang chủ', ''];
		$crumbs[] = ['Đề tài', 'topics'];

		//get topic infor
		$topics = new Topics_model();
		$data = $topics->get_single_topic($id);

		//get number of student
		$amount = $topics->amount_student($id);

		$crumbs[] = [$data->topic_id, ''];

		$this->view('topic-register', [
			'crumbs' => $crumbs,
			'amount' => $amount,
			'data' => $data
		]);
	}

	public function register($id = null)
	{
		//check user
		if (!Auth::logged_in()) {
			$this->redirect('login');
		}
		// if regist
		if (isset($_GET['regist'])) {

			//specify the user
			$user = new User();
			$user_id = trim($id == '') ? Auth::getUser_id() : $user_id;

			$topics = new Topics_model();
			// số lượng sinh viên đã đăng kí đề tài này
			$amount = $topics->amount_student($id);
			//lấy tất cả thông tin của đề tài đang chọn(bao gồm số sinh viên tối đa của đề tài)
			$single_topic = $topics->get_single_topic($id);
			//nếu đã đủ sinh viên đăng kí
			if ($amount->amount = $single_topic->amount) 
			{
				$this->errors['topic'] = "Quá giới hạn học sinh cho đề tài này";
				//trả lại thông báo
			} else {
				//Tiến hành đăng kí đề tài cho sinh viên
				// kiểm tra đã đăng kí đề tài nào trước chưa
				if($topics->is_registed())//lấy user_id của người dùng hiện tại để check(nhưng chưa biết lấy sao)
				{
					//nếu chưa thì bắt đầu
				}
				else
				{
					$this->errors['check'] = "Bạn đã đăng kí một đề tài khác nên không thể đăng kí đề tài này";
				}
				
			}
		}

		$errors = array();

		//$this->view('topic-register');
	}

	//cancel regist
	public function unregist($id = null)
	{

	}
}
