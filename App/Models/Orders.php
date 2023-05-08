<?php 

class Orders
{
    private $db;
    private $table = "order";

    public function __construct()
    {
        $this->db = new DB();
    }


    /**
     * insert new product in db
     * @param array $data => fileds and values of product row 
     */
    public function getUserOrder($id)
    {
        $UserOrder=$this->db->connect()->where('userID',$id);
        return $UserOrder->getOne($this->table);

    }
    public function insertOrder($data)
    {
        return $this->db->connect()->insert($this->table,$data);
    }


}