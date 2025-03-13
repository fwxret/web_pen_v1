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
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

	<div class="untree_co-section product-section before-footer-section">
    	<div class="container">
        	<div class="row">
            <?php foreach ($products as $product): ?>
    <div class="col-12 col-md-4 col-lg-3 mb-5">
        <a class="product-item" href="#">
            <img src="<?= URLROOT . '/' . htmlspecialchars($product->image) ?>" class="img-fluid product-thumbnail">
            <h3 class="product-title"><?= htmlspecialchars($product->name) ?></h3>
            <strong class="product-price">$<?= number_format($product->price, 2) ?></strong>

            <!-- Form ẩn để thêm sản phẩm vào giỏ hàng -->
            <form method="post" action="<?= URLROOT ?>/cart/add">
    			<input type="hidden" name="product_id" value="<?= $product->id ?>">
    			<input type="hidden" name="product_name" value="<?= htmlspecialchars($product->name) ?>">
    			<input type="hidden" name="product_price" value="<?= number_format($product->price, 2) ?>">
    			<input type="hidden" name="product_image" value="<?= htmlspecialchars($product->image) ?>">
    
   			 	<button type="submit" style="border: none; background: none;">
        			<span class="icon-cross">
            		<img src="<?= URLROOT ?>/public/images/cross.svg" class="img-fluid">
       		 		</span>
    			</button>
			</form>

        </a>
    </div>
            <?php endforeach; ?>
			
		</div>
    	</div>
	</div>



		<!-- Start Footer Section -->
		
		<!-- End Footer Section -->	


		
	</body>

</html>
