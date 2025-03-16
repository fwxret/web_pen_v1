<?php
class Register extends Controller {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function index() {
        $this->view("layout", ["contentFile" => "pages/register", "title" => "Register"]);
    }

    public function process() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? ''; // ❌ Không hash password

            $db = new Database();

            // ❌ SQLi ở đây cho phép chèn admin role
            $sql = "INSERT INTO users (username, email, password, role, balance) 
                    VALUES ('$username', '$email', '$password', 'user', 0.00)";

            if ($db->query($sql)) {
                $user_id = $db->con->insert_id;

                // Tạo ví cho user
                $walletSql = "INSERT INTO wallets (user_id, balance) VALUES ('$user_id', 0.00)";
                $db->query($walletSql);

                header("Location: " . URLROOT . "/login");
                exit();
            } else {
                echo "SQL Error: " . $db->con->error; // Debug lỗi SQL
            }
        }
    }
}
?>
