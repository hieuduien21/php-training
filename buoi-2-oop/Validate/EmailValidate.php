<?php
class EmailValidate
{
    public function passedValidate($fieldName, $valueRule, $dataForm)
    {
        if(filter_var($valueRule, FILTER_VALIDATE_EMAIL)){
            return true;
        }   
        return false;
    }

    public function getMessage($fieldName, $message)
    {
        return $message ? $message : $fieldName . ' not email format';
    }
}
