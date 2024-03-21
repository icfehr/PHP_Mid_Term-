<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';
include_once '../../models/Category.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);
$author = new Author($db);
$category = new Category($db);


if (isset($_GET['id'])) {
    // Get a single quote
    $quote->id = $_GET['id'];
    $quote->read_single();

    if ($quote->quote != null) {
        $author->id = $quote->author_id;
        $author->read_single();

        $category->id = $quote->category_id;
        $category->read_single();

        $quote_arr = array(
            "id" => $quote->id,
            "quote" => $quote->quote,
            "author" => $author->author,
            "category" => $category->category
        );

        echo json_encode($quote_arr);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Quote not found."));
    }
} elseif (isset($_GET['author_id'])) {
    // Get all quotes from a specific author
    $data = $quote->read_by_author_id($_GET['author_id']);
    $num = $data['rowCount'];
    $result = $data['result'];

    if ($num > 0) {
        $quotes_arr = array();
        $quotes_arr['data'] = array();

        foreach ($result as $row) {
            // Check if the row is an array and contains the required keys before calling extract()
            if (is_array($row) && isset($row['id']) && isset($row['author_id']) && isset($row['category_id'])) {
                extract($row);
            } else {
                // Handle the case where $row is not an array or does not contain the required keys
                continue;
            }
        
            $author->id = $author_id;
            $author->read_single();
        
            $category->id = $category_id;
            $category->read_single();
        
            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author" => $author->author,
                "category" => $category->category
            );
        
            array_push($quotes_arr['data'], $quote_item);
        }

        echo json_encode($quotes_arr);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "No Quotes Found for the author."));
    }
} else {
    // Get all quotes
    $data = $quote->read();
    $num = $data['rowCount'];
    $result = $data['result'];

    if ($num > 0) {
        $quotes_arr = array();
        $quotes_arr['data'] = array();

        foreach ($result as $row) {
            // Check if the row is an array before calling extract()
            if (is_array($row)) {
                extract($row);
            } else {
                // Handle the case where $row is not an array
                continue;
            }
            $author->id = $author_id ?? null; // Use null coalescing operator to handle undefined variable
            $author->read_single();
            $category->id = $category_id ?? null; // Use null coalescing operator to handle undefined variable
            $category->read_single();
            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author" => $author->author,
                "category" => $category->category
            );
        
            array_push($quotes_arr['data'], $quote_item);
        }
        echo json_encode($quotes_arr);
    }
    else {
        http_response_code(404);
        echo json_encode(array('message' => 'No Quotes Found'));
    }
}

echo json_encode(array('message' => 'Quotes API endpoint'));
