<?php

class BetweenValidate
{
    private $min;
    private $max;

    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function passedValidate($fieldName, $valueRule, $dataForm)
    {
        if (strlen($this->min) <= $valueRule && $valueRule <= strlen($this->max)) {
            return true;
        }
        return false;
    }

    public function getMessage($fieldName, $message)
    {
        return $message ? $message : $fieldName . ' between ' . $this->min . ' and ' . $this->max . ' characters';
    }
}
