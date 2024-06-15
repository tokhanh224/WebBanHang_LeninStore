<?php

class Login
{
    public $id;
    public $username;
    public $password;
    public $name;
    public $email;
    public $address;
    public $tel;
    public $role;

    public function __construct($id, $username, $password, $name, $email, $address, $tel, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->tel = $tel;
        $this->role = $role;
    }
}
class Role
{
    public $id;
    public $name;
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


}