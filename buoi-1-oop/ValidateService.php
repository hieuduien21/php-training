<?php 
require __DIR__ . '/Validate/RequiredValidate.php';
require __DIR__ . '/Validate/EmailValidate.php';
require __DIR__ . '/Validate/MinValidate.php';
require __DIR__ . '/Validate/MaxValidate.php';

class ValidateService {
    private $dataForm = [];
    private $rules = [];
    private $errors = [];
 
    public function __construct($dataForm) {
        $this->dataForm = $dataForm;
    }

    public function setRules($rules) {
        $this->rules = $rules;
    }

    public function validate() {
        foreach($this->rules as $field => $rule){ 
            $fieldValue = $this->dataForm[$field];
            
            if(strpos($rule, '|')) {
                $ruleArr = explode('|', $rule);
                foreach($ruleArr as $ruleItem){
                    if(strpos($ruleItem, ':')) {
                        $ruleOptional = explode(':', $ruleItem);
                        $this->addErrorByInstance($ruleOptional[0], $fieldValue, $field, $ruleOptional[1]);
                    } else { 
                        $this->addErrorByInstance($ruleItem, $fieldValue, $field);
                    }
                }
            } else {
                $this->addErrorByInstance($rule, $fieldValue, $field);
            }
        }
    }

    private function addErrorByInstance($rule, $fieldValue, $field, $ruleOptional = null)
    {
        $classNameValidate = ucfirst($rule) . 'Validate';  
        $instance = new $classNameValidate($fieldValue, $ruleOptional ? $ruleOptional : null); 
        if(!$instance->passedValidate()){
            $message = $field . $instance->getMessage();
            $this->errors[$field][] = $message;
        } 
    }

    public function getErrors() {
        return $this->errors;
    }

    public function countErrors() {
        if(is_array($this->errors) && count($this->errors) > 0) {
            return true;
        } else {
            return false;
        }
    }
}