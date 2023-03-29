function validateZipCode(zip_code, country) {
    var valid = true;
    if (country == 'US' || !country) {
        valid = zip_code.match(/^(\d{5})$/);
    }
    return valid !== null;
}



(function ($) {

    // Force Mandatory Checkbox
    $('.mandatory-offer-item-checkbox').live(
        'change',
        function() {
            $el = $(this);
            if (!$el.is(':checked')) {
                $el.attr('checked', 'checked');
            }
        }
    );

    // Rewrite URL on Error
    if ($('.auth-response-fail-message').length > 0) {
        if (document.referrer) {
            window.history.replaceState(null, null, document.referrer);
        }
    }

})(jQuery);

var Validate = {
    leadgeneration: function () {
        internalLink = true;
        return true;
    },
    qualify: function () {
        internalLink = true;
        return true;
    },
    billing: function () {
        internalLink = true;
        return true;
    },
    oneStepBilling: function () {
        internalLink = true;
        return true;
    }
}


$(document).ready(function(){
    
    $('.cvv-link').click(function() {
        window.open($(this).attr('href'),'title', 'width=500, height=360, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, copyhistory=no, resizable=yes');
        return false;
    });
    
    $('.legal-link').click(function() {
        window.open($(this).attr('href'),'title', 'width=600, height=400, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, copyhistory=no, resizable=yes');
        return false;
    });
    
    // Lander - form submission
    if ($('.leadgeneration #form').length > 0 ) {
        $('.leadgeneration #form').submit(function() {
            return Validate.lander();
        });
    }

    // Qualify page - form submission
    if ($('.qualify #form').length > 0 ) {
        $('.qualify #form').submit(function() {
            return Validate.qualify();
        });
    }

    // Billing Page form Submission (incl one-step)
    if ($('.billing #form').length > 0 ) {
        $('.billing #form').submit(function() {
            return Validate.billing();
        });
    }
    
    $('#country').on('change', function (){
        stateAttr  = $('#state').attr('tabindex');
        stateClass = $('#state').attr('class');
        stateStyle = $('#state').attr('style');
        $.getJSON('/service_lead/get-state-options?country='+$(this).val(),  function(data){
            var options ='<select name="lead_responses[state]"';
            if(stateAttr){
                options+= ' class="'+stateClass+'" '
            }
            if(stateStyle){
                options+= ' style="'+stateStyle+'" '
            }
            options += 'id="state" tabindex="'+stateAttr+'" required=""><option value="">State</option>';
            for (var x = 0; x < data.states.length; x++) {
                options += '<option value="' + data.states[x].value + '">' + data.states[x].label + '</option>';
            }
            options += '</select>';
            $('#state').empty().html(options);
        });
        
/******** Zip  **********/
        if($(this).val() == "US"){
            var zipType = "tel";
        } else {
            var zipType = "text";
        }
        var zipClass        = $('.zip-div input').attr('class');
        var zipStyle        = $('.zip-div input').attr('style');
        var zipPlaceholder  = $('.zip-div input').attr('placeholder');
        var zipTitle        = $('.zip-div input').attr('title');
        var zipTab          = $('.zip-div input').attr('tabindex');
        var zipChange       = $('.zip-div input').attr('onchange');
        var zipValue        = $('.zip-div input').attr('value');
        var zipRequired     = $('.zip-div input').data('required');

        var zipInput = '<input ';
        if(zipPlaceholder){
            zipInput += 'placeholder="'+ zipPlaceholder +'" ';
        }
        if(zipTitle){
            zipInput += 'title="'+ zipTitle +'" ';
        }
        if(zipClass){
            zipInput += 'class="'+ zipClass +'" ';
        }
        if(zipStyle){
            zipInput += 'style="'+ zipStyle +'" ';
        }
        if(zipChange){
            zipInput += 'onchange="'+ zipChange +'" ';
        }
        if(zipValue){
            zipInput += 'value="'+ zipValue +'" ';
        }
        if(zipRequired){
            zipInput += 'data-required="'+ zipRequired +'" ';
        }
        zipInput += 'name="lead_responses[zip_code]" id="zip-code" type="'+zipType+'" tabindex="'+zipTab+'" required="">';
        
        $('#zip-code').remove();
        $('.zip-div').append(zipInput);
/******** End Zip  **********/
    });
});

