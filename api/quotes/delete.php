<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');

// Include Database and Quote classes
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

// Instantiate Quote class
$post = new Quote($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

// Delete quote
if($post->delete()){
    http_response_code(200);
    echo json_encode(
        array('message' => 'Quote Deleted')
    );
}else{
    http_response_code(400);
    echo json_encode(
        array('message' => 'Quote Failed to Delete')
    );
}
