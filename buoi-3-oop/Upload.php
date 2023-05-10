<?php

class Upload
{
    private $error;

    public function UploadImage($inputName)
    {
        if (isset($_FILES[$inputName]['name']) && is_uploaded_file($_FILES[$inputName]['tmp_name'])) {
            if ($_FILES[$inputName]['error'] > 0) {
                $this->setError('File lỗi');
                return null;
            }
            if (explode('/', $_FILES[$inputName]['type'])[0] != 'image') {
                $this->setError('File phải là định dạng ảnh');
                return null;
            }

            $fileExt = explode('.', $_FILES[$inputName]['name'])[1];
            $fileName = explode('.', $_FILES[$inputName]['name'])[0];

            $uploadDir = 'images/products/';
            // $filename = basename($_FILES[$name]['name']);
            $path = $uploadDir . $fileName . '-' . strtotime(date('Y-m-d H:i:s')) . '.' . $fileExt;

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], __DIR__ . '/' . $path)) {
                return $path;
            } else {
                $this->setError('Không lưu được File');
                return null;
            }
        }
        return null;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
