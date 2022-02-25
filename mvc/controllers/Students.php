<?php

/**
 * students controller
 */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Students extends Controller
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
        // $user_id = Auth::getuser_id();
		// $arr['user_id'] = $user_id;

        $query = "select * from users where rank in ('student') order by id desc limit $limit offset $offset";

        if(isset($_GET['find']))
        {
            $find = '%' . $_GET['find'] . '%';
            $query = "select * from users where rank in ('student') && (firstname like :find || lastname like :find) order by id desc limit $limit offset $offset";
            $arr['find'] = $find;
        }

        $data = $user->query($query,$arr);

        $crumbs[] = ['Dashboard',''];
        $crumbs[] = ['students','students'];

        if(Auth::access('lecturer')){
            $this->view('students',[
                'rows'=>$data,
                'crumbs'=>$crumbs,
                'pager'=>$pager,
            ]);
        }else{
            $this->view('access-denied');
        }
    }

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

        if(Auth::access('lecturer') || Auth::access('admin'))
        {
            //start export
            //get data from db
            $scores = new Scores_model();
            $datas = $scores->get_excel_data(); 

            //create excel file
            $fileName = 'Student score list-'.date('Y-m-d'); 
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            //set format of file
            $sheet->setCellValue('A1','Kết quả đánh giá thực tập');
            $sheet->setCellValue('A2', 'First_Name');
            $sheet->setCellValue('B2', 'Last_Name');
            $sheet->setCellValue('C2', 'Topic');
            $sheet->setCellValue('D2', 'Score');
            
            $rowCount = 3;
            foreach($datas as $data)
            {
                //write data to file
                $sheet->setCellValue('A' . $rowCount, $data->firstname);
                $sheet->setCellValue('B' . $rowCount, $data->lastname);
                $sheet->setCellValue('C' . $rowCount, $data->topic_id);
                $sheet->setCellValue('D' . $rowCount, $data->score);
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
            $errors[] = "There are some problem while export file";
        }

    }
}
