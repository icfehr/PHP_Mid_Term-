<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db); // Init the Quote model

$result = $quote->read();

$num = $result->rowCount();

if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            "id" => $id,
            "quote" => $quote, 
            "author_id" => $author_id,
            "category_id" => $category_id
        );

        array_push($posts_arr['data'], $post_item);
    }

    echo json_encode($posts_arr);
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}