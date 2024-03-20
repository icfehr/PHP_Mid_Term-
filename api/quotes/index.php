<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';
include_once '../../models/Category.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);
$author = new Author($db);
$category = new Category($db);

$data = $quote->read();
$num = $data['rowCount'];
$result = $data['result'];

if ($num > 0) {
    $quotes_arr = array();
    $quotes_arr['data'] = array();

    foreach ($result as $row) {
        extract($row);

        $author->id = $author_id;
        $author->read_single();

        $category->id = $category_id;
        $category->read_single();

        $quote_item = array(
            "id" => $id,
            "quote" => $quote, 
            "author" => $author->author,
            "category" => $category->category
        );

        array_push($quotes_arr['data'], $quote_item);
    }

    echo json_encode($quotes_arr);
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}

echo json_encode(array('message' => 'Quotes API endpoint'));
