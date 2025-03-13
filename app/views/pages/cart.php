<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="<?= URLROOT ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= URLROOT ?>/public/css/tiny-slider.css" rel="stylesheet">
  <link href="<?= URLROOT ?>/public/css/style.css" rel="stylesheet">
  <title>Cart</title>
</head>

<body>

  <!-- Start Hero Section -->
  <div class="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="intro-excerpt">
            <h1>Shopping Cart</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <div class="untree_co-section before-footer-section">
    <div class="container">
      <div class="row mb-5">
        <form class="col-md-12" method="post">
          <div class="site-blocks-table">
            <table class="table">
              <thead>
                <tr>
                  <th class="product-thumbnail">Image</th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-total">Total</th>
                  <th class="product-remove">Remove</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($cart_items) && count($cart_items) > 0): ?>
                  <?php foreach ($cart_items as $item): ?>
                    <tr>
                      <td class="product-thumbnail">
                        <img src="<?= URLROOT . '/' . htmlspecialchars($item['image']) ?>" alt="Image" class="img-fluid">
                      </td>
                      <td class="product-name">
                        <h2 class="h5 text-black"><?= htmlspecialchars($item['name']) ?></h2>
                      </td>
                      <td>$<?= number_format($item['price'], 2) ?></td>
                      <td>
                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                          <div class="input-group-prepend">
                            <button class="btn btn-outline-black decrease" type="button" onclick="updateQuantity(<?= $item['id'] ?>, -1)">&minus;</button>
                          </div>
                          <input type="text" class="form-control text-center quantity-amount" value="<?= $item['quantity'] ?>" readonly>
                          <div class="input-group-append">
                            <button class="btn btn-outline-black increase" type="button" onclick="updateQuantity(<?= $item['id'] ?>, 1)">&plus;</button>
                          </div>
                        </div>
                      </td>
                      <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                      <td>
                        <a href="javascript:void(0);" onclick="removeItem(<?= $item['id'] ?>)" class="btn btn-black btn-sm">X</a>
                      </td>                 
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">
                      <div class="alert alert-warning" role="alert">
                        <strong>Your cart is empty!</strong> Please add items before proceeding.
                      </div>
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </form>
      </div>

      <div class="row">
        <div class="col-md-6">
          <a href="<?= URLROOT ?>/shop" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
        </div>
        <div class="col-md-6 text-right">
          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
          <strong class="text-black">
            $<?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $_SESSION['cart'] ?? [])), 2) ?>
          </strong>
          <br>

          <!-- Alert khi giỏ hàng trống -->
          <div id="cart-alert" class="alert alert-danger d-none mt-3" role="alert">
            Your cart is empty!
          </div>

          <button id="checkout-btn" class="btn btn-black btn-lg py-3 btn-block">Proceed To Checkout</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
  function updateQuantity(productId, change) {
    fetch("<?= URLROOT ?>/cart/update", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "id=" + productId + "&change=" + change
    })
    .then(response => response.text())
    .then(() => {
      location.reload();
    })
    .catch(error => console.error("Error updating quantity:", error));
  }

  function removeItem(productId) {
    fetch("<?= URLROOT ?>/cart/remove", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "id=" + productId
    })
    .then(() => {
      location.reload();
    })
    .catch(error => console.error("Error removing item:", error));
  }

  // Kiểm tra giỏ hàng trước khi checkout
  document.getElementById("checkout-btn").addEventListener("click", function(event) {
    <?php if (empty($_SESSION['cart'])): ?>
        event.preventDefault(); // Ngăn chuyển trang
        let alertBox = document.getElementById("cart-alert");
        alertBox.classList.remove("d-none"); // Hiện alert
        setTimeout(() => { alertBox.classList.add("d-none"); }, 3000); // Ẩn sau 3 giây
    <?php else: ?>
        window.location.href = "<?= URLROOT ?>/checkout"; // Chuyển hướng nếu có sản phẩm
    <?php endif; ?>
  });
  </script>

</body>
</html>
