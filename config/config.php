<?php
    
    // configs
    $dbengine = 'mysql';
    $hostname = 'localhost';
    $database = 'healthy_do';
    $username = 'root';
    $password = '';
    $charset = 'utf8';

    // custom routes
    $config_pixie = array(
        'driver'    => $dbengine, // Db driver
        'host'      => $hostname,
        'database'  => $database,
        'username'  => $username,
        'password'  => $password,
        'charset'   => $charset, // Optional
        // 'collation' => 'utf8_unicode_ci', // Optional
        // 'prefix'    => 'cb_', // Table prefix, optional
    );

    // generated routes
    $config_api_generator = array(
        'dbengine'=> $dbengine,
        'hostname'=> $hostname,
        'username'=> $username,
        'password'=> $password,
        'database'=> $database,
        'charset'=> $charset,
    );
?>