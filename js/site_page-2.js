

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


$(document).ready(function(){
    $('.aspot').slick({
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
        dots: true,
    });
});


$(function() {
    $('.filter-item').on('change', function() {
        $('.cat-section').hide();
        $("." + $(this).val() + "-section").show();
    });
});




