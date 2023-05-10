<?php

namespace App\Http\Controllers;

use View\View;

class NewsController
{
    public function index()
    {
        $data = [
            'name' => 'hieu',
            'age' => 12
        ];
        View::render('news/index.php', $data);
    }
}
