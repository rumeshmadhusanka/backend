<?php declare(strict_types=1);
require_once 'DataType.php';
require_once 'Database.php';

class User
{
    private $id;
    private $name;
    private $tele;
    private $password;
    private $email;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTele()
    {
        return $this->tele;
    }

    /**
     * @param mixed $tele
     */
    public function setTele($tele): void
    {
        $this->tele = $tele;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }


    /**
     * User constructor.
     */
    public function __construct()
    {

    }



}
