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

// Get all authors
$result = $authorObj->read();

$num = $result->rowCount();

if ($num > 0) {
    $authors_arr = array();
    $authors_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item = array(
            "id" => $id,
            "author" => $author
        );

        array_push($authors_arr['data'], $author_item);
    }

    // Make JSON
    print_r(json_encode($authors_arr));
} else {
    echo json_encode(
        array('message' => 'No Authors Found')
    );
};
