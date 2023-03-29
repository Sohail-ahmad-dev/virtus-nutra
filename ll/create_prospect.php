<?php

ini_set('display_errors', false);
include('config.php');
include('limelight.php');
$_SESSION['address'] = $_POST['address'];
$_SESSION['city'] = $_POST['city'];
$_SESSION['state'] = $_POST['state'];
$_SESSION['zip'] = $_POST['zip'];
if (!empty($_POST['campaign_id']) && !empty($_POST['email'])) {

    if (!empty($_POST['AFID'])) {
        $AFID = $_POST['AFID'];
    }
    if (!empty($_POST['SID'])) {
        $SID = $_POST['SID'];
    }
    if (!empty($_POST['AFFID'])) {
        $AFFID = $_POST['AFFID'];
    }
    if (!empty($_POST['C1'])) {
        $C1 = $_POST['C1'];
    }
    if (!empty($_POST['C2'])) {
        $C2 = $_POST['C2'];
    }
    if (!empty($_POST['C3'])) {
        $C3 = $_POST['C3'];
    }
    if (!empty($_POST['AID'])) {
        $AID = $_POST['AID'];
    }
    if (!empty($_POST['OPT'])) {
        $OPT = $_POST['OPT'];
    }
    if (!empty($_POST['CLICK_ID'])) {
        $click_id = $_POST['CLICK_ID'];
    }
    if (!empty($_POST['click_id'])) {
        $click_id = $_POST['click_id'];
    }
    if ($_REQUEST['shippingCountry'] == '13') {
        $Country = 'AU';
    }
    if ($_REQUEST['shippingCountry'] == '38') {
        $Country = 'CA';
    }
    if ($_REQUEST['shippingCountry'] == '96') {
        $Country = 'HK';
    }
    if ($_REQUEST['shippingCountry'] == '103') {
        $Country = 'IE';
    }
    if ($_REQUEST['shippingCountry'] == '129') {
        $Country = 'MY';
    }
    if ($_REQUEST['shippingCountry'] == '153') {
        $Country = 'NZ';
    }
    if ($_REQUEST['shippingCountry'] == '188') {
        $Country = 'SG';
    }
    if ($_REQUEST['shippingCountry'] == '193') {
        $Country = 'ZA';
    }
    if ($_REQUEST['shippingCountry'] == '223') {
        $Country = 'GB';
    }
//THIS IS POST DATA THAT USER WILL FILL ON STEP 1 FNAME,LNAME,EMAIL ETC
    $content = NewProspectLimelight($_POST['campaign_id'], $_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['shippingAptSuite'], $_POST['city'], $_POST['state'], $_POST['zip'], $country_2_digit = $Country, $_POST['phone_number'], $_POST['email'], $AFID, $SID, $AFFID, $C1, $C2, $C3, $AID, $OPT, $click_id);
    $ret = explode('&', $content);
    
   // print_r($ret);
    //$ret[2] = '450184';
    if ($ret[1] == 'responseCode=100') {
        //THIS IS PAGE PATH FOR ORDER PAGE
        $page = 'payment-information.php';
        $prospect_id = $ret[2];
    } else {
        //print_r($ret);
        $page = 'index.php';
        $prospect_id = 'mode=failure';
        $prospect_id = 'prospectId=';
     //   $prospect_id = $ret[2];
    }
    //$url_param = $ssl_url.$_POST['folder'].$page."?".trim($prospect_id)."&AFID=".$AFID."&AFFID=".$AFFID."&SID=".$SID."&TID=".$_TID."&AID=".$AID."&click_id=".$click_id."&C1=".$C1."&C2=".$C2."&C3=".$C3;
    $url_param = $ssl_url . "payment-information.php?" . trim($prospect_id) . "&AFID=" . $AFID . "&AFFID=" . $AFFID . "&SID=" . $SID . "&TID=" . $_TID . "&AID=" . $AID . "&click_id=" . $click_id . "&C1=" . $C1 . "&C2=" . $C2 . "&C3=" . $C3;
    header('Location:' . $url_param);

    exit();
}