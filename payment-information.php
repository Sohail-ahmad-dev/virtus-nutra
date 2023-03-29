<?php
session_start();
include('ll/campaign_setup.php');
//print_r($_SESSION);
?>
<!doctype html>
<html class="no-js" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Enter Shipping Address - Virtus Nutra</title>
        <meta name="viewport" content="width=device-width, height=device-height"/>
        <link href="css/global.css" rel="stylesheet" />
        <link href="css/site_page-22.css" rel="stylesheet" />
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
                    <div class="wrapper"> <a href="index.php"> <img class="logo" src="images/logo.png"> </a> </div>
                </div>
            </header>
            <section class="checkout">
                <div class="wrapper">
                    <h1>Enter Payment Information</h1>
                    <div class="step-wrap">
                        <div class="border"></div>
                        <p class="step">Step 3 of 4</p>
                    </div>
                    <form method="post" action="ll/submit_order_limelight.php" id="form">
                        
                        <input type="hidden" name="prospectId" id="prospectId" value="<?php echo $_REQUEST['prospectId'];  ?>" />
                        <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id;  ?>" />
                        <input type="hidden" name="shipping_id" id="shipping_id" value="<?php echo $shipping_id;  ?>" />
                        <select name="creditCardType" id="creditCardType"  name="state"  required="">
                            <option value="">Select Payment Method</option>
                            <option value="visa" onClick="">Visa</option>
                            <option value="master" onClick="">Master Card</option>
                        </select>
                        <input type="tel" name="creditCardNumber" maxlength="16" tabindex="5" required="" placeholder="Credit Card #" value="">
                        <div class="positionExpDateDiv">
                            <div class="expDateDiv">                              
                                <div id="expSelectDiv">
                                    <div id="expMonthDiv">
                                        <select name="expMonth" id="expMonth" tabindex="2">
                                            <option value="" disabled="disabled"></option>
                                            <option value="01" selected="selected">01 - Jan</option>
                                            <option value="02">02 - Feb</option>
                                            <option value="03">03 - Mar</option>
                                            <option value="04">04 - Apr</option>
                                            <option value="05">05 - May</option>
                                            <option value="06">06 - Jun</option>
                                            <option value="07">07 - Jul</option>
                                            <option value="08">08 - Aug</option>
                                            <option value="09">09 - Sept</option>
                                            <option value="10">10 - Oct</option>
                                            <option value="11">11 - Nov</option>
                                            <option value="12">12 - Dec</option>
                                        </select> 
                                    </div>

                                    <div id="expYearDiv">
                                        <select name="expYear" id="expYear" tabindex="3">
                                            <option value="" disabled="disabled"></option>
                                            <option value="18">2018</option><option value="19">2019</option><option value="20">2020</option><option value="21">2021</option><option value="22">2022</option><option value="23">2023</option><option value="24">2024</option><option value="25">2025</option><option value="26">2026</option><option value="27">2027</option><option value="28">2028</option><option value="29">2029</option><option value="30">2030</option><option value="31">2031</option><option value="32">2032</option><option value="33">2033</option><option value="34">2034</option><option value="35">2035</option><option value="36">2036</option><option value="37">2037</option></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="text" id="cvv" name="cvv" maxlength="4" tabindex="4" required="" placeholder="Security Code" value="">
                        <input type="submit" id="submit-btn" class="eprotect-submit">
                    </form>
                    <div class="secure-badges"> <span id="verisign" title="Click to Verify - This site chose VeriSign SSL for secure e-commerce and confidential communications."><script src="https://seal.verisign.com/getseal?host_name=www.forcefactor.com&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script></span> <a id="mcafee" target="_blank" href="https://www.mcafeesecure.com/RatingVerify?ref=www.forcefactor.com" title="McAfee Secure sites help keep you safe from identity theft, credit card fraud, spyware, spam, viruses and online scams"><img width="115" height="32" border="0" src="images/12.gif" alt="McAfee Secure sites help keep you safe from identity theft, credit card fraud, spyware, spam, viruses and online scams" oncontextmenu="alert('Copying Prohibited by Law - McAfee Secure is a Trademark of McAfee, Inc.'); return false;"></a> </div>
                </div>
            </section>
            <footer>
                <div class="wrapper">
                    <label for="submit-btn" class="cont footer-btn">Continue</label>
                    <a href="cart.html" class="back footer-btn">Back to Shopping Cart</a> </div>
            </footer>
        </div>
        <script type="text/javascript" src="js/global.js"></script> 
        <script type="text/javascript" src="js/site_page-6.js"></script> 
    </body>
</html>


<style>
    #expSelectDiv{
        float: left;
        width: 100%;
    }

    #expMonthDiv{
        float: left;
        width: 50%;
    }

    #expYearDiv{
        float: left;
        width: 50%;
    }

</style>


