<?php
// require all pakages provided by Composer
require '../vendor/autoload.php';

// require the configs needed to connect to the DB
require 'config.php';

// new Slim App
$app = new \Slim\App;

// the READ route
$app->any('/read/{table}[/{id}]', function ($request, $response, $args) {
    // READ ByID
    if (isset($args['id'])) {
        $query = DB::table($args['table'])->find($args['id']);
    } else {
        $query = DB::table($args['table'])->get();
    }
    // return the query
    print_r(json_encode($query));
});

// the CREATE route
$app->post('/create/{table}', function($request, $response, $args){
    $data   = $request->getParsedBody();
    $query  = QB::table($args['table'])->insert($data);
    print_r(json_encode($query));
});

// the UPDATE route
$app->put('/create/{table}/{id}', function($request, $response, $args){
    $data   = $request->getParsedBody();
    $query  = QB::table($args['table'])->where('id', $args['id'])->update($data);
    print_r(json_encode($query));
});

// the DELETE route
$app->delete('/create/{table}/{id}', function($request, $response, $args){
    $data   = $request->getParsedBody();
    $query  = QB::table($args['table'])->where('id', $args['id'])->delete();
    print_r(json_encode($query));
});

// run the application
$app->run();
?>