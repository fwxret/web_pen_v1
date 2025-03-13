<?php
require_once "./app/models/Product.php"; 

class Shop extends Controller {
    public function index() {
        $productModel = new Product();
        $products = $productModel->getAllProducts();

        $title = "Shop";
        $this->view("layout", [
            "contentFile" => "pages/shop", 
            "title" => $title, 
            "products" => $products
        ]);        
    }
}
