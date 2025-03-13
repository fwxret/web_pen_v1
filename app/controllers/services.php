<?php

class Services  extends Controller{
    public function index() {
        $title = "Services";
        $this->view("layout", ["contentFile" => "pages/services", "title" => "Services"]);
        
    }
}
