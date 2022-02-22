<?php
    class Scores_model extends Model
    {
        public function get_excel_data()
        {
            $query = "SELECT firstname, lastname, topic_id, score FROM users LEFT JOIN scores ON users.user_id = scores.user_id WHERE users.rank = 'student'";
            return $this->query($query);
        }
    }
?> 