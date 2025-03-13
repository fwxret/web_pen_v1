<?php
class AuthMiddleware {
    public static function check() {
        

        // Kiểm tra nếu đang ở trang checkout thì mới bắt đăng nhập
        if (strpos($_SERVER['REQUEST_URI'], '/checkout') !== false) {
            if (!isset($_SESSION['user_id'])) {
                header("Location: " . URLROOT . "/login");
                exit();
            }
        }
    }
}
?>
