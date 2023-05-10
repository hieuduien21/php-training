<?php
require_once __DIR__ . '/AbstractValidate.php';

class EmailValidate extends AbstractValidate {
    private $fieldValue;

    public function __construct ($fieldValue) {
        $this->fieldValue = $fieldValue;
    }

    public function passedValidate(){
        if(filter_var($this->fieldValue, FILTER_VALIDATE_EMAIL)){
            return true;
        }   
        return false;
    }

    public function getMessage() {
        return ' not email format';
    }
}