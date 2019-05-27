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

    public function getValue(){
        return $this->value;
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
        if (!preg_match("/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/",$this->value)){
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
        if (!preg_match("/^[a-z A-Z 0-9]+([_ -])?[a-zA-Z0-9]*$/",$this->value)){

            $this->validationStatus=false;
        }
        else{
            $this->validationStatus=true;
        }
        return $this->validationStatus;
    }
}

class Telephone extends DataType{

    public function validate(): bool{
        $this->value="0".$this->value;
        if (!preg_match("/^[0-9]{10}+$/",$this->value)){

            $this->validationStatus=false;
        }
        else{
            $this->validationStatus=true;
        }
        return $this->validationStatus;
    }
}

class City extends DataType{
    public function validate(): bool
    {
        if (!preg_match("/^[a-z A-Z]*$/",$this->value)){

            $this->validationStatus=false;
        }
        else{
            $this->validationStatus=true;
        }
        return $this->validationStatus;
    }
}
class Coordinate extends DataType{
    public function validate(): bool
    {
        if (!preg_match("/^-?(0|[1-9]\d*)(\.\d+)?$/",$this->getValue())){
            $this->validationStatus=false;
        }else {
            $this->validationStatus = true;
        }
        return $this->validationStatus;//-----------------------------------------------------------
    }
}

$email = new Coordinate("j");
echo $email->validate();
