<?php
namespace Ap\Model;
class Users
{
    public $id;
    public $name;
    public $mail;
    public $password;
    public $sex;
    public $birthday;
    public $profile1;
    public $profile2;
    public $created_at;
    public $updated_at;
    public function __construct($properties)
    {
        foreach (['name', 'id', 'mail', 'birthday'] as $key) {
            $this->{$key} = (isset($properties[$key])) ? $properties[$key] : '';
        }
    }
}
