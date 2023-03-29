<?php

session_start();
if ($_POST['action'] == 'addtocart') {
    if ($_POST['quantity'] == '0') {
        echo '1';
    } elseif ($_POST['quantity'] != '0') {
        $exist = 0;
        $i = !empty($_SESSION['cart']) ? count($_SESSION['cart']): 0;
        if ($i > 0) {
            foreach ($_SESSION['cart'] as $keys => $values) {

                if($values['ll_product_id'] == $_POST['pid']){
                    $sesQuanty = intval($_SESSION['cart'][$keys]['quantity']);
                    $_SESSION['cart'][$keys]['quantity'] = $sesQuanty + intval($_POST['quantity']);
                    $exist = 1;
                }

            }
            if($exist == 0){
                $i += 1;
                $_SESSION['cart'][$i] = [
                    'll_product_id' => $_POST['pid'],
                    'item_name' => $_POST['item_name'],
                    'price' => $_POST['price'],
                    'quantity' => $_POST['quantity'],
                    'image' => $_POST['image'],
                ];
            }

        } elseif ($i == 0) {
            $_SESSION['cart'][$i] = [
                'll_product_id' => $_POST['pid'],
                'item_name' => $_POST['item_name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
                'image' => $_POST['image'],
            ];
        }
       
        
        echo '0';
    }
}

if ($_POST['action'] == 'getShoppingCart') {
    $cart_html = '';
    $is_rem = 0;
    if ($_SESSION['cart'] && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $keys => $values) {
            $rows = explode(',', $values);
            if ($rows['3'] == 0) {
                unset($_SESSION['cart'][$keys]);
                $is_rem = 1;
            }
        }
        if ($is_rem == 1) {
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        foreach ($_SESSION['cart'] as $keys => $values) {
            $rows = explode(',', $values);
            $cart_html .='<div class="prod-row">
                        <div class="prod-img"> <img src="images/' . $rows['4'] . '" alt="' . $rows['1'] . '"></div>
                        <div class="prod-details">
                            <div class="prod-img"></div>
                            <div class="prod-info">
                                <div class="prod-desc">Testosterone Boosters</div>
                                <div class="prod-name">' . $rows['1'] . '</div>
                            </div>
                            <div class="prod-price">$<span>' . number_format($rows['2'], 2) . '</span></div>
                            <form class="prod-amount" id="item-' . $rows['0'] . '">
                                <div class="prod-qty">
                                    <div class="dec qty-update">-</div>
                                    <input name="shopping_cart_responses[update][' . $rows['0'] . ']" value="' . $rows['3'] . '" type="tel">
                                    <div class="inc qty-update">+</div>
                                    <p onclick="add_tocart_checkout(\'' . $keys . '\',\'' . $rows['0'] . '\',1,1)";  class="prod-update">Update</p>
                                </div>
                                <p onclick="add_tocart_checkout(\'' . $keys . '\',\'' . $rows['0'] . '\',1,0)"; class="prod-remove">Remove</p>
                            </form>
                            <div class="prod-total">$<span>' . number_format(($rows['2']) * ($rows['3']), 2) . '</span></div>
                        </div>
                    </div>';
            $qty +=$rows['3'];
        }
    } else {
        $cart_html_error .= '<section style="display:none;" class="empty">
                    <div class="wrapper">
                        <h2>Your shopping cart is <span>empty</span></h2>
                        <p>To add something to your shopping cart, simply click the ADD TO CART button.</p>
                        <a href="products.php">Continue Shopping</a> </div>
                    <div class="summary">
                        <div class="wrapper"> <a href="products.php" class="cont-shopping"> Continue Shopping</a> </div>
                    </div>
                </section>';
        $qty = 0;
    }
    //echo $cart_html;
    $totalhtml = array();
    $totalhtml['cart'] = $cart_html;
    $totalhtml['empty'] = $cart_html_error;
    $totalhtml['qty'] = $qty;
    echo json_encode($totalhtml);
}


if ($_POST['action'] == 'addtocartCheckout') {
    $key = $_POST['keyID'];
    $pID = $_POST['pID'];
    $qty = $_POST['qty'];
    $type = $_POST['type'];
    if ($_SESSION['cart'] && count($_SESSION['cart']) > 0) {
        $collectData = $_SESSION['cart'][$key];
        $rows = explode(',', $collectData);
        if ($rows['0'] == $pID) {
            if ($type == '1') {
                $rows[3] = $rows[3] + $qty;
            } else {
                $rows[3] = $rows[3] - $qty;
            }
        }
        $_SESSION['cart'][$key] = implode(',', $rows);
    }
}

if ($_POST['action'] == 'getCartGrandTotalLower') {
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
    $total_html = ' <div class="summary-subtotal">
                                <p>Subtotal:</p>
                                <p>$<span>' . number_format($grandTotal, 2) . '</span></p>
                            </div>
                            <div class="summary-sh">
                                <p>S&amp;H:</p>
                                <p>$<span>4.99</span></p>
                            </div>
                            <div class="summary-total">
                                <p>Total:</p>
                                <p>$<span>' . number_format(($grandTotal + $shipping), 2) . '</span></p>
                        </div>';
    echo $total_html;
}
?>
