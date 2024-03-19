<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');

//API
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Category object
$post = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

// Delete function
if($post->delete()){
    echo json_encode(
        array('message' => 'Category Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Category Failed to Delete')
    );
}
