







$(function() {
    updateCartSubtotal();
});

function updateCartSubtotal() {
    var cartSubtotal = 0;
    $('.prod-row').each(function(){
        var prod_price = $(this).find(".prod-price span").html();
        var prod_qty = $(this).find(".prod-qty span").html();

        cartSubtotal += parseFloat(prod_price * prod_qty);
    });
    if(cartSubtotal) {
        $('.summary-subtotal span').html((cartSubtotal).toFixed(2));
    }
    updateCartTax();
}
function updateCartTax() {
    var pid      = 100;
    var zip_code = $('.zip-code').val();
    var subtotal = $('.summary-subtotal span').html();
    var shipping = $('.summary-sh span').html();
    
    var taxServiceUrl = 'https://www.forcefactor.com/ws/tax/params?pid=' + pid + '&zip_code=' + zip_code + '&price=' + subtotal + '&shipping=' + shipping + '&country=US';

	$.get(taxServiceUrl, function (response) {
    	var taxDataJson = JSON.stringify(response);
    	var taxData = JSON.parse(taxDataJson);
    	var tax = taxData.tax;
    	$('.summary-tax span').html(tax);
	    
	    updateCartTotal();
	}, "json");
	
}
function updateCartTotal() {
    console.log('updateCartTotal');
    var cartSubtotal = parseFloat($('.summary-subtotal span').html());
    var cartShipping = parseFloat($('.summary-sh span').html());
    var cartTax      = parseFloat($('.summary-tax span').html());
    
    $('.summary-total span').html((cartSubtotal + cartShipping + cartTax).toFixed(2));
}



