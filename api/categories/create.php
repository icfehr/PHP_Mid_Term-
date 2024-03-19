<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');

//API
include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Category object
$post = new Category($db); 

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->category = $data->category;

//CREATE

if($post->create()){
    echo json_encode(
        array('message' => 'Category Created')
    );
}else{
    echo json_encode(
        array('message' => 'Category Failed to Create')
    );
}
