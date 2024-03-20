<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

if (!is_null($data) && isset($data->id)) {
    $quote->id = $data->id;

    if($quote->delete()){
        http_response_code(200);
        echo json_encode(
            array('message' => 'Quote Deleted')
        );
    } else {
        http_response_code(400);
        echo json_encode(
            array('message' => 'Quote Failed to Delete')
        );
    }
} else {
    http_response_code(400);
    echo json_encode(
        array('message' => 'Invalid or missing Quote ID')
    );
}
