<?php
class Login extends Controller {
    public function index() {
        $this->view("layout", ["contentFile" => "pages/login", "title" => "Login"]);
    }

    public function process() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy giá trị từ form
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // **Không lọc input để có thể khai thác SQL Injection**
            $db = new Database();

            // **Đặt dấu nháy đơn quanh $username để truy vấn không bị lỗi cú pháp**
            $sql = "SELECT * FROM users WHERE username = '$username'";

            // Thực thi truy vấn SQL
            $result = $db->query($sql);

            if (!$result || $result->num_rows === 0) {
                $_SESSION['login_error'] = "Invalid username or password.";
                header("Location: " . URLROOT . "/login");
                exit();
            }

            // Nếu có dữ liệu trả về từ truy vấn
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: " . URLROOT . "/home");
            exit();
        }
    }
}
?>
