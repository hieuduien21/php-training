<?php
require_once __DIR__ . '/AbstractValidate.php';

class MinValidate extends AbstractValidate{
    private $fieldValue;
    private $fieldLength;

    public function __construct ($fieldValue, $fieldLength) {
        $this->fieldValue = $fieldValue;
        $this->fieldLength = $fieldLength;
    }

    public function passedValidate(){
        if(strlen($this->fieldValue) >= $this->fieldLength){
            return true;
        }   
        return false;
    }

    public function getMessage() {
        return ' min ' . $this->fieldLength . ' characters';
    }
}