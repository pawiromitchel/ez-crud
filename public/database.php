<?php

    // autoload the classes
    spl_autoload_register(function($class){
        require_once "../classes/{$class}.php";
    });

    // connect to the database
    $connector = DB::connect("localhost", "app_nais", "root", "");

?>