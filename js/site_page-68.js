

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
    doJson("https://www.forcefactor.com/service_form/view-testimonials?page_number=1&rows_per_page=10");
    $('.filter').on('change', function() {
        $('.review-name span').html($('.filter option:selected').text());
        var prod_fam;
        if ($(this).val()) {
            prod_fam = "product_family_id=" + $(this).val() +"&";
        }
        doJson("https://www.forcefactor.com/service_form/view-testimonials?" + prod_fam + "page_number=1&rows_per_page=10");
    });
});
function doJson(reviews) {
    $('.products .review-wrap').html("");
    $.getJSON(reviews, function(json) {
        if (json.status == "success") {
            console.log(json.data);
            if ((json.data).length > 0) {
                $.each(json.data, function(key, review) {
                    var fname = review.first_name;
                    var lname = review.last_name;
                    var fullname_html = '';
                    if (fname && lname) {
                        fullname_html += fname + ' ' + lname.substring(0, 1) + '.';
                    } else {
                        fullname_html += review.full_name;
                    }
                    $('.products .review-wrap').append('<div class="review"><p class="date">' + review.created_at.substring(0, review.created_at.indexOf(' ')) + '</p><p class="name">' + fullname_html + '</p><p class="comment">' + review.comment + '</p>');
                });
            } else {
                $('.products .review-wrap').append('<div class="none">There are currently no reviews for this product. Be the first to <a href="#" class="write-link">write a review</a>!</div>');
            }
        }
    });
}



