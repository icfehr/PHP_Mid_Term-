<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Author object
$authorObj = new Author($db);

// Get ID from URL
$authorObj->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get single author
$authorObj->read_single();

// Create array
$author_item = array(
    "id" => $authorObj->id,
    "author" => $authorObj->author
);

// Make JSON
print_r(json_encode($author_item));
