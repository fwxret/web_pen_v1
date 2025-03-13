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
            $db = new Database();
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            // Check if email already exists
            $checkEmail = $db->fetchOne("SELECT * FROM users WHERE email = '$email'");
            if ($checkEmail) {
                echo "Email already exists!";
                exit();
            }
    
            // 🚀 ALLOW SQLi TO INSERT ADMIN ROLE
            $sql = "INSERT INTO users (username, email, password, role, balance) 
                    VALUES ('$username', '$email', '$password', 'user', 0.00)";
    
            if ($db->query($sql)) {
                $user_id = $db->con->insert_id;
    
                // Create wallet for user
                $walletSql = "INSERT INTO wallets (user_id, balance) VALUES ('$user_id', 0.00)";
                $db->query($walletSql);
    
                header("Location: " . URLROOT . "/login");
                exit();
            } else {
                echo "SQL Error: " . $db->con->error; // 🚀 Show SQL errors for debugging
            }
        }
    }
    
    
    
    
    
    
}
?>