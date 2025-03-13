<?php
class Logout extends Controller {
    public function index() {
        session_start();
        session_destroy(); // Hủy toàn bộ session
        header("Location: " . URLROOT . "/login"); // Chuyển hướng về trang login
        exit();
    }
}
?>
