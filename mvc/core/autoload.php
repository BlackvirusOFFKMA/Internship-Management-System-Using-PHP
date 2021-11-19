<?php

    require "App.php";
    require "Config.php";
    require "Controller.php";
    require "DB.php";
    require "function.php";

spl_autoload_register(function($class_name){

    require "../mvc/models/". ucfirst($class_name) . ".php";
});