<?php
header("Content-Type: application/json");
require 'dbConnect.php';
require 'Validator/validator.php';
require 'ProductController/Product.php';

use ProductController\BookProduct;
use ProductController\DiscProduct;
use ProductController\FurnitureProduct;
use Validator\ProductValidator;


$allowed_methods = ['POST'];
$request_method = $_SERVER['REQUEST_METHOD'];

if (!in_array($request_method, $allowed_methods)) {
    return http_response_code(405);
    exit;
}

$productValidator = new ProductValidator();
try {
    $productValidator->validateProduct($_POST);
} catch (Exception $e) {
    exit(json_encode(["status" => "error", "message" => $e->getMessage()]));
}

$db = new Database();

switch ($_POST['product_type']) {
    case 'disc':
        $discProduct = new DiscProduct($_POST['name'], $_POST['price'], $_POST['size']);
        echo $db->addProduct($discProduct);
        break;
    case 'book':
        $bookProduct = new BookProduct($_POST['name'], $_POST['price'], $_POST['weight']);
        echo $db->addProduct($bookProduct);
        break;
    case 'furniture':
        $dimension = $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'];
        $furnitureProduct = new FurnitureProduct($_POST['name'], $_POST['price'], $dimension);
        echo $db->addProduct($furnitureProduct);
        break;
    default:
        echo 'invalid product type';
        break;
}