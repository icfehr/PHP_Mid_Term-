<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json')
header( 'Access-Control-Allow-Methods: DELETE')
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow')


//API
include_once '../../config/Database.php';

//Post
$post = new category($db);

//Raw Data
$data = json_decode(file_get_contents("php://input"))

$post->id = $data->id;
//Delete Function

if($post->delete()){
    echo json_encode(
        array('message' => 'Author Delete')
    );
}else{
    echo json_encode(
        array('message' => 'Author Failed to Delete')
    );
}

