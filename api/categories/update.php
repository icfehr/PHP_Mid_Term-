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

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $post->id = $data->id;
    $post->read_single();
    $post->category = $data->category;
    if ($post->update()) {
        echo json_encode(array('message' => 'Category updated successfully'));
    } else {
        echo json_encode(array('message' => 'Category update failed'));
    }
} else {
    echo json_encode(array('message' => 'Invalid Category ID'));
}
