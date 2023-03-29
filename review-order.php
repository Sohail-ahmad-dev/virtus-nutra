<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">   
    <head>
        <meta charset="utf-8">
        <title>Review Your Order - Virtus Nutra</title>
        <meta name="description" content="Please review your Virtus Nutra order." />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, height=device-height"/>
        <link href="css/global.css" rel="stylesheet" />
        <link href="css/site_page-23.css" rel="stylesheet" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/modernizr-2.8.3.min.js"></script>
    </head>

    <body class="retail">
        <div class="page_container">
            <header>
                <div class="header-wrap">
                    <div class="wrapper"> <a href="index.html"> <img class="logo" src="images/logo.jpg"> </a> </div>
                </div>
            </header>
            <section class="review">
                <div class="wrapper">
                    <h1>Review Your Order</h1>
                    <div class="step-wrap">
                        <div class="border"></div>
                        <p class="step">Step 4 of 4</p>
                    </div>
                    <div class="review-info contact-info">
                        <h2>Contact Information</h2>
                        <p><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></p>
                        <p><?php echo $_SESSION['email_address']; ?></p>
                        <p><?php echo $_SESSION['phone_number']; ?></p>
                        <a href="checkout.php" class="edit">Edit</a> </div>
                    <div class="review-info ship-addr">
                        <h2>Shipping Address</h2>
                        <p><?php echo $_SESSION['address']; ?></p>
                        <p><?php echo $_SESSION['city'] . ',  ' . $_SESSION['state'] . ',  ' . $_SESSION['zip_code']; ?></p>
                        <p></p>
                        <a href="shipping.php" class="edit">Edit</a> </div>
                    <div class="review-info payment-info">
                        <h2>Payment Information</h2>
                        <p>Ending in <?php echo $_POST['lead_responses']['payment_page_last_four']; ?></p>
                        <a href="payment-information.php" class="edit">Edit</a> </div>
                    <div style="float: left; width: 100%; " class="review-info prod-row">

                        <?php
                        if ($_SESSION['cart'] && count($_SESSION['cart']) > 0) {
                            foreach ($_SESSION['cart'] as $keys => $values) {
                                $rows = explode(',', $values);
                                ?>
                                <div class="prod-details" style="float: left; width: 100%; ">
                                    <div class="prod-info">
                                        <p class="prod-name"><?php echo $rows['1']; ?></p>
                                    </div>
                                    <div class="prod-amount">
                                        <div class="prod-qty">QTY: <?php echo $rows['3']; ?> <span></span></div>
                                        <p class="prod-price">$<span><?php echo number_format($rows['2'], 2); ?></span></p>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <form method="post" action="order-confirmation.php" id="form">
                        <input type="hidden" name="billing_responses[shipping_option_id]" value="">
                        <input type="hidden" name="billing_responses[payment_page_request_type_id]" value="">
                        <input type="hidden" name="billing_responses[payment_page_report_group]" value="">
                        <input type="hidden" name="billing_responses[payment_page_id]" value="">
                        <input type="hidden" name="billing_responses[payment_page_order_id]" value="">
                        <input type="hidden" name="billing_responses[payment_page_merchant_transaction_id]" value="">
                        <input type="hidden" name="billing_responses[payment_page_request_at]" value="">
                        <input type="hidden" name="billing_responses[payment_page_response_at]" value="">
                        <input type="hidden" name="billing_responses[payment_page_response_code]" value="">
                        <input type="hidden" name="billing_responses[payment_page_response_message]" value="">
                        <input type="hidden" name="billing_responses[payment_page_response_time]" value="">
                        <input type="hidden" name="billing_responses[payment_page_target_server]" value="">
                        <input type="hidden" name="billing_responses[payment_page_type]" value="">
                        <input type="hidden" name="billing_responses[payment_page_txn_id]" value="">
                        <input type="hidden" name="billing_responses[payment_page_short_term_token]" value="">
                        <input type="hidden" name="billing_responses[payment_page_bin]" value="">
                        <input type="hidden" name="billing_responses[payment_page_first_six]" value="">
                        <input type="hidden" name="billing_responses[payment_page_last_four]" value="">
                        <input type="hidden" name="billing_responses[payment_page_expiration_month]" value="">
                        <input type="hidden" name="billing_responses[payment_page_expiration_year]" value="">
                        <input type="submit" id="submit-btn">
                    </form>
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
            <script>
                $(window).on("load", function () {
                    gtag('event', 'checkout_progress', {
                        "items": [
                            {
                                "id": "FFS-00307-FG-1",
                                "name": "Alpha King Supreme",
                                "category": "Testosterone Boosters",
                                "quantity": 2,
                                "price": 89.99,
                                "checkout_step": 6
                            },
                        ],
                        "coupon": ""
                    });
                    gtag('event', 'set_checkout_option', {
                        "checkout_step": 6,
                        "checkout_option": "Review Order"
                    });
                });
            </script>
            <footer>
                <div class="wrapper">
                    <label for="submit-btn" class="cont footer-btn">Continue</label>
                    <a href="/shopping-cart" class="back footer-btn">Back to Shopping Cart</a> </div>
            </footer>
        </div>
        <script type="text/javascript" src="js/global.js"></script> 
        <script type="text/javascript" src="js/site_page-23.js"></script> 

        <!-- Content for Snippet Type Other --> 
        <script type="text/javascript">
                var link = document.createElement('link');
                link.href = "https://fonts.googleapis.com/css?family=Lato:400,700";
                link.rel = "stylesheet";
                document.getElementsByTagName('head')[0].appendChild(link);
                // <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
        </script>
        <div id="nc-pixel-container-footer"> </div>
        <script type="text/javascript">window.NREUM || (NREUM = {});
            NREUM.info = {"beacon": "bam.nr-data.net", "licenseKey": "caac70a4fe", "applicationID": "554941,554934,554935", "transactionName": "NQBbZxADD0pVAkwMCgxKeFAWCw5XGwVdAwQXCU0cCwwFXExOSwwRBw==", "queueTime": 0, "applicationTime": 106, "atts": "GUdYEVgZHEQ=", "errorBeacon": "bam.nr-data.net", "agent": ""}</script>
    </body>
</html>
