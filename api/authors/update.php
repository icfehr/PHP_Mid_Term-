<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header( 'Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');


//API
include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Post

$post = new Author($db);

$data = json_decode(file_get_contents("php://input"))

$post->id = $data->id;
$post->category_name = $data->category_name;
$post->author = $data->author;

//CREATE

if ($post->update()) {
    echo json_encode(
        array('message' => 'Author Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Author Failed to Updated')
    );
}

