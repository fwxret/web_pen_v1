<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Blog Detail</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="<?= URLROOT ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= URLROOT ?>/public/css/tiny-slider.css" rel="stylesheet">
  <link href="<?= URLROOT ?>/public/css/style.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    <?php if (isset($blog) && !empty($blog)): ?>
        <h1><?= htmlspecialchars($blog['title']) ?></h1>
        <p><strong>Author:</strong> <?= htmlspecialchars($blog['author']) ?></p>
        <p><strong>Published on:</strong> <?= htmlspecialchars($blog['created_at']) ?></p>
        <hr>
        <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
    <?php else: ?>
        <p class="text-danger">Blog not found!</p>
    <?php endif; ?>
</div>

<!-- 🚀 FORM BÌNH LUẬN -->
<div class="container mt-5">
    <h3 class="mb-3 text-primary fw-bold">💬 Leave a Comment</h3>
    <form action="<?= URLROOT ?>/blog/addComment" method="POST" class="p-4 border rounded shadow-sm bg-white">
    <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
    <input type="hidden" name="slug" value="<?= $blog['slug'] ?>">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label fw-semibold">👤 Name</label>
            <input type="text" class="form-control form-control-lg border-primary shadow-sm" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label fw-semibold">📧 Email</label>
            <input type="email" class="form-control form-control-lg border-primary shadow-sm" id="email" name="email" placeholder="Enter your email" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="website" class="form-label fw-semibold">🌐 Website (optional)</label>
        <input type="url" class="form-control form-control-lg border-secondary shadow-sm" id="website" name="website" placeholder="https://yourwebsite.com">
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label fw-semibold">💬 Comment</label>
        <textarea class="form-control form-control-lg border-success shadow-sm" id="comment" name="comment" rows="4" placeholder="Write your comment here..." required></textarea>
    </div>

    <button type="submit" class="btn btn-lg btn-primary w-100 fw-bold">🚀 Post the Comment</button>
</form>

</div>

<!-- 🚀 HIỂN THỊ DANH SÁCH BÌNH LUẬN -->
<div class="container mt-5">
    <h3>Comments</h3>
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="border p-3 mb-3">
                <p><strong><?= htmlspecialchars($comment['name']) ?></strong> (<?= htmlspecialchars($comment['email']) ?>)</p>
                <p><?= nl2br($comment['comment']) ?></p> <!-- Không encode comment để khai thác Stored XSS -->
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No comments yet. Be the first to comment!</p>
    <?php endif; ?>
</div>


</body>
</html>
