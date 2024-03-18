<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json')
header( 'Access-Control-Allow-Methods: POST')
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow')


//API
include_once '../../config/Database.php';
//Post
$post = new Category($db); 

$data = json_decode(file_get_contents("php://input"))

$post->id = $data->id;
$post->category_name = $data->category_name;

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

