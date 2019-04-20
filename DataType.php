<?php declare(strict_types=1);

abstract class DataType
{
    protected $value;
    protected $validationStatus;

    public function __construct(string $value)
    {
        $this->value=$value;
        $this->validationStatus = false;
    }

    abstract public function validate(): bool;

    public function getValidationStatus(): bool
    {
        return $this->validationStatus;
    }




}

class Address extends DataType
{

    final public function validate(): bool
    {
        if (strpos($this->value, '@') !== false) {
            $this->validationStatus = false;
        } else {
            $this->validationStatus = true;
        }
        return $this->validationStatus;
    }
}

class Email extends DataType
{

    final public function validate(): bool
    {
        if (!preg_match("/([w-]+@[w-]+.[w-]+)/",$this->value)){
            $this->validationStatus=false;
        }
        else{
            $this->validationStatus=true;
        }
        return $this->validationStatus;
    }
}
class UserName extends DataType{

    public function validate(): bool
    {
        if (!preg_match("/^[a-zA-Z ]*$/",$this->value)){

            $this->validationStatus=false;
        }
        else{
            $this->validationStatus=true;
        }
        return $this->validationStatus;
    }
}
