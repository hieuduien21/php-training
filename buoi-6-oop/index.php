<?php

require __DIR__ . '/Category.php';

$categoryModel = new Category();

$data = $categoryModel
    ->select('categories.id, categories.name')
    ->with(['products', 'brands'])
    // ->with('brands')
    ->get();

echo '<pre>';
print_r($data);

// $productModel->comment;

// $productModel->oneToMany();
// $productModel->beLongTo();
// $productModel->manyToMany();