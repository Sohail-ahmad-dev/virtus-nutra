

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
    var main_img = $('.main-img').prop('src');
    
    $('.prev-img').hover(function() {
        main_img = $('.main-img').prop('src');
        $('.main-img').attr('src', $(this).prop('src'));
    }, function() {
        $('.main-img').attr('src', main_img);
    }).click(function() {
        main_img = $(this).prop('src');
    });
    
    $('.flav').on('change', function() {
        $('.sku-img').each(function() {
           if($(this).attr('src').includes($('.flav').data('current'))) {
                $(this).attr('src', $(this).attr('src').replace($('.flav').data('current'), $('.flav').find('option:selected').data('sku')));
           } 
        });
        $('.facts img').attr('src', $('.facts img').attr('src').replace($(this).data('current'), $(this).find('option:selected').data('sku')));
        $(this).data('current', $(this).find('option:selected').data('sku'));
        $('.hid-prod').attr('name', 'shopping_cart_responses[add][' + $(this).val() + ']');
    });     
    $('.qty').on('change', function() {
        $('.hid-prod').val($(this).val());
    });
});



$(function() {
    $('.accord').on('click', function() {
        $(this).find('.panel').slideDown();
        $(this).find('.accord-header span').html('-');
        $(this).siblings().find('.panel').slideUp();
        $(this).siblings().find('.accord-header span').html('+');
    });
    doJson("https://www.forcefactor.com/service_form/view-testimonials?product_family_id=46&page_number=1&rows_per_page=10");
    $('.write-link').on('click', function() {
        $('.review-add-toggle').toggle();
        $('html, body').animate({
            scrollTop: $(".reviews").offset().top
        }, 500);
    });
    $('.submit-review').on('click', function(){
        validateReview();
    });
});
function doJson(reviews) {
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
                    $('.reviews-section').append('<div class="review"><p class="date">' + review.created_at.substring(0, review.created_at.indexOf(' ')) + '</p><p class="name">' + fullname_html + '</p><p class="comment">' + review.comment + '</p>');
                });
            } else {
                $('.write').hide();
                $('.reviews-section .none').show();
            }
        }
    });
}
function validateReview() {
    var no_errors = true;
    $('.field-error').remove();
    $('.validate-field').each(function(e) {
        if(!$(this).val()) {
            $(this).after('<div class="field-error">Field is Required</div>');
            no_errors = false;
        }
    });

    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if (!pattern.test($('.email_address').val())) {
        $('.email_address').after('<div class="field-error">Enter Valid Email</div>');
        no_errors = false;
    }

    if(no_errors) {
        submitReview();
        $('.review-submitted-toggle').toggle();
        $('html, body').animate({
            scrollTop: $(".reviews").offset().top
        }, 500);
    }
}
var focusReview = function (response) {
    console.log('focusReview');
    $("html, body").animate({ scrollTop: $(".review-header").offset().top }, "slow");
};
var onloadCallback = function () {
    console.log('onloadCallback');
    var widget = grecaptcha.render(document.getElementById("re-captcha"), {
        'sitekey' : "6LegfSgUAAAAAJkSbv1eZD997Am8knvLFEv9zsdY",
        'theme': "light",
        'callback' : focusReview
    });
};

function submitReview() {
    console.log('submitReview');
    var first_name      = encodeURI($(".first_name").val());
    var last_name       = encodeURI($(".last_name").val());
    var email_address   = encodeURI($(".email_address").val());
    var product         = encodeURI($(".product").val());
    var comment         = encodeURI($(".comment").val());

    var reviewUrl = 'https://www.forcefactor.com/service_form/add-testimonial?data={"brand_id":"1","first_name":"' + first_name + '","last_name":"' + last_name + '","email_address":"' + email_address + '","product_families":[' + product + '],"comment":"' + comment + '"}';
    $.ajax(reviewUrl);
}



