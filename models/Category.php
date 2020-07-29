<?php

class Category extends Model{
    public $name;

    public function __construct($name) {
        $this->name = $name;
        $this->table = 'categories';
    }
    public function exchangeArray()
    {
        return [
            'name' => $this->name
        ];
    }
}