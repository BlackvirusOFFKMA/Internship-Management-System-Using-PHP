<?php
class Controller{

    public function model($model){
        if(file_exists("../mvc/models/".ucfirst($model).".php"))
        {
            require("../mvc/models/".ucfirst($model).".php");
            return $model = new $model();
        }

        return false;
    }

    public function view($view, $data=[]){
        extract($data);

        if(file_exists("../mvc/views/" . $view . ".view.php"))
        {
            require ("../mvc/views/" . $view . ".view.php");
        }else{
            require ("../mvc/views/404.view.php");
        }
    }

    public function redirect($link)
    {
        header("Location: ". ROOT . "/".trim($link,"/"));
        die;
    }

}
?>