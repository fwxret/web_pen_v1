<?php
class Order extends Database {
    public function placeOrder($data) {
        $wallet = new Wallet();
        $total_price = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $data['cart_items']));
        $balance = $wallet->getBalance($data['user_id']);

        if ($balance < $total_price) {
            $_SESSION['error'] = "Insufficient balance!";
            return false;
        }

        // Tạo đơn hàng
        $stmt = $this->con->prepare("INSERT INTO orders (user_id, first_name, last_name, address, postal_code, email, phone, payment_method, order_notes, total_price, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->bind_param("issssssssd", 
            $data['user_id'], $data['first_name'], $data['last_name'], $data['address'], $data['postal_code'], 
            $data['email'], $data['phone'], $data['payment_method'], $data['order_notes'], $total_price
        );

        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;
            $stmt->close();

            // Lưu sản phẩm vào bảng `order_items`
            foreach ($data['cart_items'] as $item) {
                $this->addItem($order_id, $item['id'], $item['quantity'], $item['price']);
            }

            // Trừ tiền trong ví
            $wallet->deductBalance($data['user_id'], $total_price);

            return true;
        } else {
            return false;
        }
    }

    public function addItem($order_id, $product_id, $quantity, $price) {
        $stmt = $this->con->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
        $stmt->close();
    }
}
?>
