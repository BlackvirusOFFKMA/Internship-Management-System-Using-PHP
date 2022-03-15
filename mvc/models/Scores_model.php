<?php
    class Scores_model extends Model
    {
        protected $table = 'scores';

        protected $allowedColumns = [
            'topic_id',
            'user_id',
            'score',
            'note',
        ];
    
        protected $beforeInsert = [];
    
        protected $afterSelect = [
            'get_user'
        ];


        public function get_excel_data()
        {
            $query = "SELECT firstname, lastname, topic_id, score FROM users LEFT JOIN scores ON users.user_id = scores.user_id WHERE users.rank = 'student'";
            return $this->query($query);
        }

        public function insert($data)
        {
            $query = "INSERT INTO scores(user_id) VALUES ('$data')";
            return $this->query($query);
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

        public function update($user_id, $topic_id)
        {
            $query = "UPDATE scores set topic_id = '$topic_id' WHERE user_id = '$user_id'";
            return $this->query($query);
        }
    }
?> 