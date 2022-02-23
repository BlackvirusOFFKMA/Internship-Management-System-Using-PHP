<?php

/**
 * User Model
 */
class User extends Model
{

    protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'rank',
        'date',

    ];

    protected $beforeInsert = [
        'make_user_id',
        'hash_password'
    ];

    protected $beforeUpdate = [
        'hash_password'
    ];

   
  


    public function validate($DATA, $id = '')
    {
        $this->errors = array();

        //check for first name
        if (empty($DATA['firstname']) || !preg_match('/^[A-Za-zÀÁÂÃÈÉÊỄÌÍÒÓÔÕÙÚÝàáâãèéêễìíòóôõùúýĂăĐđĨĩŨũƠơƯưẠ-ỹ\s]+$/i', $DATA['firstname'])) {
            $this->errors['firstname'] = "Only letters allowed in first name";
        }

        //check for last name
        if (empty($DATA['lastname']) || !preg_match('/^[A-Za-zÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚÝàáâãèéêìíòóôõùúýĂăĐđĨĩŨũƠơƯưẠ-ỹ\s]+$/i', $DATA['lastname'])) {
            $this->errors['lastname'] = "Only letters allowed in last name";
        }

        //check for email
        if (empty($DATA['email']) || !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        }

        //check if email exists
        if (trim($id) == "") {
            if ($this->where('email', $DATA['email'])) {
                $this->errors['email'] = "That email is already in use";
            }
        } else {
            if ($this->query("select email from $this->table where email = :email && user_id != :id", ['email' => $DATA['email'], 'id' => $id])) {
                $this->errors['email'] = "That email is already in use";
            }
        }

        //check for password
        if (isset($DATA['password'])) {

            if (empty($DATA['password']) || $DATA['password'] !== $DATA['password2']) {
                $this->errors['password'] = "Passwords do not match";
            }

            //check for password length
            if (strlen($DATA['password']) < 8) {
                $this->errors['password'] = "Password must be at least 8 characters long";
            }
        }

        //check for gender
        $genders = ['female', 'male'];
        if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
            $this->errors['gender'] = "Gender is not valid";
        }

        //check for gender
        $ranks = ['student', 'lecturer', 'admin'];
        if (empty($DATA['rank']) || !in_array($DATA['rank'], $ranks)) {
            $this->errors['rank'] = "Rank is not valid";
        }

        //check for score
        if(isset($DATA['score'])){
            if(!is_numeric($DATA['score']) || $DATA['score'] > 10 || $DATA['score'] < 0) 
        if(!is_numeric($DATA['score']) || $DATA['score'] > 10 || $DATA['score'] < 0) 
            if(!is_numeric($DATA['score']) || $DATA['score'] > 10 || $DATA['score'] < 0) 
            {
                $this->errors['score'] = "Score is not valid";
            }
        }
        


        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    

    public function make_user_id($data)
    {
        function convert_vi_to_en($str) {
            $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
            $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
            $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
            $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
            $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
            $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
            $str = preg_replace("/(đ)/", "d", $str);
            //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
            return $str;
        }

        $data['user_id'] = convert_vi_to_en(str_replace(' ', '', strtolower($data['firstname'] . "." . $data['lastname'])));

        while ($this->where('user_id', $data['user_id'])) {
            $data['user_id'] .= rand(10, 9999);
        }

        return $data;
    }

    public function hash_password($data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}
