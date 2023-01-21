<?php
header("Content-Type: application/json");
require 'dbConnect.php';
require 'Validator/validator.php';


use Validator\ProductValidator;

$allowed_methods = ['DELETE'];
$request_method = $_SERVER['REQUEST_METHOD'];

if (!in_array($request_method, $allowed_methods)) {
    return http_response_code(405);
    exit;
}

$productValidator = new ProductValidator();
try {
    $productValidator->validateProductToDelete($_POST);
} catch (Exception $e) {
    exit(json_encode(["status" => "error", "message" => $e->getMessage()]));
}
$db = new Database();
$product_ids = $_POST['skus'];
echo $db->massDeleteProducts($product_ids);