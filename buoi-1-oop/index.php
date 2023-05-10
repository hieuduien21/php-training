<?php
//library validate

$dataForm = [
    'name' => '',
    'email' => '',
    'first_name' => '',
];

$dataRules = [
    'name' => 'required',
    'email' => 'required',
    'first_name' => 'required',
];

require(__DIR__ . '/ValidateService.php');

$validate = new ValidateService($dataForm);
$validate->setRules($dataRules);

$validate->validate();

if($validate->countErrors()){
    $errors = $validate->getErrors();
    echo '<pre>';
    print_r($errors);
} else {
    var_dump('submit');
}
    
/**
 * scope phổ biến: public - protected - private - static
 * scope giúp quản bảo mật và control, validate đc data
 */