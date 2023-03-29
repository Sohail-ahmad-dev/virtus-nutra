<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Enter Contact Information - Force Factor</title>
        <meta name="viewport" content="width=device-width, height=device-height"/>
        <link href="css/global.css" rel="stylesheet" />
        <link href="css/site_page-5.css" rel="stylesheet" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/modernizr-2.8.3.min.js"></script>
        <style>
            #paypal-button-container {
                text-align: center;
                margin-top: 17px;
            }
        </style>
    </head>

    <body class="retail">
        <div class="page_container">
            <header>
                <div class="header-wrap">
                    <div class="wrapper">
                        <a href="index.php">
                            <img class="logo" src="images/logo.png">
                        </a>
                    </div>
                </div>
            </header>
            <section class="checkout">
                <div class="wrapper">
                    <h1>Enter Contact Information</h1>
                    <div class="step-wrap">
                        <div class="border"></div>
                        <p class="step">Step 1 of 4</p>
                    </div>
                    <form method="post" action="shipping.php">
                        <input type="text" name="first_name" tabindex="1" required="" placeholder="First Name" value="">
                        <input type="text" name="last_name" tabindex="2" required="" placeholder="Last Name" value="">
                        <input type="email" name="email_address" tabindex="3" required="" placeholder="Email Address" value="">
                        <input type="tel" name="phone_number" maxlength="11" tabindex="4" required="" placeholder="Phone Number" value="">
                        <input type="submit" placeholder="Continue" id="submit-btn">
                    </form>
                </div>
            </section>    
            <footer>
                <div class="wrapper">
                    <label for="submit-btn" class="cont footer-btn">Continue</label>
                    <div id="paypal-button-container"></div>
                    <a href="cart.php" class="back footer-btn">Back to Shopping Cart</a> </div>
            </footer>
        </div>
        <script type="text/javascript" src="js/global.js"></script>
        <script type="text/javascript" src="js/site_page-5.js"></script>
        <div id="nc-pixel-container-footer"> </div>



        <!-- Sample PayPal credentials (client-id) are included -->
        <script src="https://www.paypal.com/sdk/js?client-id=ARpwn_WrDUK6pQpvzQIMLpCaj85fktud-DT7foGFjoZ-p0iX0SL-RaBqT8eLib8B_wVNQKoRPG5RMLtT&currency=USD"></script>

        <?php
        
            session_start();

            $total = 0;
            $quantity = 0;

            if(!empty($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $k => $v) {
                    $total += $v['price'];
                    $quantity += $v['quantity'];
                }
            }else{
                header('Location: https://localhost/github/cart/cart.php');
            }
        
        ?>
        
        
        <script>
        $(document).ready(function(){
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        "purchase_units": [{
                            "amount": {
                                "value": '<?php echo $total;?>', //total
                                "currency_code": 'USD',
                                "breakdown": {
                                    "item_total": {
                                        "currency_code": "USD",
                                        "value": '<?php echo $total;?>' //total
                                    }
                                }
                            },
                            "items": [
                                {

                                  "name": "First Product Name",

                                  "description": "Optional descriptive text..",

                                  "unit_amount": {

                                    "currency_code": "USD",

                                    "value": '<?php echo $total;?>' //single item

                                  },

                                  "quantity": '<?php echo $quantity;?>' //quantity

                                },

                                ]
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                      // console.log("order completed successfully");
                        saveResponse(details);
                    });
                }
            }).render('#paypal-button-container'); // Display payment options on your web page
    
           
            // var aff_id = getCookie('aff_id');

            function saveResponse(response) {
                console.log(response);
                // $.LoadingOverlay("show");
//                 $.ajax({
//                     type: "POST",
//                     url: "",
//                   //   url: base_url + "payment/process_add",
//                     dataType: 'JSON',
//                     data: {'paypalResponse':response},
//                     cache: false,
//                     success: function(data) {
//                         if(data.response == true){
// // print_r($paypal['paypalResponse']['purchase_units'][0]['amount']['currency_code']);
// //         $status = $paypal['paypalResponse']['status'];
//                             location.href = base_url + data.redirect_url;
//                             // var redirect = base_url + "paypal/confirmation";
//                             // window.location.replace(redirect);
//                         }
//                     },
//                     // complete: function () {
//                     // $.LoadingOverlay("hide");
//                     // }
//                 });
            }

        });

    </script>

      </body>
</html>
