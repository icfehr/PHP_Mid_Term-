<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

$quote->id = isset($_GET['id']) ? $_GET['id'] : die();
$quote->read_single();

$post_item = array(
    "id" => $quote->id,
    "quote" => $quote->quote, 
    "author_id" => $quote->author_id,
    "category_id" => $quote->category_id
);

print_r(json_encode($post_item));
