<?php

class About extends Controller {
    public function index() {
        $title = "About";
        $this->view("layout", ["contentFile" => "pages/about", "title" => "About"]);
    }
}
?>