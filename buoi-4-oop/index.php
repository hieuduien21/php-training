<?php

require __DIR__ . '/Product.php';

$productModel = new Product();


// $id = $productModel->insert([
//     'name' => 'sản phẩm 1',
//     'price' => '100',
//     'description' => 'Mô tả 1'
// ]);

// $productModel
//     ->where('id', 1)
//     ->where('price', '>', 200)
//     ->update2([
//         'name' => 'éc éc111231231',
//         'price' => 300,
// ]);

// $data = $productModel
//     ->where('id', 18)
//     ->delete();

// $data = $productModel
//     ->select('products.name, products.description, products.price')
//     ->join('product_tag', 'products.id = product_tag.product_id')
//     ->where('products.id', '>', 0)
//     // ->groupBy('products.name')
//     // ->having('price > 10')
//     ->orderBy('products.price DESC')
//     // ->limit(2, 1)
//     ->get();

// $productModel->name = 'product1';
// $productModel->price = '300';

// $productModel->setName('product 2');
// $productModel->setPrice(9000);
// $id = $productModel->save($productModel); 

$id = $productModel
    ->select('products.name, products.description, products.price') 
    ->whereArray([
        ['products.id', '>', 0]
    ])
    ->get();
print_r($id);
    
