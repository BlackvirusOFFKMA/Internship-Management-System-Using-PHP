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
?>