<?php

class Girl extends Model{
    public $id;
    public $name;
    public $age;
    public $country;
    public $category;
    public $img;
    public $price;
    
    public function __construct($name, $age, $country, $category,$price, $img='noimage.png')
    {
        $this->name = $name;
        $this->age = $age;
        $this->country = $country;
        $this->category = $category;
        $this->img = $img;
        $this->price = $price;
        $this->table = 'girls';
    }
    public function exchangeArray()
    {
        return [
            
            'name' => $this->name,
            'age' => $this->age,
            'country' => $this->country,
            'category' => $this->category,
            'img' => $this->img,
            'price' => $this->price           
        ];
    }
}