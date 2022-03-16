<?php

/**
 * users controller
 */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

	//xuất file giáo viên nào quản lý đề tài nào
	function export($id = '')
    {
        //check login
        if(!Auth::logged_in())
        {
            $this->redirect('login');
        }
        $errors = array();

        $user = new User();
		$id = trim($id == '') ? Auth::getUser_id() : $id;

        if(Auth::access('admin'))
        {
            //start export
            //get data from db
            $datas = $user->get_excel_data(); 

            //create excel file
            $fileName = 'Topic belong to lecture-'.date('Y-m-d'); 
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            //set format of file
            $sheet->setCellValue('A1','Đề tài do giáo viên quản lý');
            $sheet->setCellValue('A2', 'Họ');
            $sheet->setCellValue('B2', 'Tên');
            $sheet->setCellValue('C2', 'Mã đề tài');
			$sheet->setCellValue('D2', 'Tên đề tài');
            $sheet->setCellValue('E2', 'Số thành viên tối đa');
            
            $rowCount = 3;
            foreach($datas as $data)
            {
                //write data to file
                $sheet->setCellValue('A' . $rowCount, $data->firstname);
                $sheet->setCellValue('B' . $rowCount, $data->lastname);
                $sheet->setCellValue('C' . $rowCount, $data->topic_id);
                $sheet->setCellValue('D' . $rowCount, $data->topic);
				$sheet->setCellValue('E' . $rowCount, $data->members);
                $rowCount++;
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
            $fileName = $fileName.'.xlsx';
            ob_end_clean();
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename='. $fileName);
            header('Cache-Control: max-age=0');
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');

        } else {
            $errors[] = "Xảy ra lỗi khi xuất file";
        }

    }
}
