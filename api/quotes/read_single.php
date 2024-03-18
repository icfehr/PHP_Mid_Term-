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

$quote_arr = array(
    'id' => $post->id,
    'quote' => $post->quote,
    'author_id' => $post->author_id,
    'category_id' => $post->category_id
);


//make json
print_r(json_encode($post_arr));