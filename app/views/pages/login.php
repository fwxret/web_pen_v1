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
  <title>Shop</title>
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center">Login</h2>
    <form method="POST" action="<?= URLROOT ?>/login/process" class="mx-auto" style="max-width: 400px;">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Hiển thị thông báo lỗi ngay dưới ô nhập mật khẩu -->
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-danger py-2 text-center" role="alert">
                <?= $_SESSION['login_error']; ?>
            </div>
            <?php unset($_SESSION['login_error']); // Xóa thông báo sau khi hiển thị ?>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary w-100">Login</button>
        <p class="text-center mt-3">Don't have an account? <a href="<?= URLROOT ?>/register">Register</a></p>
    </form>
</div>

<script src="<?= URLROOT ?>/public/js/bootstrap.bundle.min.js"></script>
<script src="<?= URLROOT ?>/public/js/tiny-slider.js"></script>
<script src="<?= URLROOT ?>/public/js/custom.js"></script>

</body>
</html>
