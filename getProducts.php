<?php
header("Content-Type: application/json");
require 'dbConnect.php';
$allowed_methods = ['GET'];
$request_method = $_SERVER['REQUEST_METHOD'];

if (!in_array($request_method, $allowed_methods)) {
    return http_response_code(405);
    exit;
}
$db = new Database();
echo $db->getAllProducts();