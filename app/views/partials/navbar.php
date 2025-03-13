<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="<?= URLROOT ?>/">Shop<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" 
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
    <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
        <li class="nav-item active"><a class="nav-link" href="<?= URLROOT ?>/">Home</a></li>
        <li><a class="nav-link" href="<?= URLROOT ?>/shop">Shop</a></li>
        <li><a class="nav-link" href="<?= URLROOT ?>/about">About us</a></li>
        <li><a class="nav-link" href="<?= URLROOT ?>/services">Services</a></li>
        <li><a class="nav-link" href="<?= URLROOT ?>/blog">Blog</a></li>
        <li><a class="nav-link" href="<?= URLROOT ?>/contact">Contact us</a></li>
    </ul>

    <ul class="custom-navbar-cta navbar-nav d-flex align-items-center gap-3 mb-2 mb-md-0">
        <li><a class="nav-link" href="<?= URLROOT ?>/profile"><img src="<?= URLROOT ?>/public/images/user.svg"></a></li>
        <li><a class="nav-link" href="<?= URLROOT ?>/cart"><img src="<?= URLROOT ?>/public/images/cart.svg"></a></li>
        <li><a class="nav-link" href="#"><img src="<?= URLROOT ?>/public/images/icons8-search-24.svg"></a></li>
        <li class="d-flex align-items-center">
            <img src="<?= URLROOT ?>/public/images/icons8-money-24.png" alt="Balance" class="me-1">
            <span class="text-light">
                <?php 
                    if (isset($_SESSION['user_id'])) {
                        require_once __DIR__ . "/../../models/Wallet.php";
                        $wallet = new Wallet();
                        echo '$' . number_format($wallet->getBalance($_SESSION['user_id']), 2);
                    } else {
                        echo '$0.00';
                    }
                ?>
            </span>
        </li>
    </ul>
</div>

    </div>
</nav>
