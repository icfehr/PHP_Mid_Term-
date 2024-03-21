<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Author object
$authorObj = new Author($db);

// Get author_id from query parameters
$authorObj->id = isset($_GET['author_id']) ? $_GET['author_id'] : die();

// Get the author
$authorObj->read_single();

if($authorObj->author != null){
    // Create array
    $author_arr = array(
        "id" =>  $authorObj->id,
        "author" => $authorObj->author
    );

    // Make JSON
    print_r(json_encode($author_arr));
} else {
    echo json_encode(
        array("message" => "Author not found.")
    );
}
