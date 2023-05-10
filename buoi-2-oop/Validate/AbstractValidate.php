<?php 

abstract class AbstractValidate {
    // protected $fieldValue;
    // protected $fieldLength;

    // public function __construct ($fieldValue, $fieldLength = null) {
    //     $this->fieldValue = $fieldValue;
    //     $this->fieldLength = $fieldLength;
    // }

    abstract public function passedValidate();
    abstract public function getMessage();

}