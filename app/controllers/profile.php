<?php
class Profile extends Controller
{
    public function index()
    {
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



    public function updateEmail()
    {
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
    public function deleteUser()
    {
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

    // public function uploadAvatar()
    // {
    //     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    //         $user_id = $_SESSION['user_id'];

    //         if (!empty($_FILES["avatar"]["name"])) {
    //             $target_dir = "public/uploads/"; // Đúng với tree của bạn
    //             $file_name = basename($_FILES["avatar"]["name"]);
    //             $target_file = $target_dir . time() . "_" . $file_name;

    //             $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    //             $allowed_types = ["jpg", "jpeg", "png", "gif"];

    //             if (in_array($file_type, $allowed_types)) {
    //                 if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
    //                     // Sử dụng model() để gọi User
    //                     $userModel = $this->model("User");
    //                     $userModel->updateAvatar($user_id, $target_file);
    //                     $_SESSION['avatar'] = $target_file;
    //                     $_SESSION['success'] = "Avatar uploaded successfully!";
    //                 } else {
    //                     $_SESSION['error'] = "Failed to upload file.";
    //                 }
    //             } else {
    //                 $_SESSION['error'] = "Invalid file format. Only JPG, PNG, GIF allowed.";
    //             }
    //         } else {
    //             $_SESSION['error'] = "No file uploaded.";
    //         }

    //         header("Location: " . URLROOT . "/profile");
    //         exit();
    //     }
    // }
    public function uploadAvatar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
    
            if (!empty($_FILES["avatar"]["name"])) {
                $target_dir = "public/uploads/"; 
                $file_name = time() . "_" . basename($_FILES["avatar"]["name"]);
                $target_file = $target_dir . $file_name;
    
                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_types = ["jpg", "jpeg", "png", "gif", "php"]; // <-- Cho phép upload PHP để test shell
    
                if (in_array($file_type, $allowed_types)) {
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                        $userModel = $this->model("User");
                        $userModel->updateAvatar($user_id, "uploads/" . $file_name); // <-- Chỉ lưu đường dẫn từ "uploads/"
                        $_SESSION['avatar'] = "/public/uploads/" . $file_name;
                        $_SESSION['success'] = "Avatar uploaded successfully!";
                    } else {
                        $_SESSION['error'] = "Failed to upload file.";
                    }
                } else {
                    $_SESSION['error'] = "Invalid file format. Only JPG, PNG, GIF allowed.";
                }
            } else {
                $_SESSION['error'] = "No file uploaded.";
            }
    
            header("Location: " . URLROOT . "/profile");
            exit();
        }
    }
    

}
