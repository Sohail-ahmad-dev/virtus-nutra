<?php

session_start();

// session_unset();

// echo "<pre>";
// print_r($_SESSION);
// exit;
$carts = !empty($_SESSION['cart']) ? $_SESSION['cart']: [];

?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Shopping Cart - Virtus Nutra</title>
    <meta name="viewport" content="width=device-width, height=device-height"/>
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/site_page-4.css" rel="stylesheet" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/modernizr-2.8.3.min.js"></script>
</head>

<body class="retail">
    <div class="page_container">            

        <?php include('header.php'); ?>

        <section class="cart">
            <div class="wrapper">
                <div class="cart-header"> <a href="products.php" class="cont-shopping"><span>&laquo;</span> Continue Shopping</a> <a href="checkout.php" class="checkout-btn">Check Out</a>
                    <div class="details-row">
                        <div class="details-cart detail">Shopping Cart</div>
                        <div class="defails-info detail">Product Information</div>
                        <div class="defails-price detail">Item Price</div>
                        <div class="defails-qty detail">Quantity</div>
                        <div class="defails-total detail">Price</div>
                    </div>
                </div>
                <div id="cart_results">
                    <?php

                        if(!empty($carts)){

                            foreach ($carts as $k => $cart) {?>

                                <div class="details-cart detail">
                                    <img src="admin/uploads/<?php echo $cart['image']; ?>" class="prev-img sku-img" width="200px">  
                                </div>
                                <div class="defails-info detail">
                                    <?php echo $cart['item_name']; ?>
                                </div>
                                <div class="defails-price detail">
                                    <?php echo $cart['price']; ?>
                                </div>
                                <div class="defails-qty detail">
                                    <?php echo $cart['quantity']; ?>

                                </div>
                                <div class="defails-total detail">
                                    <?php 
                                        $total = intval($cart['quantity']) * intval($cart['price']);
                                        echo $total; 
                                    ?>
                                </div>
                                
                    <?php    }
                            
                        }
                    
                    ?>
                    
                </div>
                <div class="total">
                    <div class=""></div>
                </div>
            </div>
            <div class="summary">
                <div class="wrapper">
                    <div id="cart_total_grand" class="summary-pricing"></div>
                    <div class="summary-checkout"> <a href="checkout.php">Check Out</a> </div>
                    <a href="products.php" class="cont-shopping"><span>&laquo;</span> Continue Shopping</a> </div>
            </div>
        </section>
        <?php include('footer.php') ?>
    </div>       
</body>

