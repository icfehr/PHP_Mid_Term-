<?php

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connection
$database = new Database();
$db = $database->connect();

// Instantiate Category object
$post = new Category($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();
$post->read_single();

$category_arr = array(
    'id' => $post->id,
    'category' => $post->category
);

// Make JSON
print_r(json_encode($category_arr));
