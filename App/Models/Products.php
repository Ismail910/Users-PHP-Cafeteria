<?php

    class Products {
        private $db;
        private $table = 'product';

        public function __construct(){
            $this->db = new DB();
        }

        public function getAllProducts(){
            return $this->db->connect()->get($this->table);
        }

        public function getProduct($id){
            $product =  $this->db->connect()->where('id', $id);
            return $product->get($this->table);
        }



    }
