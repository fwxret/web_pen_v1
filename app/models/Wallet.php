<?php
class Wallet {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getBalance($user_id) {
        $stmt = $this->db->con->prepare("SELECT balance FROM wallets WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['balance'] : 0.00;
    }

    public function deductBalance($user_id, $amount) {
        $current_balance = $this->getBalance($user_id);

        if ($current_balance >= $amount) {
            $stmt = $this->db->con->prepare("UPDATE wallets SET balance = balance - ? WHERE user_id = ?");
            $stmt->bind_param("di", $amount, $user_id);
            $stmt->execute();
            return true; // Trừ tiền thành công
        }
        return false; // Không đủ tiền
    }
}
?>
