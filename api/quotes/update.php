<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header( 'Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $quote->id = $data->id;

    $quote->read_single();

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    if ($quote->update()) {
        echo json_encode(array('message' => 'Quote updated successfully'));
    } else {
        echo json_encode(array('message' => 'Quote update failed'));
    }
} else {
    echo json_encode(array('message' => 'Invalid Quote ID'));
}