<?php
class Checkout extends Controller {
    public function index() {
        $this->middleware("AuthMiddleware")->check(); // Gọi middleware theo MVC

        if (empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Your cart is empty!";
            header("Location: " . URLROOT . "/cart");
            exit();
        }

        $this->view("layout", [
            "contentFile" => "pages/checkout",
            "title" => "Checkout",
            "cart_items" => $_SESSION['cart']
        ]);
    }

    public function process() {
        $this->middleware("AuthMiddleware")->check();

        if (empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Your cart is empty!";
            header("Location: " . URLROOT . "/cart");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $wallet = $this->model("Wallet");
            $orderModel = $this->model("Order");

            // Lấy dữ liệu từ form checkout
            $orderData = [
                'user_id' => $user_id,
                'first_name' => $_POST['c_fname'],
                'last_name' => $_POST['c_lname'],
                'address' => $_POST['c_address'],
                'postal_code' => $_POST['c_postal_code'],
                'email' => $_POST['c_email'],
                'phone' => $_POST['c_phone'],
                'payment_method' => $_POST['c_payment_method'],
                'order_notes' => $_POST['c_order_notes'] ?? '',
                'cart_items' => $_SESSION['cart']
            ];

            // Xử lý đơn hàng trong model (đúng chuẩn MVC)
            if ($orderModel->placeOrder($orderData)) {
                unset($_SESSION['cart']); // Xóa giỏ hàng sau khi đặt hàng thành công
                $_SESSION['success'] = "Order placed successfully!";
                header("Location: " . URLROOT . "/orders");
                exit();
            } else {
                $_SESSION['error'] = "Failed to place order!";
                header("Location: " . URLROOT . "/checkout");
                exit();
            }
        }
    }
}
?>
