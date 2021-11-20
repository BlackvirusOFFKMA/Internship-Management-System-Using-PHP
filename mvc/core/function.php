<?php

function get_var($key,$default = "")
{

    if(isset($_POST[$key]))
    {
        return $_POST[$key];
    }

    return $default;
}

function get_select($key,$value)
{
    if(isset($_POST[$key]))
    {
        if($_POST[$key] == $value)
        {
            return "selected";
        }
    }

    return "";
}

function views_path($view)
{
    if(file_exists("../mvc/views/" . $view . ".inc.php"))
    {
        return ("../mvc/views/" . $view . ".inc.php");
    }else{
        return ("../mvc/views/404.view.php");
    }
}
?>