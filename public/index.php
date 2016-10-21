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
        $filter_str = "WHERE id=$id";
    }

    // ORDER BY colom_name
    if (isset($_GET['orderBy'])) {
        $orderBy = 'ORDER BY ' . $_GET['orderBy'];
    }

    // sorting = DESC or ASC
    if (isset($_GET['sorting'])) {
        $sorting = $_GET['sorting'];
    }

    // detect for filter
    if (isset($_GET['filter'])) {
        $filter     = $_GET['filter'];
        $operator   = "";
        $clause     = "";
        foreach ($filter as $key => $value) {
            // if the filter_type = equal
            if (strpos($value, 'eq') && $value !== end($filter)) {
                $operator = " AND ";
                $clause= "=";
            } else {
                $operator  = "";
                $clause= "=";
            }
            // take the last word
            $last_word = explode(",", $value);
            $last_word = $last_word[count($last_word)-1];
            // make the last word as a string
            $value = str_replace($last_word, "'" . $last_word . "'", $value) . $operator;
            // manipulate the string
            $value = str_replace(',', '', $value) . $operator;
            $value = str_replace('eq', $clause, $value);

            $filter_str .= $value;
        }
        // make the string into a usable part of a query
        $filter_str = " WHERE " . $filter_str;
    }
    
    // GET data from the table
    if ($request->isGet()){
        $run = DB::query("SELECT $coloms FROM $table $filter_str $orderBy $sorting", $connector);
    }

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
        $run = DB::insert("INSERT INTO $table ($colom_names) VALUES ($values)", $connector);
    }

    // DELETE a row
    if ($request->isDelete()) {
        $run = DB::delete("DELETE FROM $table $where", $connector);
    }

    // UPDATE a row
    if ($request->isPut) {
        // make the SET part
        foreach ($_REQUEST as $key => $value) {
            $set_values .= $key . "='" . $value . "',";
        }
        $set_values = substr($set_values, 0, -1);
        $run = DB::insert("UPDATE FROM $table SET $set_values $where", $connector);
    }

    // run the $run
    print_r(json_encode($run));
});

// for testing out some functions
$app->post('/test/', function($request, $response, $args){
    
});

// run the application
$app->run();
?>