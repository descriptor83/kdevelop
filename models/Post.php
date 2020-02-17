<?php

class Post implements Model{
    public $table;
    public $title;
    public $body;
    public $created;

    public function __construct($title, $body, $created='')
    {
        $date = new DateTime();
        $this->title = $title;
        $this->body = $body;
        $this->created = $created == '' ? $date->format('Y-m-d') : $created;
        $this->table = 'posts';
    }
    public function exchangeArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'created' => $this->created
        ];
    }
}