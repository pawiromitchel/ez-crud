<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../vendor/autoload.php';
$app = new \Slim\App;

// autoload classes
spl_autoload_register(function($class){
    require_once "../classes/{$class}.php";
});

// this is the main route of the application
$app->any('/{table}[/{id}]', function ($request, $response, $args) {

    // connect to the database
    $connector = DB::connect("localhost", "app_nais", "root", "");

    // the route args
    $table = $args['table'];

    // get coloms
    if (isset($_GET['coloms'])) {
        // select only the coloms
        $coloms = $_GET['coloms'];
        print_r($coloms);
    } else {
        // select all
        $coloms = "*";
    }

    // check if there is a id Parameter
    if(isset($args['id'])){
        $id = $args['id'];
        $where = "WHERE id=$id";
    }

    // ORDER BY colom_name
    if (isset($_GET['orderBy'])) {
        $orderBy = 'ORDER BY ' . $_GET['orderBy'];
    }

    // sorting = DESC or ASC
    if (isset($_GET['sorting'])) {
        $sorting = $_GET['sorting'];
    }
    
    // if the request is a GET request
    // GET data from the table
    if ($request->isGet()){
        print_r(json_encode(DB::query("SELECT $coloms FROM $table $where $orderBy $sorting", $connector)));
    }

    // if the request is a POST request
    // INSERT a new row
    if ($request->isPost()) {

        // make the tablename part
        foreach ($_REQUEST as $key => $value) {
            $colom_names .= $key . ',';
        }

        // make the values part
        foreach ($_REQUEST as $key => $value) {
            $values .= "'" . $value . "',";
        }

        // the output
        $colom_names = substr($colom_names, 0, -1);
        $values = substr($values, 0, -1);

        print_r(json_encode(DB::insert("INSERT INTO $table ($colom_names) VALUES ($values)", $connector)));
    }

    // if the request is a DELETE request
    // DELETE a row
    if ($request->isDelete()) {
        print_r(json_encode(DB::delete("DELETE FROM $table $where", $connector)));
    }

    // if the request is a PUT request
    // UPDATE a row
    if ($request->isPut) {
        // make the SET part
        foreach ($_REQUEST as $key => $value) {
            $set_values .= $key . "='" . $value . "',";
        }

        $set_values = substr($set_values, 0, -1);

        print_r(json_encode(DB::insert("UPDATE FROM $table SET $set_values $where", $connector)));
    }
});

// for testing out some functions
$app->post('/test/', function($request, $response, $args){
    
});

// run the application
$app->run();
?>