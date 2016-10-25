<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../vendor/autoload.php';
$app = new \Slim\App;

// this is the main route of the application
$app->any('/{table}[/{id}]', function ($request, $response, $args) {

    // make the database connection
    include 'database.php';

    // connect to the database
    $connector = DB::connect("localhost", "app_nais", "root", "");

    // the route args
    $table = $args['table'];

    // get coloms
    if (isset($_GET['coloms'])) {
        // select only the coloms
        $coloms = $_GET['coloms'];
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
        $orderBy = $_GET['orderBy'];
        $orderBy = str_replace(',', ' ', $orderBy);
        $orderBy = 'ORDER BY ' . $orderBy;
    }

    // detect for filter
    if (isset($_GET['filter'])) {
        $filter     = $_GET['filter'];

        foreach ($filter as $key => $value) {

            // take the last word
            $last_word = explode(",", $value);
            $last_word = $last_word[count($last_word)-1];
            
            // change the last word into anything
            if (strpos($value, 'eq')) {
                $value = str_replace($last_word, "'" . $last_word . "'", $value) . $operator;
            } elseif(strpos($value, 'cs')){
                $value = str_replace($last_word, "'%" . $last_word . "%'", $value) . $operator;
            }
            
            // manipulate the string
            $value = str_replace(',', '', $value) . $operator;
            

            // if the filter_type = equal
            if (strpos($value, 'eq')) {
                $clause = "=";
                $value = str_replace('eq', $clause, $value);
            }

            // if the filter_type = contain string
            if (strpos($value, 'cs')) {
                $clause= " LIKE ";
                $value = str_replace('cs', $clause, $value);
            }

            $filter_str .= $value;
        }
        // make the string into a usable part of a query
        $filter_str = " WHERE " . $filter_str;
    }

    if (isset($_GET['join'])) {
        $join = $_GET['join'];

        // print_r($join);

        $filter_str = "";
        foreach ($join as $key => $value) {
            $value = str_replace(',', ' ON ', $value) . $operator;
            $value = str_replace('=', ' = ', $value);
            // print_r(" INNER JOIN " . $value);
            $filter_str .= " INNER JOIN " . $value;
        }
    }
    
    // GET data from the table
    if ($request->isGet()){
        // print_r("SELECT $coloms FROM $table $filter_str $orderBy $sorting");
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

    // print the $run
    print_r(json_encode($run));
});

// for custom query
$app->post('/custom_query/', function($request, $response, $args){
    $sql = $_POST['sql'];
    // make the database connection
    include 'database.php';
    // the query
    $run = DB::query($sql, $connector);
    // return something
    print_r(json_encode($run));
});

// run the application
$app->run();
?>