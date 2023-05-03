<?php

class OrderDetails {
    private $db;
    private $table = "orderdetails";

    public function __construct()
    {
        $this->db = new DB();
    }

    

    public function getORders(){
        return $this->db->connect()->get($this->table);
    }

    public function getOrder($id){
        $product =  $this->db->connect()->where('id', $id);
        return $product->get($this->table);
    }


}
