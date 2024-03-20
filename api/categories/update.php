<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $category->id = $data->id;
    $category->category = $data->category;
    $category->read_single();
    if ($category->update()) {
        echo json_encode(array('message' => 'Category updated successfully'));
    } else {
        echo json_encode(array('message' => 'Category update failed'));
    }
} else {
    echo json_encode(array('message' => 'Invalid Category ID'));
}
