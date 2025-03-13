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

		<!-- Start Header/Navigation -->
		
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
		<!-- End Hero Section -->
        <div class="container mt-5">
    <h2 class="text-center">Profile</h2>
    <p class="text-center">Hello, <?= htmlspecialchars($_SESSION['username']) ?></p>

    <!-- Nút Update Email -->
    <form method="POST" action="<?= URLROOT ?>/profile/updateEmail" class="mx-auto" style="max-width: 400px;">
        <div class="mb-3">
            <label for="email" class="form-label">New Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Email</button>
    </form>

    <!-- Nút Logout -->
    <form method="POST" action="<?= URLROOT ?>/logout" class="mx-auto" style="max-width: 400px; margin-top: 20px;">
        <button type="submit" class="btn btn-danger w-100">Logout</button>
    </form>

    <!-- Hiển thị danh sách user nếu là admin -->
    <?php if (!empty($users)): ?> 
    <h3 class="mt-5">All Users</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <form method="POST" action="<?= URLROOT ?>/profile/deleteUser" onsubmit="return confirm('Are you sure?');">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="mt-5"></div> <!-- Thêm khoảng cách khi không có danh sách user -->
<?php endif; ?>

</div>

 
             
		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>