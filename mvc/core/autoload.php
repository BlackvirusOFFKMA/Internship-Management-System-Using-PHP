<?php

    require "Config.php";
    require "function.php";
    require "DB.php";
    require "Controller.php";
    require "model.php";
    require "App.php";
    require "../mvc/core/PhpSpreadsheed/vendor/autoload.php";

spl_autoload_register(function($class_name){
    require "../mvc/models/". ucfirst($class_name) . ".php";
});