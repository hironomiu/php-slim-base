<?php
namespace Ap\Model;
class Samples
{
    public $id;
    public $data1;
    public $data2;
    public $created_at;
    public $updated_at;
    public function __construct($properties)
    {
        foreach (['id', 'data1', 'data2','created_at','updated_at'] as $key) {
            $this->{$key} = (isset($properties[$key])) ? $properties[$key] : '';
        }
    }
}
