<?php 
require_once __DIR__ . '/AbstractValidate.php';

class RequiredValidate extends AbstractValidate{
    private $fieldValue;

    public function __construct ($fieldValue) {
        $this->fieldValue = $fieldValue;
    }

    public function passedValidate(){
        if($this->fieldValue){
            return true;
        }   
        return false;
    }

    public function getMessage() {
        return ' not empty';
    }
}