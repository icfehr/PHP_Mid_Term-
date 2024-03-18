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

$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    "category_name" => $post->category_name
)

//make json
print_r(json_encode($post_arr));