
function add_tocart_sep(pid, item_name, price, image, quantity) {
    if (quantity > 0) {
        var data_string = "action=addtocart&pid=" + pid + "&item_name=" + item_name + "&price=" + price + "&quantity=" + quantity + "&image=" + image;
        $.ajax({
            url: "ajax_reqst.php",
            type: "POST",
            data: data_string,
            success: function (data) {
                window.location.href = 'cart.php';
            }
        });
    }
}


function add_tocart_sep_detail(pid, item_name, price, image) {
    var quantity = $('#qty').val();
    if (quantity > 0) {
        var data_string = "action=addtocart&pid=" + pid + "&item_name=" + item_name + "&price=" + price + "&quantity=" + quantity + "&image=" + image;
        console.log(data_string);
        $.ajax({
            url: "ajax_reqst.php",
            type: "POST",
            data: data_string,
            success: function (data) {
                window.location.href = 'cart.php';
            }
        });
    }
}

function getShoppingCart() {
    var data_string = "action=getShoppingCart";
    $.ajax({
        url: "ajax_reqst.php",
        type: "POST",
        data: data_string,
        success: function (data) {
            var data = $.parseJSON(data);
            $('.mobile-cart-item-num').html(data['qty']);
            $('#cart_results').html(data['cart']);
            $('#error').html(data['empty']);
            var url = document.location.href;
            if (data['qty'] == 0 && (url == 'http://virtusnutra.com/cart.php' || url == 'https://virtusnutra.com/cart.php' )) {
                $('.empty').show();
            }
            getCartGrandTotalLower();
        }
    });
}

function add_tocart_checkout(keyID, pID, qty, type) {
    var data_string = "action=addtocartCheckout&keyID=" + keyID + "&pID=" + pID + "&qty=" + qty + "&type=" + type;
    $.ajax({
        url: "ajax_reqst.php",
        type: "POST",
        data: data_string,
        success: function (data) {
            window.location.href = 'cart.php';
        }
    });
}

function getCartGrandTotalLower() {
    var data_string = "action=getCartGrandTotalLower";
    $.ajax({
        url: "ajax_reqst.php",
        type: "POST",
        data: data_string,
        success: function (data) {
            $('#cart_total_grand').html(data);
        }
    });
}

function filterProdcuts(id) {
    var data_string = "action=getProduct";
    $.ajax({
        url: "ajax_reqst.php",
        type: "POST",
        data: data_string,
        success: function (data) {
            $('#cart_total_grand').html(data);
        }
    });
}


$(document).ready(function () {
    //alert('test');
});
