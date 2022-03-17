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
        $query = "SELECT COUNT(topic_id) AS amount FROM `topic_students` WHERE topic_id = '$id'";
        $data = $this->query($query);

        if(is_array($data)){
            $data = $data[0];
        }
        return $data;
    }

    public function regist($user,$id)
    {
        $query = "INSERT INTO topic_students VALUES ($user,$id)";
        $data = $this->query($query);

        if(is_array($data)){
            $data = $data[0];
        }
        return $data;
    }

    public function amount_student($id)
    {
        $query = "SELECT COUNT(topic_id) AS amount FROM `topic_students` WHERE topic_id = '$id'";
        $data = $this->query($query);

        if(is_array($data)){
            $data = $data[0];
        }
        return $data;
    }
}
