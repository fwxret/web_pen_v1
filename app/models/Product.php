<?php

class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $result = mysqli_query($this->db->con, $sql);
    
        $products = [];
        while ($row = mysqli_fetch_object($result)) { // Đổi từ `fetch_assoc` sang `fetch_object`
            $products[] = $row;
        }
    
        return $products;
    }
    
}
