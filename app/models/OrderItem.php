<?php
class OrderItem {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addItem($order_id, $product_id, $quantity, $price) {
        $stmt = $this->db->con->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }
}
?>
