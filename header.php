    <?php include('config.php'); ?>
     <header>
                <div class="header-wrap">
                    <div class="wrapper">
                        <div class="mobile-menu menu-toggle"><img src="images/menu.png"></div>
                        <div class="mobile-close menu-toggle">X</div>
                        <a href="index.php"> <img class="logo" src="images/logo.png"> </a>
                        <ul class="header-nav">
                            <li><a href="products.php">Products</a></li>
                            <li><a href="/samples">Samples</a></li>
                            <li><a href="reviews.php">Reviews</a></li>
                            <li><a href="free-product.php">Get Free Product</a></li>
                            <li><a href="about-us.php">Our Story</a></li>
                            <li><a href="contact-us.php">Contact Us</a></li>
                        </ul>
                        <a href="cart.php" class="mobile-cart"><img src="images/cart.png">
                    <span class="mobile-cart-item-num">
                        <?php
                            echo !empty($_SESSION['cart'])? count($_SESSION['cart']): 0;
                        ?>
                    </span></a>
                    </div>
                </div>
                <span id="error"></span>
                <section class="slideout-wrapper">
                    <div class="slideout">
                        <ul class="menu-main">
                            <li class="menu-prod"><a>Products<span class="arrow symbol-toggle">&plus;</span><span class="arrow symbol-toggle minus">&minus;</span></a></li>
                            <li class="prod-dropdown">
                                <ul>
                                    <li><a href="products.html#test">Testo Boost Pro<span class="arrow">&gt;</span></a></li>
                                    <li><a href="products.html#nox">Nox Pro<span class="arrow">&gt;</span></a></li>
                                </ul>
                            </li>
                            <li><a href="/samples">Samples<span class="arrow">&gt;</span></a></li>
                            <li><a href="reviews.html">Reviews<span class="arrow">&gt;</span></a></li>
                            <li><a href="/team">Team<span class="arrow">&gt;</span></a></li>
                            <li><a href="about-us.html">Our Story<span class="arrow">&gt;</span></a></li>
                            <li><a href="contact-us.html">Contact Us<span class="arrow">&gt;</span></a></li>
                        </ul>
                    </div>
                </section>
                <section class="ghosted"></section>
            </header>
<script src="js/jquery-3.1.1.min.js"></script>
 <script src="js/shoppingCart.js"></script>
<script>
    $(document).ready(function () {
        getShoppingCart();
    });
</script>
