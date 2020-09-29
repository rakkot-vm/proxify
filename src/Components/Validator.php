<?php


namespace App\Components;


use Exception;

class Validator
{
    public string $error = '';

    /**
     * @param $value
     * @param array $rules
     * @return bool
     * @throws Exception
     */
    public function validate($value, array $rules): bool
    {
        $result = false;

        foreach ($rules as $rule) {
            if(is_array($rule)) {
                $this->isValidationExists($rule[0]);

                $result = call_user_func([$this, $rule[0]], $value, $rule[1]);
            }else {
                $this->isValidationExists($rule);

                $result = $this->$rule($value);
            }

            if(!$result) break;
        }

        return $result;
    }

    /**
     * @param array $vars
     * @param array $rules
     * @return bool
     * @throws Exception
     */
    public function validateAll(array $vars, array $rules) : bool
    {
        foreach ($vars as $var => $value){
            if(!$rules[$var]) {
                throw new Exception('Validation rule for "'. $var .'" not found.');
            }

            if(!$this->validate($value, $rules[$var])){
                $this->error =  $var . ' - ' . $this->error;
                break;
            }
        }

        return empty($this->error);
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return !empty($this->error);
    }

    /**
     * @param string $validationName
     * @throws Exception
     */
    private function isValidationExists(string $validationName)
    {
        if(!method_exists($this, $validationName)) {
            throw new Exception('Validation "'. $validationName .'" not found.');
        }
    }

    /**
     * @param string $value
     * @return bool
     */
    private function url(string $value): bool
    {
        if(filter_var($value, FILTER_VALIDATE_URL)){
            return true;
        }

        $this->error = 'should be valid url.';
        return false;
    }

    /**
     * @param string $string
     * @param string $substr
     * @return bool
     */
    private function contain(string $string, string $substr): bool
    {
        if(strpos($string, $substr) !== false){
            return true;
        }

        $this->error = 'should contain "' . $substr . '".';
        return false;
    }

    /**
     * @param $curValue
     * @param $exampleValue
     * @return bool
     */
    private function equal($curValue, $exampleValue): bool
    {
        if(strcasecmp($curValue, $exampleValue) === 0){
            return true;
        }

        $this->error = 'should equal "' . $exampleValue . '".';
        return false;
    }

    /**
     * @param string $value
     * @return bool
     */
    private function json(string $value): bool
    {
        @json_decode($value);
        if (json_last_error() === JSON_ERROR_NONE) {
            return true;
        }

        $this->error = 'should be valid json string.';
        return false;
    }
}