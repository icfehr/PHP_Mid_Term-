<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// Basic control logic API requests
echo json_encode(array('message' => 'Categories API endpoint'));
