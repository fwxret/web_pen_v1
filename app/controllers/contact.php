<?php

class Contact extends Controller {
    public function index() {
        $title = "Contact";
        $this->view("layout", ["contentFile" => "pages/contact", "title" => "Contact"]);
        
    }
}
