<?php
class User extends Database {
    public function updateEmail($userId, $newEmail) {
        $sql = "UPDATE users SET email = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("si", $newEmail, $userId);
        return $stmt->execute();
    }

    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getAllUsers() {
        return $this->fetchAll("SELECT id, username, email FROM users");
    }
    
    public function deleteUser($user_id) {
        $stmt = $this->con->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
    
    public function updateAvatar($user_id, $avatar_path) {
        $avatar_path = "public/uploads/" . basename($avatar_path); // Đảm bảo đường dẫn đúng
        $sql = "UPDATE users SET avatar = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("si", $avatar_path, $user_id);
        return $stmt->execute();
    }
    
    
}
