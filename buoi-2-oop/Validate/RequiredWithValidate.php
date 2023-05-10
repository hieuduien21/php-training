<?php

class RequiredWithValidate
{
    private $fieldNameRequiredWith;

    public function __construct($fieldNameRequiredWith)
    {
        $this->fieldNameRequiredWith = $fieldNameRequiredWith;
    }

    public function passedValidate($fieldName, $valueRule, $dataForm)
    {
        if($dataForm[$this->fieldNameRequiredWith] && $valueRule){
            return true;
        }
        return false;
    }

    public function getMessage($fieldName, $message)
    {
        return $message ? $message : $fieldName . ' required with '. $this->fieldNameRequiredWith;
    }
}