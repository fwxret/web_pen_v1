<?php

class Home extends Controller {
    public function index() {
        $title = "Home";
        $this->view("layout", ["contentFile" => "pages/home", "title" => "Home"]);
        
    }
}
