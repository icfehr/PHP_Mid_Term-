<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');

//API
include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connection
$database = new Database();
$db = $database->connect();

// Instantiate Author object
$post = new Author($db);

$data = json_decode(file_get_contents("php://input"));

$post->author = $data->author;

//CREATE

if($post->create()){
    echo json_encode(
        array('message' => 'Author Created')
    );
}else{
    echo json_encode(
        array('message' => 'Author Failed to Create')
    );
}
