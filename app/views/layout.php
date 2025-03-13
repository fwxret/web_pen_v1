<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : "Website"; ?></title>
    <link href="<?= URLROOT ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URLROOT ?>/public/css/tiny-slider.css" rel="stylesheet">
    <link href="<?= URLROOT ?>/public/css/style.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php require_once __DIR__ . "/partials/navbar.php"; ?>

    <!-- Main Content -->
    <main>
    <?php
    if (isset($data['contentFile'])) {
    extract($data); // Giải nén các biến từ mảng $data
    $contentFilePath = __DIR__ . "/" . ltrim($data['contentFile'], '/') . ".php";
    if (file_exists($contentFilePath)) {
        require_once $contentFilePath;
    } else {
        echo "<p style='color: red;'>Lỗi: Không tìm thấy trang $contentFilePath</p>";
    }
    }
?>


    </main>

    <!-- Footer -->
    <?php require_once __DIR__ . "/partials/footer.php"; ?>

    <script src="<?= URLROOT ?>/public/js/bootstrap.bundle.min.js"></script>
    <script src="<?= URLROOT ?>/public/js/tiny-slider.js"></script>
    <script src="<?= URLROOT ?>/public/js/custom.js"></script>
</body>
</html>
