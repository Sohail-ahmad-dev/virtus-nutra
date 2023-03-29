<?php

include('./dbConnection.php');

?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Virtus Nutra - Unleash Your Potential</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, height=device-height"/>
        <link href="css/global.css" rel="stylesheet" />
        <link href="css/site_page-1.css" rel="stylesheet" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/modernizr-2.8.3.min.js"></script>
    </head>

    <body class="retail">
        <div class="page_container">
            <input type="hidden" id="shopping_cart_num" value="0">

            <?php include('header.php'); ?>
            <section class="aspot">
                <div class="aspot-content wrapper"> </div>
            </section>
            <section class="prod-wrap wrapper"> <strong class="prods-header">Our Latest Innovations</strong>
                <p class="prods-subheader">Whether you’re looking to improve cognitive performance, boost your vitality, or crush it in the gym, our latest innovations have got you covered.</p>
                <div class="prods">

                    <?php

                    $sql = "SELECT * FROM products";
                    $stmt = mysqli_prepare($conn, $sql);
                    $result = getDataFun($stmt);

                    if (!empty($result)) {
                        foreach ($result as $key => $row) {
                            $image = json_decode($row['image']);
                            ?>
                            <div class="prod">
                                <a href="product_detail.php?id=<?php echo $row['ll_product_id']; ?>"><img src="admin/uploads/<?php echo $image[0]; ?>" class="prod-img"></a>
                                <a class="prod_detail_link" href="product_detail.php?id=<?php echo $row['ll_product_id']; ?>">Click For Detail</a>
                                <div class="prod-name"><?php echo $row['product_name']; ?></div>
                                <div class="prod-price">$<span><?php echo $row['product_price']; ?></span></div>                                
                                <input  onClick="add_tocart_sep('<?php echo $row['ll_product_id']; ?>', '<?php echo $row['product_name']; ?>', '<?php echo $row['product_price']; ?>', '<?php echo $image[0]; ?>', '1');" type="button" class="button prod-add" value="Add to Cart">
                                <a href="#" class="button prod-sample">Free Sample<sup>*</sup></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="disclaim"><sup>*</sup>Sample offer includes monthly shipments at guaranteed low rate. Full details <a href="terms.php">here</a>.</div>
            </section>

            <section class="intro">
                <div class="wrapper">
                    <div class="intro-content">
                        <div class="upper">
                            <div class="let">
                                <p>Helping You Become</p>
                            </div>
                            <div class="tag">The Best You<sup>TM</sup></div>
                        </div>
                        <p>Virtus Nutra performance nutrition supplements can help you achieve all of your goals in and out of the gym. Our full line of carefully crafted formulations includes only thoroughly tested, efficacious ingredients for premium quality and safety. Our products are expertly designed for men and women of all ages, and strive to deliver uncompromising results to help you The Best You<sup style="font-size: 12px;">TM</sup>.</p>
                    </div>
                </div>
            </section>
            <section class="connection wrapper">
                <div class="customer-service"> <img src="images/56eebc.png">
                    <p>Customer Service</p>
                    <a href="contact-us.html">Contact</a> </div>
                <div class="follow-us">
                    <div class="sm icon-wrap"> <a href="#" target="_blank"><img src="images/5f58ea.png" class="sm-icon"></a> <a href="#" target="_blank"><img src="images/8b636a.png" class="sm-icon"></a> <a href="#" target="_blank"><img src="images/70f467.png" class="sm-icon"></a> <a href="#" target="_blank"><img src="images/266418.png" class="sm-icon"></a> </div>
                    <p style="display: block !important;">Follow Us &amp; Stay In The Know</p>
                </div>
            </section>
            <section class="retailers wrapper">
                <div class="retail-txt">
                    <p>Find <strong>Virtus Nutra</strong> at These Retailers</p>
                </div>
                <div class="retail-imgs"> <img src="images/3d6ea2.png" class="retail-img"> <img src="images/0aad6b.png" class="retail-img"> <img src="images/edef61.png" class="retail-img"> <img src="images/70cba2.png" class="retail-img"> <img src="images/4dbe94.png" class="retail-img"> <img src="images/33a8fb.png" class="retail-img"> <img src="images/d749d7.png" class="retail-img"> <img src="images/61f381.png" class="retail-img"> <img src="images/a44784.png" class="retail-img"> <img src="images/ba94fc.png" class="retail-img"> <img src="images/d5120c.png" class="retail-img"> </div>
            </section>
            <?php include('footer.php') ?>
        </div>
