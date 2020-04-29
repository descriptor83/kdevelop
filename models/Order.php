<?php

class Order extends Model{
    public $id;
    public $user_id;
    public $date;
    public $total;
    public $done;
    

    public function __construct($usr_id, $total, $date = '')
    {
        $data = new DateTime();
        $this->user_id = $usr_id;
        $this->date = $date == '' ? $data->format('Y-m-d') : $date;
        $this->total =$total;
        $this->done = false;
        $this->table = 'orders';
    }
    public function exchangeArray()
    {
        return [
            'user_id' => $this->user_id,
            'date' => $this->date,
            'total' => $this->total,
            'done' => $this->done ? '1' : '0'
        ];
    }
}