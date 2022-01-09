<?php

/**
 * Topics Model
 */
class Topics_model extends Model
{
    protected $table = 'topics';

	protected $allowedColumns = [
        'topic',
        'date',
    ];

    protected $beforeInsert = [
        'make_topic_id',
        'make_user_id',
    ];

    protected $afterSelect = [
        'get_user',
    ];


    public function validate($DATA)
    {
        $this->errors = array();

        //check for topic name
        if(empty($DATA['topic']) || !preg_match('/^[a-z A-Z0-9]+$/', $DATA['topic']))
        {
            $this->errors['topic'] = "Only letters & numbers allowed in topic name";
        }
 
        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }


    public function make_user_id($data)
    {
        if(isset($_SESSION['USER']->user_id)){
            $data['user_id'] = $_SESSION['USER']->user_id;
        }
        return $data;
    }

    public function make_topic_id($data)
    {
        
        $data['topic_id'] = random_string(60);
        return $data;
    }

    public function get_user($data)
    {
        
        $user = new User();
        foreach ($data as $key => $row) {
            // code...
            $result = $user->where('user_id',$row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
        }
       
        return $data;
    }

    

 
}