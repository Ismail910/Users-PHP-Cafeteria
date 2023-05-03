<?php


class User {

    private $db;
    private $table = 'user';

    public function __construct(){
        $this->db = new DB();
    }

    public function getUser($id)
    {
        $user = $this->db->connect()->where('id', $id);
        return $user->get($this->table);
    }
    public function getAllUsers()
    {
        return $this->db->connect()->get($this->table);
    }

}

