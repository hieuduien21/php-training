<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//library validate

$dataForm = [
    'name' => '',
    'email' => '', 
];

$dataRules = [
    'name' => 'required',
    'email' => 'required|email|min:3|between:3,10|required_with:name',
];

$messages = [
    'name.required' => 'Tên không được bỏ trống',
    'email.required' => 'Email không được bỏ trống',
    'email.email' => 'Email không đúng định dạng',
    'email.min' => 'Email ít nhất 3 kí tự',
    'email.between' => 'Email từ 3 đến 10 kí tự',
    'email.required_with' => 'Email và Tên không được bỏ trống',
];

require(__DIR__ . '/ValidateService.php');

$validate = new ValidateService($dataForm);
$validate->setRules($dataRules);
$validate->setMessage($messages);

$validate->validate();

if($validate->getErrors()){
    echo '<pre>';
    print_r($validate->getErrors());
}
 
    
/**
 * scope phổ biến: public - protected - private - static
 * scope giúp quản bảo mật và control, validate đc data
 */