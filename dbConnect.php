<?php

use ProductController\BookProduct;
use ProductController\DiscProduct;
use ProductController\FurnitureProduct;

class Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=products", "root", "");
    }

    public function addProduct($product)
    {
        try {
            $query = "INSERT INTO products (sku, name, price, size, weight, dimension) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                $product->getSku(), // sku - unique key
                $product->getName(),
                $product->getPrice(),
                $product instanceof DiscProduct ? $product->getSize() : null,
                $product instanceof BookProduct ? $product->getWeight() : null,
                $product instanceof FurnitureProduct ? $product->getDimension() : null
            ]);
            return json_encode(["status" => "success", "message" => 'Product added successfully']);
        } catch (PDOException $e) {
            return json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function getAllProducts()
    {
        try {
            $query = "SELECT * FROM products";
            $stmt = $this->conn->query($query);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $filteredProducts = array_map(function ($product) {
                return array_filter($product, function ($value) {
                    return $value !== null;
                });
            }, $products);

            return json_encode(["status" => "success", "products" => $filteredProducts]);
        } catch (PDOException $e) {
            return json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function massDeleteProducts($product_ids)
    {
        try {
            $products = implode(',', array_fill(0, count($product_ids), '?'));
            $query = "SELECT COUNT(sku) as count FROM products WHERE sku IN ($products)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($product_ids);
            $result = $stmt->fetch();
            if (!$result['count']) {
                return json_encode(["status" => "error", "message" => 'No products found']);
            }
            $query = "DELETE FROM products WHERE sku IN ($products)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($product_ids);
            return json_encode(["status" => "success", "message" => 'Product deleted successfully']);
        } catch (PDOException $e) {
            return json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}