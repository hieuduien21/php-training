<?php
require __DIR__ . '/Validate/RequiredValidate.php';
require __DIR__ . '/Validate/EmailValidate.php';
require __DIR__ . '/Validate/MinValidate.php';
require __DIR__ . '/Validate/MaxValidate.php';
require __DIR__ . '/Validate/BetweenValidate.php';
require __DIR__ . '/Validate/RequiredWithValidate.php';

class ValidateService
{
    private $dataForm = [];
    private $rules = [];
    private $errors;
    private $messages;

    private $ruleMapsClass = [
        'required' => RequiredValidate::class,
        'email' => EmailValidate::class,
        'min' => MinValidate::class,
        'between' => BetweenValidate::class,
        'required_with' => RequiredWithValidate::class,
    ];

    public function __construct($dataForm)
    {
        $this->dataForm = $dataForm;
    }

    public function setRules($rules)
    {
        foreach($rules as $fieldName => $stringRule){ 
            $rules[$fieldName] = explode("|", $stringRule);
        }
        $this->rules = $rules;
    }

    public function setMessage($messages) {
        $this->messages = $messages;  
    }

    public function validate()
    {
        foreach ($this->rules as $fieldName => $ruleArray) {
            $valueRule = $this->dataForm[$fieldName];

            foreach($ruleArray as $ruleItem) {
                $ruleAndOptional = explode(":", $ruleItem);

                $ruleName = $ruleAndOptional[0];
                $optional = explode(",", end($ruleAndOptional));

                $className = $this->ruleMapsClass[$ruleName];

                $classNameInstance = new $className(...$optional);

                if(!$classNameInstance->passedValidate($fieldName, $valueRule, $this->dataForm)) {
                    $this->errors[$fieldName][] = $classNameInstance->getMessage($fieldName, $this->messages[$fieldName . '.' . $ruleName] ?? null);
                }
            }
        } 
    }

    public function getErrors () {
        return $this->errors;
    } 
}
