<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

// Instantiate DB & connection
$database = new Database();
$db = $database->connect();

// Instantiate Category object
$category = new Category($db);

if ($method === 'GET') {
    // Get all categories
    $result = $category->read();
    $num = $result->rowCount();

    if ($num > 0) {
        $categories_arr = array();
        $categories_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id' => $id,
                'category' => $category
            );

            array_push($categories_arr['data'], $category_item);
        }

        // Output categories in JSON format
        echo json_encode($categories_arr);
    } else {
        echo json_encode(
            array('message' => 'No Categories Found')
        );
    }
} else {
    // Basic control logic API requests
    echo json_encode(array('message' => 'Categories API endpoint'));
}
