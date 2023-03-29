<?php 
session_start();
if(empty($_SESSION['cart'])) {
   header('Location:https://virtusnutra.com');
}

?>

<!doctype html>
<html class="no-js" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Order Confirmation - Virtus Nutra</title>
        <meta name="viewport" content="width=device-width, height=device-height"/>
        <link href="css/global.css" rel="stylesheet" />
        <link href="css/site_page-35.css" rel="stylesheet" />
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
            <section class="aspot">
                <div class="wrapper"> <img src="">
                    <h2>Success!</h2>
                    <p>Thank you for your order</p>
                    <p>
                        <?php
                        $date = strtotime(date('F d, Y'));
                        $newDate = date('F d, Y', strtotime('+5 days', $date));
                        ?>
                        Your order is scheduled to arrive by  <?php echo $newDate; ?>
                    </p>
                    <em>Virtus Nutra products are shipped via USPS First-Class Mail, and should arrive 3-5 business days later.</em> </div>
            </section>

            <section class="review">
                <div class="wrapper">
                    <h1>Order Summary</h1>
                    <div class="step-wrap">
                        <div class="border"></div>
                    </div>
                    <div class="review-info contact-info">
                        <h2>Contact Information</h2>
                        <p><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></p>
                        <p><?php echo $_SESSION['email_address']; ?></p>
                        <p><?php echo $_SESSION['phone_number']; ?></p>
                    </div>
                    <div class="review-info ship-addr">
                        <h2>Shipping Address</h2>
                        <p><?php echo $_SESSION['address']; ?></p>
                        <p><?php echo $_SESSION['city'] . ',  ' . $_SESSION['state'] . ',  ' . $_SESSION['zip_code']; ?></p>
                    </div>
                    <div style="float: left; width: 100%; " class="review-info prod-row">
                        <?php
                        if ($_SESSION['cart'] && count($_SESSION['cart']) > 0) {
                            $i == 0;
                            foreach ($_SESSION['cart'] as $keys => $values) {
                                $rows = explode(',', $values);
                                ?>
                                <div class="prod-details" style="float: left; width: 100%; ">
                                    <div class="prod-info">
                                        <p class="prod-name"><?php echo $rows['1']; ?></p>
                                    </div>
                                    <div class="prod-amount">
                                        <?php
                                        if ($i == 0) {
                                            $orderID = $_SESSION['First_ORDERID'];
                                        } else {
                                            $orderID = $_SESSION['Second_ORDERID'];
                                        }
                                        ?>
                                        <div class="prod-qty">Order Id: <?php echo $orderID; ?> <span></span></div>
                                        <div class="prod-qty">QTY: <?php echo $rows['3']; ?> <span></span></div>
                                        <div class="prod-qty">$<?php echo number_format($rows['2'], 2); ?> <span></span></div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </div>                    
                    <?php
                    $grandTotal = 0;
                    $total_html = '';
                    $shipping = '4.99';
                    if ($_SESSION['cart'] && count($_SESSION['cart']) > 0) {
                        foreach ($_SESSION['cart'] as $keys => $values) {
                            $rows = explode(',', $values);
                            if ($rows['0'] == '1') {
                                $couponValid = true;
                            }
                            $grandTotal += ($rows['2']) * ($rows['3']);
                        }
                    }
                    ?>
                    <div class="summary">
                        <div class="wrapper">
                            <div class="summary-pricing">
                                <div class="summary-subtotal">
                                    <p>Subtotal:</p>
                                    <p>$<span><?php echo number_format($grandTotal, 2); ?></span></p>
                                </div>
                                <div class="summary-sh">
                                    <p>S&H:</p>
                                    <p>$<span><?php echo $shipping; ?></span></p>
                                </div>
                                <div class="summary-tax">
                                    <p>Estimated Tax:</p>
                                    <p>$<span>0.00</span></p>
                                </div>
                                <div class="summary-total">
                                    <p>Total:</p>
                                    <p>$<span><?php echo number_format(($grandTotal + $shipping), 2); ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="connection wrapper">
                <div class="customer-service"> <img src="images/56eebc.png">
                    <p>Customer Service</p>
                    <a href="/contact-us">Contact</a> </div>
                <div class="follow-us">
                    <div class="sm icon-wrap"> <a href="#" target="_blank"><img src="images/5f58ea.png" class="sm-icon"></a> <a href="#" target="_blank"><img src="images/8b636a.png" class="sm-icon"></a> <a href="#" target="_blank"><img src="images/70f467.png" class="sm-icon"></a> <a href="#" target="_blank"><img src="images/266418.png" class="sm-icon"></a> </div>
                    <p>Follow Us &amp; Stay In The Know</p>
                </div>
            </section>
            <footer>
                <div class="wrapper">
                    <div class="foot-top"> <img src="images/13d1d5.png" class="unleash">
                        <div class="foot-award"> <img src="images/34fbfb.png"> </div>
                    </div>
                    <div class="footer-nav">
                        <div class="footer-col">
                            <ul>
                                <li><a href="terms.html">Terms & Conditions</a></li>
                                <li><a href="privacy.html">Privacy Policy</a></li>
                                <li><a href="sms.html">SMS Terms & Conditions</a></li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="secure-badges"> <span id="verisign" title="Click to Verify - This site chose VeriSign SSL for secure e-commerce and confidential communications."><script src="https://seal.verisign.com/getseal?host_name=www.forcefactor.com&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script></span> <a id="mcafee" target="_blank" href="#" title="McAfee Secure sites help keep you safe from identity theft, credit card fraud, spyware, spam, viruses and online scams"><img width="115" height="32" border="0" src="images/12.gif" alt="McAfee Secure sites help keep you safe from identity theft, credit card fraud, spyware, spam, viruses and online scams" oncontextmenu="alert('Copying Prohibited by Law - McAfee Secure is a Trademark of McAfee, Inc.'); return false;"></a> <img src="images/badae3.png" class="secure"> </div>
                    <div class="foot-bot">
                        <p>These statements made on this website have not been evaluated by the Food and Drug Administration. The FDA only evaluates foods and drugs, not supplements like these products. These products are not intended to diagnose, treat, cure, or prevent any disease.</p>
                        <p>Copyright <sup>&copy;</sup> 2018 Virtus Nutra, LLC.  All rights reserved.</p>
                    </div>
            </footer>
        </div>
        <script type="text/javascript" src="js/global.js"></script> 
        <script type="text/javascript" src="js/site_page-35.js"></script> 
    </body>
</html>
<?php unset($_SESSION); session_destroy(); ?>
