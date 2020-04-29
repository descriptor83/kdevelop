<?php

class User extends Model{
    public $id;
    public $name;
    public $email;
    public $password;
    public $repeat;
    public $registration_date;
    public $roles;
    
    public function __construct($name, $email, $password, $repeat='', $registration_date='')
    {
        $date = new DateTime();
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->repeat = $repeat;
        $this->registration_date = $registration_date == '' ? $date->format('Y-m-d') : $registration_date;
        $this->table = 'users';
            }
    public function checkName(){
        if(strlen($this->name) >= 2){
            return true;
        } else {
            return false;
        }
    }
    public function checkPassword()
    {
        if(strlen($this->password) >= 6){
            return true;
        } else {
            return false;
        }
    }
    public function checkRepeat()
    {
        if($this->password == $this->repeat)
            return true;
        else 
            return false;    
    }
    public function checkEmail()
    {
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
             return true;
            }
        else {
             return false;
            }
    }
    public function exchangeArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'registration' => $this->registration_date
        ];
    }
    public static function isLogged()
    {
        if(isset($_COOKIE['user'])){
            return true;
        }
        return false;
    }
    public static function getUser($col = '')
    {
        if(!isset($_COOKIE['user'])){
            return false;
        }
        $id = (int) $_COOKIE['user'];
        if($id == 0){
            return false;
        }
        $user = Table::getRecordById('users',$id);
        return $col == '' ? $user : $user[$col];
    }
    public static function isAdmin()
    {
        if(self::isLogged()){
            $role = self::getUser('roles');
            return $role == 'ROLE_ADMIN' ? true : false;
        } 
        return false;
    }
}