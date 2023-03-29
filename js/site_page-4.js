

$('.mobile-menu').on('click', function() {
    $('.slideout-wrapper, .ghosted').show();
    $('body').addClass('mobile-slideout');
    $('.menu-toggle').toggle();
});
$('.ghosted, .mobile-close').on('click', function() {
    removeMobileMenu();
});
$('.menu-prod').on('click', function() {
    $('.prod-dropdown').slideToggle();
    $('.symbol-toggle').toggle();
});
function removeMobileMenu() {
    $('.slideout-wrapper, .ghosted').hide();
    $('body').removeClass('mobile-slideout');
    $('.menu-toggle').toggle();
}
if($("#shopping_cart_num").val() > 0){
    $(".mobile-cart").append("<span class='mobile-cart-item-num'>" + $("#shopping_cart_num").val() + "</span>")
}


$(function() {
    $('.prod-update').on('click', function() {
        if (!isNaN($(this).closest('.prod-row').find('.prod-qty input').val())) {
            updateCartItem(this);
        }
    });
    $('.dec').on('click', function() {
        skuQty = $(this).parent().find('input');
        if (skuQty.val() > 1) {
            skuQty.val(skuQty.val() - 1);
            updateCartItem(this);
        }
    });
    $('.inc').on('click', function() { 
        skuQty = $(this).parent().find('input');
        if (skuQty.val() < 10) {
            skuQty.val(parseInt(skuQty.val()) + 1);
            updateCartItem(this);
        }
    });
    $('.prod-remove').on('click', function() {
        $(this).parent().find('input').val(0);
        updateCartItem(this);
    });
    updateCartSubtotal();
});
function updateCartItem(e) {
    var itemData = $(e).closest('form').serialize();
    $.ajax({
        url: "/shopping-cart",
        data: itemData,
        success: function (data) {
            var itemPrice = $(e).closest('.prod-row').find('.prod-price span').html();
            var itemQty = $(e).closest('.prod-row').find('.prod-qty input').val();
            
            if (itemQty != '0' && isNaN(itemQty) === false) {
                $(e).closest('.prod-row').find('.prod-total span').html((itemPrice * itemQty).toFixed(2));
            } else {
                $(e).closest('.prod-row').remove();
            }
            
            updateCartSubtotal();
            
            /* update the number in the red circle above the cart icon */
            
            var cartTotal = 0;
            var cartNumItems = 0;
            
            $(".prod-qty input").each(function(){
            	if( isNaN(parseInt($(this).val())) === false ){
            	   cartTotal += parseInt($(this).val());
            	   cartNumItems++;   
            	}
            })

            if(cartNumItems === 0) {
                $('.mobile-cart-item-num').remove();
            } else {
                $('.mobile-cart-item-num').text(cartTotal); 
            }


        }
    });
}
function updateCartSubtotal() {
    var cartSubtotal = 0;
    $('.prod-total span').each(function(){
        if(isNaN(parseFloat($(this).html())) === false){
            cartSubtotal += parseFloat($(this).html());
        }
    });
    if(cartSubtotal) {
        $('.summary-subtotal span').html((cartSubtotal).toFixed(2));
    } else {
        $('.empty, .cart').toggle();
    }
    // if (!$('.zip-code').val()) {
    //     updateCartTax();
    // }
    updateCartTotal();
}
function updateCartTax() {
    console.log('updateCartTax');
    // $.get("https://api.ipdata.co/postal?api-key=5a83dbce9742b0d0a84ff77af02489d185b9747c21c76e1be8ec88fa", function(data) {
        // $('.zip-code').val(data);
    // });
}
function updateCartTotal() {
    console.log('updateCartTotal');
    var cartSubtotal = parseFloat($('.summary-subtotal span').html());
    var cartShipping = parseFloat($('.summary-sh span').html());
    
    $('.summary-total span').html((cartSubtotal + cartShipping).toFixed(2));
}



