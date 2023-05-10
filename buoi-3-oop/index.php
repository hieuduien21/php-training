<?php  

// require __DIR__ . '/Product.php';

// $productModel = new Product();
// $productModel->create([
//     "name" => "sản phẩm 1",
//     "description" => "mô tả 1",
//     "price" => 200
// ]);

// echo '<pre>';
// print_r($productModel); 
session_start();

echo @$_SESSION['error']; 


?>

<form action="/AddProduct.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Tên</td>
            <td>Mô tả</td>
            <td>Giá</td>
            <td>Hình ảnh</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <input type="text" name="name" value="" placeholder="tên sản phẩm">
            </td>
            <td>
                <input type="text" name="description" value="" placeholder="mô tả sản phẩm">
            </td>
            <td>
                <input type="text" name="price" value="" placeholder="giá sản phẩm">
            </td>
            <td>
                <input type="file" id="image" name="image">
            </td>
            <td>
                <input type="submit" value="Upload">
            </td>
        </tr>
    </table> 
</form> 

<?php 
session_unset();
?>