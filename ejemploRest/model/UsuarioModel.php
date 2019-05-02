<?php

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 2/05/19
 * Time: 9:22
 */
class UsuarioModel implements JsonSerializable
{
    private $id;
    private $username;
    private $password;


    public function __construct($id, $user, $pass)
    {
        $this->id = $id;
        $this->username = $user;
        $this->password = $pass;
    }



    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return array(
            'ID' => $this->id,
            'Username' => $this->username,
            'Password' => $this->password
        );
    }


    public function __sleep()
    {
        return array('ID', 'Username', 'Password');
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
    public function setPassword($password)
    {
        $this->password = $password;
    }

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
    public function setId($id)
    {
        $this->id = $id;
    }


}