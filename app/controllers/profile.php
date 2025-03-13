<?php
class Profile extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/login");
            exit();
        }
    
        $userModel = $this->model("User");
    
        // Chỉ lấy danh sách user nếu là admin
        $users = ($_SESSION['role'] === 'admin') ? $userModel->getAllUsers() : null;
    
        $this->view("layout", [
            "contentFile" => "pages/profile",
            "title" => "Profile",
            "users" => $users
        ]);
    }
    
    

    public function updateEmail() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
            require_once __DIR__ . "/../models/User.php";
            $userModel = new User();

            $newEmail = trim($_POST['email']);
            if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format.";
                header("Location: " . URLROOT . "/profile");
                exit();
            }

            if ($userModel->updateEmail($_SESSION['user_id'], $newEmail)) {
                $_SESSION['success'] = "Email updated successfully.";
            } else {
                $_SESSION['error'] = "Failed to update email.";
            }
            
            header("Location: " . URLROOT . "/profile");
            exit();
        }
    }
    public function deleteUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
            // if ($_SESSION['role'] !== 'admin') {
            //     $_SESSION['error'] = "Unauthorized access!";
            //     header("Location: " . URLROOT . "/profile");
            //     exit();
            // }
    
            $userModel = $this->model("User");
            $user_id = $_POST['user_id'];
    
            if ($userModel->deleteUser($user_id)) {
                $_SESSION['success'] = "User deleted successfully!";
            } else {
                $_SESSION['error'] = "Failed to delete user.";
            }
    
            header("Location: " . URLROOT . "/profile");
            exit();
        }
    }
    
}
