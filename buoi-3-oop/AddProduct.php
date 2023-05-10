<?php
require __DIR__ . '/Product.php';
require __DIR__ . '/Upload.php';

$name = @$_POST['name'];
$description = @$_POST['description'];
$price = @$_POST['price'];
$upload = new Upload();
$image = $upload->UploadImage('image');

if ($upload->getError()) {
    session_start();
    $_SESSION['error'] = $upload->getError();
    header("Location: index.php");
    exit();
}

if ($name && $description && $price) {
    $productModel = new Product();
    $productModel->create([
        "name" => $name,
        "description" => $description,
        "price" => $price,
        "image" => $image
    ]);
}

header("Location: index.php");
exit();