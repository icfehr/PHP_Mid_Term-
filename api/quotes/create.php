<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');

// Include Database and Quote classes
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

// Instantiate Quote class
$post = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->quote = $data->quote;
$post->category_id = $data->category_id;
$post->author_id = $data->author_id;

// Create quote
if($post->create()){
    echo json_encode(
        array('message' => 'Author Created')
    );
}else{
    echo json_encode(
        array('message' => 'Author Failed to Create')
    );
}
