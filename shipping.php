<?php
session_start();
include('ll/campaign_setup.php');
$_SESSION['first_name'] = $_POST['first_name'];
$_SESSION['last_name'] = $_POST['last_name'];
$_SESSION['email_address'] = $_POST['email_address'];
$_SESSION['phone_number'] = $_POST['phone_number'];
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Enter Payment Information -  Virtus Nutra</title>
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
                    <h1>Enter Shipping Address</h1>
                    <div class="step-wrap">
                        <div class="border"></div>
                        <p class="step">Step 2 of 4</p>
                    </div>                    
                    <form method="post" action="ll/create_prospect.php?method=new_prospect" name="prospect_form1" id="prospect_form1">                        
                         <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id;  ?>" />
                        <input type='hidden' id='first_name' name='first_name' value='<?php echo $_SESSION['first_name']; ?>' />
                        <input type='hidden' id='last_name' name='last_name' value='<?php echo $_SESSION['last_name']; ?>' />
                        <input type='hidden' id='email' name='email' value='<?php echo $_SESSION['email_address']; ?>' />
                        <input type='hidden' id='phone_number' name='phone_number' value='<?php echo $_SESSION['phone_number']; ?>' />                        
                        <input type="text" name="address" tabindex="5" required="" placeholder="Street Address" value="">
                        <input type="text" name="city" tabindex="6" required="" placeholder="City" value="">
                        <select name="state" tabindex="7" required>
                            <option value="">State</option>
                            <option value="AL">AL - Alabama</option>
                            <option value="AK">AK - Alaska</option>
                            <option value="AZ">AZ - Arizona</option>
                            <option value="AR">AR - Arkansas</option>
                            <option value="CA">CA - California</option>
                            <option value="CO">CO - Colorado</option>
                            <option value="CT">CT - Connecticut</option>
                            <option value="DE">DE - Delaware</option>
                            <option value="DC">DC - District Of Columbia</option>
                            <option value="FL">FL - Florida</option>
                            <option value="GA">GA - Georgia</option>
                            <option value="GU">GU - Guam</option>
                            <option value="HI">HI - Hawaii</option>
                            <option value="ID">ID - Idaho</option>
                            <option value="IL">IL - Illinois</option>
                            <option value="IN">IN - Indiana</option>
                            <option value="IA">IA - Iowa</option>
                            <option value="KS">KS - Kansas</option>
                            <option value="KY">KY - Kentucky</option>
                            <option value="LA">LA - Louisiana</option>
                            <option value="ME">ME - Maine</option>
                            <option value="MD">MD - Maryland</option>
                            <option value="MA">MA - Massachusetts</option>
                            <option value="MI">MI - Michigan</option>
                            <option value="MN">MN - Minnesota</option>
                            <option value="MS">MS - Mississippi</option>
                            <option value="MO">MO - Missouri</option>
                            <option value="MT">MT - Montana</option>
                            <option value="NE">NE - Nebraska</option>
                            <option value="NV">NV - Nevada</option>
                            <option value="NH">NH - New Hampshire</option>
                            <option value="NJ">NJ - New Jersey</option>
                            <option value="NM">NM - New Mexico</option>
                            <option value="NY">NY - New York</option>
                            <option value="NC">NC - North Carolina</option>
                            <option value="ND">ND - North Dakota</option>
                            <option value="OH">OH - Ohio</option>
                            <option value="OK">OK - Oklahoma</option>
                            <option value="OR">OR - Oregon</option>
                            <option value="PA">PA - Pennsylvania</option>
                            <option value="PR">PR - Puerto Rico</option>
                            <option value="RI">RI - Rhode Island</option>
                            <option value="SC">SC - South Carolina</option>
                            <option value="SD">SD - South Dakota</option>
                            <option value="TN">TN - Tennessee</option>
                            <option value="TX">TX - Texas</option>
                            <option value="UT">UT - Utah</option>
                            <option value="VT">VT - Vermont</option>
                            <option value="VA">VA - Virginia</option>
                            <option value="VI">VI - Virgin Islands</option>
                            <option value="WA">WA - Washington</option>
                            <option value="WV">WV - West Virginia</option>
                            <option value="WI">WI - Wisconsin</option>
                            <option value="WY">WY - Wyoming</option>
                            <option value="AA">AA - Armed Forces Americas</option>
                            <option value="AE">AE - Armed Forces Europe</option>
                            <option value="AP">AP - Armed Forces Pacific</option>
                            <option value="APO">APO - Army Post Office</option>
                            <option value="FPO">FPO - Fleet Post Office</option>
                        </select>
                        <input type="tel" name="zip" tabindex="8" maxlength ="5" required="" placeholder="ZIP Code" value="">
                        <input type="submit" placeholder="Continue" id="submit-btn">
                        <div class="secure-badges"> <span id="verisign" title="Click to Verify - This site chose VeriSign SSL for secure e-commerce and confidential communications."><script src="https://seal.verisign.com/getseal?host_name=www.forcefactor.com&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script></span> <a id="mcafee" target="_blank" href="#" title="McAfee Secure sites help keep you safe from identity theft, credit card fraud, spyware, spam, viruses and online scams"><img width="115" height="32" border="0" src="images/12.gif" alt="McAfee Secure sites help keep you safe from identity theft, credit card fraud, spyware, spam, viruses and online scams" oncontextmenu="alert('Copying Prohibited by Law - McAfee Secure is a Trademark of McAfee, Inc.'); return false;"></a> </div>
                    </form>
                </div>
            </section>

            <footer>
                <div class="wrapper">
                    <label for="submit-btn" class="cont footer-btn">Continue</label>
                    <a href="cart.html" class="back footer-btn">Back to Shopping Cart</a> </div>
            </footer>
        </div>
        <script type="text/javascript" src="js/global.js"></script> 
        <script type="text/javascript" src="js/site_page-22.js"></script> 
    </body>
</html>
