<?php
class Cart extends Controller {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $cart_items = $_SESSION['cart'];

        // Truyền giỏ hàng vào view
        $this->view("layout", [
            "contentFile" => "pages/cart",
            "title" => "Cart",
            "cart_items" => $cart_items
        ]);
    }
    
    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];

            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = [
                    'id' => $product_id,
                    'name' => $product_name,
                    'price' => $product_price,
                    'image' => $product_image,
                    'quantity' => 1
                ];
            } else {
                $_SESSION['cart'][$product_id]['quantity']++;
            }
        }

        header("Location: " . URLROOT . "/cart");
        exit();
    }

    public function remove() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST['id'];
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    
        header("Location: " . URLROOT . "/cart");
        exit();
    }
    

    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST['id'];
            $change = (int) $_POST['change'];
    
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += $change;
    
                // Nếu số lượng nhỏ hơn 1, xóa sản phẩm khỏi giỏ hàng
                if ($_SESSION['cart'][$product_id]['quantity'] < 1) {
                    unset($_SESSION['cart'][$product_id]);
                }
            }
        }
    
        header("Location: " . URLROOT . "/cart");
        exit();
    }
}
?>
