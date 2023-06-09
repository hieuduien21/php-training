<?php

namespace App\Http\Controllers;

use View\View;
use App\Http\Models\Product;
use Upload\Upload;
use Message\Message;

class HomeController
{
    public function index()
    {
        $products = new Product();
        $data = [
            'products' => $products->get(),
            'flashMessage' => Message::message()
        ];

        View::render('home/index.php', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $products = new Product();
            $upload = new Upload();
            $image = $upload->uploadImage('image');
            
            $row = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
            ];

            if ($image)
                $row['image'] = $image;

            $id = $products->insert($row);

            if ($id) {
                Message::message("home", "Thêm sản phẩm thành công", "success");
            } else {
                Message::message("home", "Thêm sản phẩm không thành công", "error");
            }

            header("Location: /");
            exit();
        }

        View::render('home/create.php');
    }

    public function update()
    {
        $id = $_GET['id'];

        if (!$id) {
            header("Location: /");
            exit();
        }

        $products = new Product();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $upload = new Upload();
            $image = $upload->uploadImage('image');

            $row = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price']
            ];

            if ($image)
                $row['image'] = $image;

            $id = $products->where('id', $id)->update($row);

            if ($id) {
                Message::message("update", "Cập nhật thành công", "success");
            } else {
                Message::message("update", "Cập nhật không thành công", "error");
            }

            header("Location: /");
            exit();
        }

        $data = [
            'data' => $products->where('id', $id)->getRow(),
            'flashMessage' => Message::message()
        ];

        View::render('home/update.php', $data);
    } 

    public function delete()
    {
        $id = $_GET['id'];

        $products = new Product();
        
        $rowCount = $products->where('id', $id)->delete();
        if ($rowCount) {
            Message::message("del", "Xóa thành công", "success");
        } else {
            Message::message("del", "Xóa không thành công", "error");
        }
        header("Location: /");
        exit();
    }
}
