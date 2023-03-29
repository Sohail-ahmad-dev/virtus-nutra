<?php

include('./dbConnection.php');

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Testo Boost Pro - Products - Virtus Nutra</title>
        <meta name="viewport" content="width=device-width, height=device-height"/>
        <link href="css/global.css" rel="stylesheet" />
        <link href="css/site_page-3.css" rel="stylesheet" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/modernizr-2.8.3.min.js"></script>
    </head>

    <body class="retail">
        <div class="page_container">
            <?php   
            
                include('header.php');
                
                $sql = 'SELECT * FROM products where ll_product_id= ? ';
                $stmt = mysqli_prepare($conn, $sql);
                
                // Bind parameters to the statement
                mysqli_stmt_bind_param($stmt, "s", $_REQUEST['id']);
                
                $product = getDataFun($stmt);
                $row = $product[0];
                
                $images = json_decode($row['image']);

            ?>

            <section class="idp">
                <div class="wrapper">
                    <div class="idp-img"> 
                        <img src="admin/uploads/<?php echo $images[0]; ?>" class="main-img sku-img">
                        <div class="prev-imgs">
                            <?php                               
                            foreach ($images as $key=>$val){                            
                            ?>
                            <img src="admin/uploads/<?php echo $val; ?>" class="prev-img sku-img">                             
                            <?php } ?>                                                      
                        </div>
                    </div>
                    <div class="idp-info">
                        <div class="idp-desc">
                            <div class="idp-title">
                                <p><?php echo $row['product_headline']; ?></p>
                                <h1><?php echo $row['product_name']; ?></h1>
                            </div>
                        </div>
                        <div class="idp-price">$<?php echo $row['product_price']; ?></div>                        
                        <label for="qty">Quantity</label>
                        <select class="qty" id="qty">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>                            
                        <input type="submit" onClick="add_tocart_sep_detail('<?php echo $row['ll_product_id']; ?>', '<?php echo $row['product_name']; ?>', '<?php echo $row['product_price']; ?>', '<?php echo $images[0]; ?>');" class="idp-add idp-btn" value="Add to Cart">
                        <a href="#" class="idp-try idp-btn">Free Sample<sup>*</sup></a>                        
                        <div class="sample-star">*Sample offer includes monthly shipments at guaranteed low rate. Full details <a href="terms.php">here</a></div>
                    </div>
                </div>
            </section>

            <section class="idp-accord">
                <div class="wrapper">
                    <div class="accord">
                        <div class="accord-header"> About<span>+</span> </div>
                        <div class="panel">
                            <p><?php echo $row['about']; ?></p>
                        </div>
                    </div>
                    <div class="accord">
                        <div class="accord-header"> Science<span>+</span> </div>
                        <div class="panel">
                            <p><?php echo $row['science']; ?></p>
                        </div>
                    </div>
                    <div class="accord facts">
                        <div class="accord-header"> Supplement Facts<span>+</span> </div>
                        <div class="panel"> <img src="images/<?php echo $row['supplement_facts']; ?>"> </div>
                    </div>
                    <div class="accord">
                        <div class="accord-header"> Directions<span>+</span> </div>
                        <div class="panel"><?php echo $row['directions']; ?></div>
                    </div>
                    <div class="accord reviews">
                        <div class="accord-header"> Reviews<span>+</span> </div>
                        <div class="panel">
                            <div class="review-wrap review-add-toggle">
                                <div class="reviews-section">
                                    <div class="none">There are currently no reviews for this product. Be the first to <span class="write-link">write a review</span>!</div>
                                </div>
                                <div class="write">
                                    <p class="write-review write-link">Write a Review</p>
                                </div>
                            </div>
                            <div class="add-review review-add-toggle review-submitted-toggle">
                                <div class="review-row">
                                    <input type="text" class="first_name validate-field" placeholder="First Name">
                                    <input type="text" class="last_name validate-field" placeholder="Last Name">
                                </div>
                                <div class="review-row">
                                    <input type="email" class="email_address validate-field" placeholder="Email Address">
                                    <select class="product validate-field">
                                        <option value="">Select Product</option>
                                        <option value="46" selected="selected">Testo Boost Pro</option>
                                        <option value="55">Alpha King Supreme</option>
                                        <option value="2">Factor 2</option>
                                        <option value="1">Virtus Nutra</option>
                                        <option value="50">Forebrain</option>
                                        <option value="41">Fuego</option>
                                        <option value="42">GainZzz</option>
                                        <option value="39">LeanFire</option>
                                        <option value="45">LeanFire Diet Aminos</option>
                                        <option value="53">LeanFire Ultimate</option>
                                        <option value="34">LeanFire XT</option>
                                        <option value="44">Men's Multivitamin</option>
                                        <option value="43">Omega3</option>
                                        <option value="61">Performance Protein</option>
                                        <option value="38">Pure BCAA</option>
                                        <option value="51">Ramp Up Anytime Energy</option>
                                        <option value="47">SCORE!</option>
                                        <option value="7">Test X180</option>
                                        <option value="8">Test X180 Alpha</option>
                                        <option value="33">Test X180 Genesis</option>
                                        <option value="9">Test X180 Ignite</option>
                                        <option value="54">Test X180 Ignite Pro</option>
                                        <option value="32">Test X180 Tempest</option>
                                        <option value="48">TruFlow</option>
                                        <option value="3">VolcaNO</option>
                                        <option value="49">VolcaNO Extreme</option>
                                        <option value="37">VolcaNO Fury</option>
                                        <option value="40">WHEY30</option>
                                    </select>
                                </div>
                                <textarea class="comment validate-field" placeholder="Your Review"></textarea>
                                <strong>Review Terms:</strong> <em>By clicking the SUBMIT REVIEW button below, I hereby grant permission to Virtus Nutra, LLC and its agents, employees, or assigns, the irrevocable right to use the testimonial made by me for the purpose of advertising and promotional use. The testimonial is the sole property of Virtus Nutra, and Virtus Nutra may use the material or any part thereof whenever and however it deems appropriate. I shall have no claim against Virtus Nutra or any other person, firm, or corporation in relation to the use of my statements or name whether alone or in conjunction with others.</em> 
                      <!--          <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>-->
                                <div id="re-captcha" class="g-recaptcha"></div>
                                <div class="captcha-error"></div>
                                <input type="button" class="submit-review" value="Submit Review">
                            </div>
                            <div class="review-submitted review-submitted-toggle">
                                <h3>Success! Thank you for submitting a review.</h3>
                                <p>We are just making sure it's ready to post, and if all looks good, you'll see it here soon.</p>
                                <a href="reviews.html">Back to reviews</a> </div>
                        </div>
                    </div>
                    <div class="accord">
                        <div class="accord-header"> Shipping Information<span>+</span> </div>
                        <div class="panel">
                            <div class="ship-row">
                                <div class="ship-img"> <img src="images/d16495.png"> </div>
                                <div class="ship-txt">
                                    <p><strong>Fast & Easy Shipping</strong> All Virtus Nutra products are shipped via USPS First-Class Mail, and should arrive 2-5 business days after you place your order.</p>
                                </div>
                            </div>
                            <div class="ship-row">
                                <div class="ship-img"> <img src="images/2153df.png"> </div>
                                <div class="ship-txt">
                                    <p><strong>Shop Worry-Free</strong> If for whatever reason you are not satisfied, we offer a 30-day money-back guarantee. <a href="contact-us.html">Contact us</a> for an RMA number, then send back (at your expense) the unopened product within 30 days of the order date for a full refund, less the initial S&H. For more information, please reference our full <a href="terms.html#standard-returns">return policy</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php include('footer.php') ?>
        </div>

        <script type="text/javascript" src="js/global.js"></script> 
        <script type="text/javascript" src="js/site_page-3.js"></script> 

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
            NREUM.info = {"beacon": "bam.nr-data.net", "licenseKey": "caac70a4fe", "applicationID": "554941,554934,554935", "transactionName": "NQBbZxADD0pVAkwMCgxKeFAWCw5XGwVdAwQXCU0cCwwFXExOSwwRBw==", "queueTime": 0, "applicationTime": 199, "atts": "GUdYEVgZHEQ=", "errorBeacon": "bam.nr-data.net", "agent": ""}</script>
    </body>
</html>