var Validate = {
    lander: function () {
        var error_message = '';
        internalLink = false;
        if (document.getElementById('first-name') != undefined && document.getElementById('first-name').value == "") {
            error_message += "Please enter your First Name\n"
        }
        if ($('#age').length > 0 && $('#age').val() == "") {
            error_message += "Please enter your Age\n"
        }
        if (document.getElementById('zip-code')) {
            if (document.getElementById('zip-code').value == "") {
                error_message += "Please enter your ZIP/Postal Code\n"
            }
            var zipPattern = /^\d+$/;
            if (document.getElementById("country") != undefined && document.getElementById("country").value == "US") {
                if (!document.getElementById("zip-code").value.match(/^([0-9]{5})(?:[-\s]?([0-9]{4}))?$/)) {
                    error_message += 'ZIP Code needs to be in a valid format. (i.e. 55555 or 55555-5555)\n';
                }
            }
            if (document.getElementById("country") != undefined && document.getElementById("country").value == "AU") {
                if (document.getElementById("zip-code").value.length != 4 || !document.getElementById("zip-code").value.match(zipPattern))
                    error_message += "Please enter postcode as four numbers\n";
            }
            if (document.getElementById('country') != undefined && document.getElementById("country").value == "CA") {
                var zip_temp = document.getElementById("zip-code").value;
                // Strips non alphanumeric
                zip_temp = zip_temp.replace(/[^a-zA-Z0-9]/g, '');
                // Checks alternating like A0A 0A0 - DFIOQU do not appear in CA postal code
                var ca_zip_regex = /([ABCEGHJKLMNPRSTVWXYZ]\d){3}/i;
                if (!zip_temp.match(ca_zip_regex) || zip_temp.length > 6) // Also must be six chars only
                    error_message += "Please enter a valid CA Postal Code.\n"
            }
            if (document.getElementById('country') != undefined && document.getElementById("country").value == "GB") {
                var zip_temp = document.getElementById("zip-code").value;
                // Strips spaces
                zip_temp = zip_temp.replace(/[^a-zA-Z0-9]/g, '');
                            
                var gb_zip_regex = /^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$/i;

                if (!zip_temp.match(gb_zip_regex) || zip_temp.length > 7 || zip_temp.length < 5)
                    error_message += "Please enter a valid UK Post Code.\n"
            }
        }
        if (error_message == '') {
            internalLink = true;
            return true
        } else {
            alert(error_message);
            return false
        }
    },
    qualify: function () {
        var error_message = '';
        internalLink = false;
        if (document.getElementById('first-name').value == "") {
            error_message += "Please enter your First Name\n"
        }
        if (document.getElementById('last-name').value == "") {
            error_message += "Please enter your Last Name\n"
        }
        if (document.getElementById('address').value == "") {
            error_message += "Please enter your Address\n"
        }
        if (document.getElementById('city').value == "") {
            error_message += "Please enter your City\n"
        }
        if (document.getElementById('state').value == "") {
            error_message += "Please select your State\n"
        }
        if (document.getElementById('zip-code')) {
            if (document.getElementById('zip-code').value == "") {
                error_message += "Please enter your ZIP/Postal Code\n"
            }
            var zipPattern = /^\d+$/;
            if (document.getElementById("country") == null || document.getElementById("country").value == "US") {
                if (!document.getElementById("zip-code").value.match(/^([0-9]{5})(?:[-\s]?([0-9]{4}))?$/)) {
                    error_message += 'ZIP Code needs to be in a valid format. (i.e. 55555 or 55555-5555)\n';
                }
            }
            if (document.getElementById("country") != undefined && document.getElementById("country").value == "AU") {
                if (document.getElementById("zip-code").value.length != 4 || !document.getElementById("zip-code").value.match(zipPattern))
                    error_message += "Please enter postcode as four numbers\n";
            }
            if (document.getElementById('country') != undefined && document.getElementById("country").value == "CA") {
                var zip_temp = document.getElementById("zip-code").value;
                // Strips non alphanumeric
                zip_temp = zip_temp.replace(/[^a-zA-Z0-9]/g, '');
                // Checks alternating like A0A 0A0 - DFIOQU do not appear in CA postal code
                var ca_zip_regex = /([ABCEGHJKLMNPRSTVWXYZ]\d){3}/i;
                if (!zip_temp.match(ca_zip_regex) || zip_temp.length > 6) // Also must be six chars only
                    error_message += "Please enter a valid CA Postal Code.\n"
            }
            if (document.getElementById('country') != undefined && document.getElementById("country").value == "GB") {
                var zip_temp = document.getElementById("zip-code").value;
                // Strips spaces
                zip_temp = zip_temp.replace(/[^a-zA-Z0-9]/g, '');
                            
                var gb_zip_regex = /^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$/i;

                if (!zip_temp.match(gb_zip_regex) || zip_temp.length > 7 || zip_temp.length < 5)
                    error_message += "Please enter a valid UK Post Code.\n"
            }
        }
        if (document.getElementById('phone').value == "") {
            error_message += "Please enter your Phone Number\n"
        }
        if (document.getElementById("country") != undefined && document.getElementById("country").value == "AU") {
            var pattern = /^\D*0(\D*\d){9}\D*$/;
            var format = "05-5555-5555";
        } else if (document.getElementById('country') != undefined && document.getElementById("country").value == "GB") {
            // var pattern = /^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/;
            var pattern = "";
            var format = "+44 7222 555 555, (0722) 5555555, etc...";
        } else {
            var pattern = /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
            var format = "555-555-5555";
        }
        if (!document.getElementById('phone').value.match(pattern) && document.getElementById('phone').value != "") {
            error_message += "Phone Number needs to be in a valid format. (i.e. " + format + ")\n"
        }
        if (document.getElementById('email').value == "") {
            error_message += "Please enter your Email Address\n"
        }
        var pattern = /[^\s@]+@([a-z0-9\-]+\.)+[a-z]{2,6}/i;
        if (!document.getElementById('email').value.match(pattern) && document.getElementById('email').value != "") {
            error_message += "The Email Address does not appear to be valid\n"
        }
        if (error_message == "") {
            internalLink = true;
            return true
        } else {
            alert(error_message);
            return false
        }
    },
    billing: function () {
        var error_message = '';
        internalLink = false;
        $("input[type=submit]").attr('disabled','disabled');
        if (document.getElementById('first-name') && (document.getElementById('first-name').value == "")) {
            error_message += "Please enter your First Name\n"
        }
        if (document.getElementById('last-name') && (document.getElementById('last-name').value == "")) {
            error_message += "Please enter your Last Name\n"
        }
        if (document.getElementById('address') && (document.getElementById('address').value == "")) {
            error_message += "Please enter your Address\n"
        }
        if (document.getElementById('city') && (document.getElementById('city').value == "")) {
            error_message += "Please enter your City\n"
        }
        if (document.getElementById('state') && (document.getElementById('state').value == "")) {
            error_message += "Please select your State\n"
        }
        if (document.getElementById('zip-code')) {
            if (document.getElementById('zip-code').value == "") {
                error_message += "Please enter your ZIP/Postal Code\n"
            }
            var zipPattern = /^\d+$/;
            if (document.getElementById("country") == null || document.getElementById("country").value == "US") {
                if (!document.getElementById("zip-code").value.match(/^([0-9]{5})(?:[-\s]?([0-9]{4}))?$/)) {
                    error_message += 'ZIP Code needs to be in a valid format. (i.e. 55555 or 55555-5555)\n';
                }
            }
            if (document.getElementById("country") != undefined && document.getElementById("country").value == "AU") {
                if (document.getElementById("zip-code").value.length != 4 || !document.getElementById("zip-code").value.match(zipPattern))
                    error_message += "Please enter postcode as four numbers\n";
            }
            if (document.getElementById('country') != undefined && document.getElementById("country").value == "CA") {
                var zip_temp = document.getElementById("zip-code").value;
                // Strips non alphanumeric
                zip_temp = zip_temp.replace(/[^a-zA-Z0-9]/g, '');
                // Checks alternating like A0A 0A0 - DFIOQU do not appear in CA postal code
                var ca_zip_regex = /([ABCEGHJKLMNPRSTVWXYZ]\d){3}/i;
                if (!zip_temp.match(ca_zip_regex) || zip_temp.length > 6) // Also must be six chars only
                    error_message += "Please enter a valid CA Postal Code.\n"
            }
            if (document.getElementById('country') != undefined && document.getElementById("country").value == "GB") {
                var zip_temp = document.getElementById("zip-code").value;
                // Strips spaces
                zip_temp = zip_temp.replace(/[^a-zA-Z0-9]/g, '');
                            
                var gb_zip_regex = /^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$/i;

                if (!zip_temp.match(gb_zip_regex) || zip_temp.length > 7 || zip_temp.length < 5)
                    error_message += "Please enter a valid UK Post Code.\n"
            }
        }
        if (document.getElementById("phone") && (document.getElementById('phone').value == "")) {
            error_message += "Please enter your Phone Number\n"
        }
        if (document.getElementById("phone") && document.getElementById("country") != undefined && document.getElementById("country").value == "AU") {
            var pattern = /^\D*0(\D*\d){9}\D*$/;
            var format = "05-5555-5555";
        } else if (document.getElementById('country') != undefined && document.getElementById("country").value == "GB") {
            // var pattern = /^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/;
            var pattern = "";
            var format = "+44 7222 555 555, (0722) 5555555, etc...";
        } else {
            var pattern = /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
            var format = "555-555-5555";
        }
        if (document.getElementById("phone") && !document.getElementById('phone').value.match(pattern) && document.getElementById('phone').value != "") {
            error_message += "Phone Number needs to be in a valid format. (i.e. " + format + ")\n"
        }
        if (document.getElementById("email") && document.getElementById('email').value == "") {
            error_message += "Please enter your Email Address\n"
        }
        var pattern = /[^\s@]+@([a-z0-9\-]+\.)+[a-z]{2,6}/i;
        if (document.getElementById("email") && !document.getElementById('email').value.match(pattern) && document.getElementById('email').value != "") {
            error_message += "The Email Address does not appear to be valid\n"
        }
        if (document.getElementById('terms-agree') != null && document.getElementById('terms-agree').checked != true ){
            error_message += "You must agree to the Terms & Conditions\n"
        }
        if (error_message == "") {
            internalLink = true;
            return true
        } else {
            $("input[type=submit]").removeAttr('disabled');
            alert(error_message);
            return false
        }
    }
}

