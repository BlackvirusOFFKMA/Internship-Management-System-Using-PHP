<?php

/**
 * Students Model
 */
class Students_model extends Model
{
    protected $table = 'class_students';

    protected $allowedColumns = [
        'user_id',
        'class_id',
        'disabled',
        'date',
    ];

    protected $beforeInsert = [
        'make_school_id',
    ];

    protected $afterSelect = [
        'get_user',
    ];


    public function get_user($data)
    {

        $user = new User();
        foreach ($data as $key => $row) {
            // code...
            if(isset($row->user_id)){
                $result = $user->where('user_id',$row->user_id);
                $data[$key]->user = is_array($result) ? $result[0] : false;
            }
        }

        return $data;
    }




}