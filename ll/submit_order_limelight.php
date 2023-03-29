<?php
include('config.php');
include('limelight.php');
if (!empty($_REQUEST['campaign_id']) && !empty($_REQUEST['creditCardType']) && !empty($_REQUEST['creditCardNumber'])) {
    $folder = '';
    $AFID = '';
    $AFFID = '';
    $SID = '';
    $C1 = '';
    $C2 = '';
    $C3 = '';
    $AID = '';
    $OPT = '';
    $click_id = '';
    $CID = '';
    $campaign_id = '';

    $lfields_fname = '';
    $lfields_lname = '';
    $lfields_address1 = '';
    $lfields_city = '';
    $lfields_state = '';
    $lfields_zip = '';
    $lcountry = '';
    $lfields_phone = '';
    $lfields_email = '';

    $lfields_fname = $_POST['billingFirstName'];

    $lfields_lname = $_POST['billingLastName'];

    $lfields_address1 = $_POST['billingAddress1'];

    $lfields_city = $_POST['billingCity'];

    $lfields_state = $_POST['billingState'];

    $lfields_zip = $_POST['billingZip'];

    $lcountry = $_POST['billingCountry'];

    $lfields_phone = $_POST['fields_phone'];

    $lfields_email = $_POST['fields_email'];


    if (!empty($_REQUEST['AFID'])) {
        $AFID = $_REQUEST['AFID'];
    }
    if (!empty($_REQUEST['SID'])) {
        $SID = $_REQUEST['SID'];
    }
    if (!empty($_REQUEST['AFFID'])) {
        $AFFID = $_REQUEST['AFFID'];
    }
    if (!empty($_REQUEST['C1'])) {
        $C1 = $_REQUEST['C1'];
    }
    if (!empty($_REQUEST['C2'])) {
        $C2 = $_REQUEST['C2'];
    }
    if (!empty($_REQUEST['C3'])) {
        $C3 = $_REQUEST['C3'];
    }
    if (!empty($_REQUEST['AID'])) {
        $AID = $_REQUEST['AID'];
    }
    if (!empty($_REQUEST['OPT'])) {
        $OPT = $_REQUEST['OPT'];
    }
    if (!empty($_REQUEST['click_id'])) {
        $click_id = $_REQUEST['click_id'];
    }
    if (!empty($_REQUEST['CID'])) {
        $CID = $_REQUEST['CID'];
    }
    if (!empty($_REQUEST['notes'])) {
        $notes = $_REQUEST['notes'];
    }
    $cc_type = $_REQUEST['creditCardType'];
    $cc_number = $_REQUEST['creditCardNumber'];
    $fields_expmonth = $_REQUEST['expMonth'];
    $fields_expyear = $_REQUEST['expYear'];
    $cc_cvv = $_REQUEST['cvv'];
    $billing_same_as_shipping = $_REQUEST['billingSameAsShipping'];
    $expirationDate = $fields_expmonth . $fields_expyear;
    $upsellCount = 0;
    $product_qty = 1;    
    $billingfanme = $_REQUEST['billingFirstName'];
    $billinglanme = $_REQUEST['billingLastName'];
    $billingaddress = $_REQUEST['billingAddress1'];
    $billingcity = $_REQUEST['billingCity'];
    $billingstate = $_REQUEST['billingState'];
    $billingzip = $_REQUEST['billingZip'];
    $billingcountry = $_REQUEST['billingCountry'];

//THIS FUNCTION IS FOR REGULAR CARD ORDER 
    if (!empty($_REQUEST['prospectId'])) {
        $content = NewOrderWithProspectLimelight($_REQUEST['campaign_id'], $_REQUEST['shipping_id'], $_POST['prospectId'], $cc_type, $cc_number, $expirationDate, $cc_cvv, $upsellCount, $billing_same_as_shipping, $product_qty, $custom_product_price_ll, $AFID, $SID, $AFFID, $C1, $C2, $C3, $AID, $OPT, $click_id);
    } else {
        $content = NewOrderLimelight($_REQUEST['campaign_id'], $_REQUEST['shipping_id'], $cc_type, $cc_number, $expirationDate, $cc_cvv, $productId, $product_qty, $custom_product_price_ll, $shippingId, $upsellCount, $billing_same_as_shipping, $AFID, $SID, $AFFID, $C1, $C2, $C3, $AID, $OPT, $click_id);
    }

//THIS FUNCTION IS FOR REGULAR CARD ORDER END	
    $ret = explode('&', $content);
    //get decline reason
    $decline = explode("=", $ret[2]);
    // check if prepaid decline
    $pppos = strpos($decline[1], "Prepaid");

    if (!empty($ret[1]) && $ret[1] == 'responseCode=100') {
        $exp = explode("=", $ret[5]);
        $limelight_order_id = $exp[1];
        $data = array();
        foreach ($ret AS $key => $value) {
            $newValues = @explode('=', $value);
            $data[$newValues[0]] = $newValues[1];
        }
        $url_param = $ssl_url . 'order-confirmation.php?AFID=' . $AFID . '&AFFID=' . $AFFID . '&SID=' . $SID . '&SOID=' . $AffiliateReferenceID . '&click_id=' . $click_id . '&C1=' . $C1 . '&C2=' . $C2 . '&C3=' . $C3;
        header('Location:' . $url_param);
    }
    //IF REGULAR ORDER DECLINE THEN THIS CODE WILL RUN
    else if ($pppos !== false) {
        // declined initial order with Prepaid decline
        //kill initial prospect    
        //unset($fields['prospectId']);
        // set prepaid campaign
        //$fields['campaignId']=urlencode('120');
        //$fields['method']=urlencode("NewOrder");
        //populate order info from session variables
        //THIS FUNCTION IS FOR PRE PAID CARD ORDER 

        if (!empty($_REQUEST['prospectId'])) {
            $content = NewOrderWithProspectLimelight($_REQUEST['prepaid_campaign_id'], $_POST['prospectId'], $cc_type, $cc_number, $expirationDate, $cc_cvv, $productId, $shippingId, $upsellCount, $billing_same_as_shipping, $product_qty, $custom_product_price_ll, $AFID, $SID, $AFFID, $C1, $C2, $C3, $AID, $OPT, $click_id, $notes, $billingaddress, $billingcity, $billingstate, $billingzip, $billingcountry, $billingfanme, $billinglanme);
        } else {
            $content = NewOrderLimelight($_REQUEST['prepaid_campaign_id'], $lfields_fname, $lfields_lname, $lfields_address1, $lfields_city, $lfields_state, $lfields_zip, $lcountry, $lfields_phone, $lfields_email, $cc_type, $cc_number, $expirationDate, $cc_cvv, $productId, $product_qty, $custom_product_price_ll, $shippingId, $upsellCount, $billing_same_as_shipping, $AFID, $SID, $AFFID, $C1, $C2, $C3, $AID, $OPT, $click_id, $notes = '', $billingaddress, $billingcity, $billingstate, $billingzip, $billingcountry, $billingfanme, $billinglanme);
        }

        $ret2 = explode('&', $content);

        if (!empty($ret2[1]) && $ret2[1] == 'responseCode=100') {
            $exp = explode("=", $ret2[5]);
            $limelight_order_id = $exp[1];
            $data = array();
            foreach ($ret2 AS $key => $value) {
                $newValues = @explode('=', $value);
                $data[$newValues[0]] = $newValues[1];
            }
            $_SESSION['First_ORDERID'] = $data['orderId'];
            echo $ssl_url . 'order-confirmation.php?AFID=' . $AFID . '&AFFID=' . $AFFID . '&SID=' . $SID . '&SOID=' . $AffiliateReferenceID . '&click_id=' . $click_id . '&C1=' . $C1 . '&C2=' . $C2 . '&C3=' . $C3 . '&prepaid=1';
        } else {
            $data = array();
            foreach ($ret2 AS $key => $value) {
                $newValues = @explode('=', $value);
                $data[$newValues[0]] = $newValues[1];
            }
            $errorMessage = urldecode($data['errorMessage']);
            $limelight_order_id = urldecode($data['orderId']);
            // echo urldecode($errorMessage.'|');
            echo $ssl_url . 'order.php?prospectId=' . urldecode($_POST['prospectId']) . '&AFID=' . $AFID . '&AFFID=' . $AFFID . '&SID=' . $SID . '&SOID=' . $AffiliateReferenceID . '&click_id=' . $click_id . '&C1=' . $C1 . '&C2=' . $C2 . '&C3=' . $C3 . '&errMssg=' . urldecode($errorMessage) . '&prepaid=1&pcode=1bottle';
        }
    } else {
        $data = array();
        foreach ($ret AS $key => $value) {
            $newValues = @explode('=', $value);
            $data[$newValues[0]] = $newValues[1];
        }
        $errorMessage = urldecode($data['errorMessage']);
        $limelight_order_id = urldecode($data['orderId']);
        //echo urldecode($errorMessage.'|');
        echo $ssl_url . 'order.php?prospectId=' . urldecode($_POST['prospectId']) . '&AFID=' . $AFID . '&AFFID=' . $AFFID . '&SID=' . $SID . '&SOID=' . $AffiliateReferenceID . '&click_id=' . $click_id . '&C1=' . $C1 . '&C2=' . $C2 . '&C3=' . $C3 . '&errMssg=' . urldecode($errorMessage) . '&prepaid=1&pcode=1bottle';
    }
    exit();
} else {
    $errorMessage1 = urldecode('Blank Fields');
    //echo urldecode($errorMessage1.'|');
    echo $ssl_url . 'order.php?prospectId=' . urldecode($_POST['prospectId']) . '&AFID=' . $AFID . '&AFFID=' . $AFFID . '&SID=' . $SID . '&SOID=' . $AffiliateReferenceID . '&click_id=' . $click_id . '&C1=' . $C1 . '&C2=' . $C2 . '&C3=' . $C3 . '&errMssg=' . urldecode($errorMessage1) . '&prepaid=1&pcode=1bottle';
}
?>