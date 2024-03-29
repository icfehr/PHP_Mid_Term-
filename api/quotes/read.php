<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

$data = $quote->read();
$num = $data['rowCount'];
$result = $data['result'];

if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();

    foreach ($result as $row) {
        extract($row);

        $post_item = array(
            "id" => $id,
            "quote" => $quote, 
            "author_id" => $author_id,
            "category_id" => $category_id
        );

        array_push($posts_arr['data'], $post_item);
    }

    http_response_code(200);
    echo json_encode($posts_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
