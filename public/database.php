<?php
    // autoload classes
    spl_autoload_register(function($class){
        require_once "../modals/{$class}.php";
    });

    // connect to the database
    $connector = DB::connect("localhost", "app_nais", "root", "");
?>