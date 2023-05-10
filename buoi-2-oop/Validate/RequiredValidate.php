<?php
class RequiredValidate
{
    public function passedValidate($fieldName, $valueRule, $dataForm)
    {
        if($valueRule) {
            return true;
        }
        
        return false; 
    }

    public function getMessage($fieldName, $message)
    {
        return  $message ?? $fieldName . ' not empty';
    }
}