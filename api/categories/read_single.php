<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

///INST DB and CONN

$database = new Database();
$db = $database->connect();

//POST

$post = new Author($db);

$post -> id = isset($_GET['id']) ? $_GET['id'] : die();
$post -> read_single();

$category_arr = array(
    'id' => $category->id,
    'category' => $category->category
);


//make json
print_r(json_encode($post_arr));