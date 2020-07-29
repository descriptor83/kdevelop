<?php

class OrderProduct extends Model{
    public $order_id;
    public $product_id;
    
    public function __construct($order_id, $product_id) {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->table = 'order_product';
    }
    public function exchangeArray()
    {
        return [
            'order_id' => $this->order_id,
            'product_id' => $this->product_id
        ];
    }
}