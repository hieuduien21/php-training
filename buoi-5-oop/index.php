<?php

require __DIR__ . '/Product.php';

$productModel = new Product();

$data = $productModel
    ->select('name, description, price')
    ->with('comment')
    ->get();

echo '<pre>';
print_r($data);

// $productModel->comment;