<?php
class Login extends Controller {
    public function index() {
        $this->view("layout", ["contentFile" => "pages/login", "title" => "Login"]);
    }

    public function process() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $db = new Database();

            
            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = $db->query($sql);

            if ($result && $result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: " . URLROOT . "/home");
                exit();
            }
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: " . URLROOT . "/login");
            exit();
        }
    }
}
?>
