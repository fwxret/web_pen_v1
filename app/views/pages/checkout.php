<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <title>Checkout</title>

  <!-- Bootstrap CSS -->
  <link href="<?= URLROOT ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= URLROOT ?>/public/css/style.css" rel="stylesheet">
</head>

<body>

  <div class="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="intro-excerpt">
            <h1>Checkout</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="untree_co-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-5">
          <h2 class="h3 mb-3 text-black">Billing Details</h2>
          <div class="p-3 p-lg-5 border bg-white">
          <form action="<?= URLROOT ?>/checkout/process" method="POST">
    <div class="form-group">
        <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="c_fname" name="c_fname" required>
    </div>

    <div class="form-group">
        <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="c_lname" name="c_lname" required>
    </div>

    <div class="form-group">
        <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="c_address" name="c_address" required>
    </div>

    <div class="form-group">
        <label for="c_postal_code" class="text-black">Postal Code <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="c_postal_code" name="c_postal_code" required>
    </div>

    <div class="form-group">
        <label for="c_email" class="text-black">Email Address <span class="text-danger">*</span></label>
        <input type="email" class="form-control" id="c_email" name="c_email" required>
    </div>

    <div class="form-group">
        <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="c_phone" name="c_phone" required>
    </div>

    <div class="form-group">
        <label for="c_payment_method" class="text-black">Payment Method <span class="text-danger">*</span></label>
        <select class="form-control" id="c_payment_method" name="c_payment_method" required>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="cheque">Cheque</option>
            <option value="paypal">PayPal</option>
            <option value="cod">Cash on Delivery</option>
        </select>
    </div>
    <div class="form-group">
        <label for="c_order_notes" class="text-black">Order Notes</label>
        <textarea class="form-control" id="c_order_notes" name="c_order_notes" rows="3"></textarea>
    </div>
    <div class="form-group mt-4"> <!-- Thêm mt-4 để tạo khoảng cách -->
    <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Place Order</button>
</div>

</form>

          </div>
        </div>

        <div class="col-md-6">
          <h2 class="h3 mb-3 text-black">Your Order</h2>
          <div class="p-3 p-lg-5 border bg-white">
            <table class="table site-block-order-table mb-5">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $total_price = 0;
                if (!empty($cart_items)) :
                  foreach ($cart_items as $item) :
                    $item_total = $item['price'] * $item['quantity'];
                    $total_price += $item_total;
                ?>
                  <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td>$<?= number_format($item_total, 2) ?></td>
                  </tr>
                <?php endforeach; else: ?>
                  <tr>
                    <td colspan="3" class="text-center">Your cart is empty.</td>
                  </tr>
                <?php endif; ?>
                <tr>
                  <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                  <td></td>
                  <td class="text-black font-weight-bold"><strong>$<?= number_format($total_price, 2) ?></strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>

  <script src="<?= URLROOT ?>/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
