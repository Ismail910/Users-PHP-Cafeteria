<?php

class Order {
    private $db;

    private $table = 'order';


    function __construct(){
        $this->db = new Db();
    }

    public function insertOrder($data)
    {
        return $this->db->connect()->insert($this->table,$data);
    }

}