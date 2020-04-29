<?php
class Country extends Model{
    public $id;
    public $name;
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->table = 'countries';
    }
    public function exchangeArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
} 