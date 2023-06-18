<?php
// 1. Tạo file định dạng bạn là ai trên server
// 2. Tạo cookie với PHPSESSID
// 3. client và server đã biết nhau 
session_start();
// echo session_save_path();


// write data to file
$_SESSION['name'] = 'duc';
$_SESSION['job'] = 'it';