<?php

include('./dbConnection.php');

?>

<!doctype html>
<html class="no-js" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Products - Force Factor</title>
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, height=device-height"/>
        <link href="css/global.css" rel="stylesheet" />
        <link href="css/site_page-2.css" rel="stylesheet" />
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/modernizr-2.8.3.min.js"></script>
    </head>

    <body class="retail">
        <div class="page_container">

            <?php include('header.php') ?>
            <section class="aspot">
                <div>
                    <div class="products-slide slide-1"></div>
                </div>
                <div>
                    <div class="products-slide slide-2"></div>
                </div>
                <div>
                    <div class="products-slide slide-3"></div>
                </div>
                <div>
                    <div class="products-slide slide-4"></div>
                </div>
            </section>
            <!--<section class="filter">
                <div class="wrapper">
                    <select class="filter-item">
                        <option value="">Filter</option>
                        <option onchange="filterProdcuts('200')"  value="200">Testosterone Boosters</option>
                        <option onchange="filterProdcuts('199')" value="199">Nitric Oxide (N.O.) Boosters</option>
                    </select>
                </div>
            </section>-->
            <section class="products">
                <div class="wrapper">
                    <div class="cat-section test-section" id="test">
                        <div class="prod-title">
                            <h2>Testosterone boosters</h2>
                        </div>
                        <p class="prod-desc">Improve libido, lean muscle, & performance</p>
                        <?php
                            $sql = "SELECT * FROM products";
                            $stmt = mysqli_prepare($conn, $sql);
                            $result = getDataFun($stmt);
                        
                            if (!empty($result)) {
                            foreach ($result as $key => $row) {
                                $image = json_decode($row['image']);
                        ?>                             
                                <div class="prod prod-1"> 
                                    <a href="product_detail.php?id=<?php echo $row['ll_product_id']; ?>"><img src="admin/uploads/<?php echo $image[0]; ?>"></a>
                                    <a class="prod_detail_link" href="product_detail.php?id=<?php echo $row['ll_product_id']; ?>">Click For Detail</a>
                                    <h3><?php echo $row['product_name']; ?></h3>
                                    <p class="prod-price">$<span><?php echo $row['product_price']; ?></span></p>
                                    <div class="prod-info">            
                                        <input  onClick="add_tocart_sep('<?php echo $row['ll_product_id']; ?>', '<?php echo $row['product_name']; ?>', '<?php echo $row['product_price']; ?>', '<?php echo $row['image']; ?>', '1');" type="button" class="prod-add prod-btn" value="Add to Cart">
                                        <a href="#" class="prod-try prod-btn">Free Sample<sup>*</sup></a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <!-- <div class="prod prod-1"> 
                             <a href="product_detail.php"> <img src="images/bottle.png"> </a>
                          <a class="prod_detail_link" href="product_detail.php">Click For Detail</a>
                            <h3>Testo Boost Pro</h3>
                             <p class="prod-price">$<span>89.00</span></p>
                             <div class="prod-info">            
                                 <input onClick="add_tocart_sep('1', 'Testo Boost Pro', '89.00', 'bottle.png', '1');" type="button" class="prod-add prod-btn" value="Add to Cart">
                                 <a href="#" class="prod-try prod-btn">Free Sample<sup>*</sup></a>
                             </div>
                         </div>
                         <div class="prod prod-2">
                             <a href="product_detail.php"> <img src="images/product_2.png"> </a>
                          <a class="prod_detail_link" href="product_detail.php">Click For Detail</a>
                             <h3>Nox Pro</h3>
                             <p class="prod-price">$<span>79.00</span></p>
                             <div class="prod-info">                                  
                                 <input onClick="add_tocart_sep('2', 'Nox Pro', '79.00', 'product_2.png', '1');" type="submit" class="prod-add prod-btn" value="Add to Cart">         
                             </div>
                         </div>-->


                    </div>
                </div>
            </section>
            <?php include('footer.php') ?>
        </div>
        <script type="text/javascript" src="js/global.js"></script> 
        <script type="text/javascript" src="js/site_page-2.js"></script> 

        <script type="text/javascript">
                                    var link = document.createElement('link');
                                    link.href = "https://fonts.googleapis.com/css?family=Lato:400,700";
                                    link.rel = "stylesheet";
                                    document.getElementsByTagName('head')[0].appendChild(link);
                                    // <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
        </script> 
        <script type="text/javascript">
            var link = document.createElement('link');
            link.href = "https://fonts.googleapis.com/css?family=Lato:400,700";
            link.rel = "stylesheet";
            document.getElementsByTagName('head')[0].appendChild(link);
            // <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
        </script>
        <link rel="stylesheet" type="text/css" href="css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="css/slick-theme.min.css"/>
        <script defer type="text/javascript" src="js/slick.min.js"></script>
        <style>
            .slick-dots {
                bottom: 28px;
            }
            .slick-dots li.slick-active button:before,
            .slick-dots li button:before {
                color: #FFF;
                opacity: 1;
                font-size: 30px;
                top: 5px;
                left: -2px;
            }
            .slick-dots li button {
                border: 1px solid #FFF;
                border-radius: 100%;
                width: 25px;
                height: 25px;
            }
            .slick-dots li button:before {
                color: transparent;
            }
            @media only screen and (max-width: 1000px) {
                .slick-dots li {
                    margin: 0 10px;
                }
            }
            @media only screen and (min-width: 1000px) {
                .slick-dots {
                    bottom: 20px;
                }
                .slick-dots li button {
                    border: 1px solid #FFF;
                    border-radius: 100%;
                    width: 13px;
                    height: 13px;
                }
                .slick-dots li.slick-active button:before,
                .slick-dots li button:before {
                    font-size: 15px;
                    top: -2px;
                    left: -3px;
                }
            }
        </style>
        <div id="nc-pixel-container-footer"> </div>
    </body>
</html>
