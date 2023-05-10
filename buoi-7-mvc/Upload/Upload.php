<?php

namespace Upload;

use Message\Message;

class Upload
{ 
    public function uploadImage($inputName)
    {
        if (isset($_FILES[$inputName]['name']) && is_uploaded_file($_FILES[$inputName]['tmp_name'])) {
            echo 1;
            if ($_FILES[$inputName]['error'] > 0) {
                Message::setMessage('File lỗi', 'error');
                return;
            }
            if (explode('/', $_FILES[$inputName]['type'])[0] != 'image') {
                Message::setMessage('File phải là định dạng ảnh', 'error');
                return;
            }

            $fileExt = explode('.', $_FILES[$inputName]['name'])[1];
            $fileName = explode('.', $_FILES[$inputName]['name'])[0];

            $uploadDir = 'images/products/';
            // $filename = basename($_FILES[$name]['name']);
            $path = $uploadDir . $fileName . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $fileExt;

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], __DIR__ . '/../' . $path)) {
                // Message::setMessage('Thành công', 'success');
                return $path;
            } else {
                Message::setMessage('Không lưu được File', 'error');
                return;
            }
        } else {
            return;
        }
    } 
}
