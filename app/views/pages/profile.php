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
      <h2 class="text-center">Profile</h2>
      <p class="text-center">Hello, <?= htmlspecialchars($_SESSION['username']) ?></p>
      <div class="row justify-content-center align-items-center">
         <!-- Avatar -->
         <div class="col-md-4 text-center">
            <?php
            $userModel = $this->model("User"); // Gọi model
            $user = $userModel->getUserById($_SESSION['user_id']); // Lấy user từ DB
            // Gán biến đúng thứ tự
            $avatarPath = !empty($user['avatar']) ? URLROOT . "/" . $user['avatar'] : URLROOT . "/public/images/default.png";
            ?>

            <!-- Không dùng htmlspecialchars() -> XSS nếu avatar bị chỉnh sửa thành payload JS -->
            <img src="<?= $avatarPath ?>" alt="Avatar" class="rounded img-thumbnail"
               style="width: 200px; height: 200px; object-fit: cover;">

            <!-- Form upload avatar -->
            <form action="<?= URLROOT ?>/profile/uploadAvatar" method="POST" enctype="multipart/form-data" class="mt-3">
               <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

               <div class="form-group">
                  <label for="avatar" class="form-label">Upload Avatar</label>
                  <input type="file" name="avatar" id="avatar" class="form-control-file">
               </div>

               <button type="submit" class="btn btn-primary mt-2">Upload Photo</button>
            </form>
         </div>


         <!-- Update Email & Logout -->
         <div class="col-md-6">
            <form method="POST" action="<?= URLROOT ?>/profile/updateEmail" class="mb-3">
               <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
               <div class="mb-2">
                  <label for="email" class="form-label fw-bold">New Email</label>
                  <input type="email" name="email" id="email" class="form-control w-75" required>
               </div>
               <button type="submit" class="btn btn-success">Update Email</button>
            </form>

            <form method="POST" action="<?= URLROOT ?>/logout">
               <button type="submit" class="btn btn-danger">Logout</button>
            </form>
         </div>
      </div>
   </div>


   <script src="<?= URLROOT ?>/public/js/bootstrap.bundle.min.js"></script>
   <script src="<?= URLROOT ?>/public/js/tiny-slider.js"></script>
   <script src="<?= URLROOT ?>/public/js/custom.js"></script>
</body>

</html>