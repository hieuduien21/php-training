<?php

class MinValidate
{
    private $min;
    public function __construct($min)
    {
        $this->min = $min;
    }

    public function passedValidate($fieldName, $valueRule, $dataForm)
    {
        if (strlen($this->min) <= $valueRule) {
            return true;
        }
        return false;
    }

    public function getMessage($fieldName, $message)
    {
        return $message ? $message : $fieldName . ' min ' . $this->min . ' characters';
    }
}