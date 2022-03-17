<?php

/**
 * Students Model
 */
class Students_model extends Model
{
    protected $table = 'topic_students';

    protected $allowedColumns = [
        'user_id',
        'topic_id',
        'disabled',
        'date',
    ];

    protected $beforeInsert = [];

    protected $afterSelect = [
        'get_user',
    ];


    public function get_user($data)
    {

        $user = new User();
        foreach ($data as $key => $row) {
            // code...
            if (isset($row->user_id)) {
                $result = $user->where('user_id', $row->user_id);
                $data[$key]->user = is_array($result) ? $result[0] : false;
            }
        }

        return $data;
    }

    public function is_registed($id)
    {
        $query = "SELECT * FROM topic_students WHERE user_id = '$id'";
        $data = $this->query($query);

        if($data) {
            return true;
        }

        return false;
    }

    public function regist($user,$id)
    {
        $query = "INSERT INTO topic_students VALUES ($user,$id)";
        return $this->query($query);
    }

    public function amount_student($id)
    {
        $query = "SELECT count(topic_students.user_id) as amount FROM topics LEFT JOIN topic_students on topics.topic_id = topic_students.topic_id WHERE topics.topic_id = '$id' GROUP BY topics.topic_id ";
        $data = $this->query($query);

        if(is_array($data)){
            $data = $data[0];
        }
        return $data;
    }
}
