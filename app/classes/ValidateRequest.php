<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    private $errors = [];
    private $error_messages = [
        "required" => "The :attribute field must bre filled",
        "unique" => "The :attribute field is already in use",
        "minLength" => "The :attribute field must be at least :policy characters",
        "maxLength" => "The :attribute field must be more than :policy characters",
        "email" => "The email validation error occurs",
        "string" => "The :attribute field can only be string values",
        "number" => "The :attribute field can only be number values",
        "mixed" => "The :attribute field only accept A-ZA-Z0-9 \.$@ characters"
    ];
    // /**
    //  * @param $column
    //  * @param $value
    //  * @param $policy
    //  */
    //$column=database column,$value=column->value,$policy=table name
    public function checkValidate($data, $policies)
    {
        foreach ($data as $column => $value) {
            if (in_array($column, array_keys($policies))) {
                $this->doValidation([
                    'column' => $column,
                    'value' => $value,
                    'policies' => $policies[$column]
                ]);
            }
        }
    }

    public function doValidation($data)
    {
        $column = $data["column"];
        foreach ($data["policies"] as $rule => $policy) {
            $valid = call_user_func_array([self::class, $rule], [$column, $data["value"], $policy]);
            if (!$valid) {
                $this->setError(
                    str_replace(
                        [":attribute", ":policy"],
                        [$column, $policy],
                        $this->error_messages[$rule]
                    ),

                    $column
                );
            }
        }
    }
    public function unique($column, $value, $policy)
    {
        if ($value != null  && !empty(trim($value))) {
            return !Capsule::table($policy)->where($column, $value)->exists();
        }
    }
    public function required($column, $value, $policy)
    {
        return $value != null  && !empty(trim($value)) ? true : false;
    }
    public function minLength($column, $value, $policy)
    {
        if ($value != null  && !empty(trim($value))) {
            return strlen(trim($value)) >= $policy;
        }
    }
    public function maxLength($column, $value, $policy)
    {
        if ($value != null  && !empty(trim($value))) {
            return strlen(trim($value)) <= $policy;
        }
    }
    public function email($column, $value, $policy)
    {
        if ($value != null  && !empty(trim($value))) {
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }
        return false;
    }
    public function string($column, $value, $policy)
    {
        if ($value != null  && !empty(trim($value))) {
            return preg_match("/^[A-Za-z ]+$/", $value);
        }
        return false;
    }
    public function number($column, $value, $policy)
    {
        if ($value != null  && !empty(trim($value))) {
            return preg_match("/^[0-9\.]+$/", $value);
        }
        return false;
    }
    public function mixed($column, $value, $policy)
    {
        if ($value != null  && !empty(trim($value))) {
            return preg_match("/^[A-Za-z0-9 \.$@]+$/", $value);
        }
        return false;
    }
    public function setError($error, $key = null)
    {
        if ($key) {
            $this->errors[$key] = $error;
        } else {
            $this->errors[] = $error;
        }
    }
    public function hasError()
    {
        return count($this->errors) > 0 ? true : false;
    }
    public function getErrors()
    {
        return $this->errors;
    }
}
