<?php

class UserOrder implements Model{
    public $user_id;
    public $order_id;
    public $table;

    public function __construct($user_id, $order_id)
    {
        $this->user_id = $user_id;
        $this->order_id = $order_id;
        $this->table = 'user_order';
    }
    public function exchangeArray()
    {
        return [
            'user_id' => $this->user_id,
            'order_id' => $this->order_id
        ];
    }
}