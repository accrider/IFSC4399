<?php 
require "log4php-library.php"; 
require "datatype-validation-library.php";
$_SESSION["username"] = "Bauer";
$logger->trace("Beginning datatype-validation-test...");

$strBooleanErr = "";
$strBoolean = "";

$strEmailErr = "";
$strEmail = "";

$strFloatErr = "";
$strFloat = "";

$strIntErr = "";
$strInt = "";

$strIPErr = "";
$strIP = "";

$strURLErr = "";
$strURL = "";

$strDateErr = "";
$strDate = "";

$strHTMLDateErr = "";
$strHTMLDate = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $strBoolean = GetFromPOST("strBoolean");
    // check if input is a valid Boolean
    $strBooleanErr = isValidBoolean($strBoolean);
    if ($strBooleanErr == "") {
        $strBooleanErr = "Valid Boolean";
    } else {
        $logger->debug($strBooleanErr . " - entered value = " . $strBoolean);
    }

    $strEmail = GetFromPOST("strEmail");
    // check if input is a valid Email
    $strEmailErr = isValidEmail($strEmail);
    if ($strEmailErr == "") {
        $strEmailErr = "Valid Email";
    } else {
        $logger->debug($strEmailErr . " - entered value = " . $strEmail);
    }
    
    $strFloat = GetFromPOST("strFloat");
    // check if input is a valid Floating Number
    $strFloatErr = isValidFloat($strFloat);
    if ($strFloatErr == "") {
        $strFloatErr = "Valid Floating Number";
    } else {
        $logger->debug($strFloatErr . " - entered value = " . $strFloat);
    }

    $strInt = GetFromPOST("strInt");
    // check if input is a valid Integer
    $strIntErr = isValidInt($strInt);
    if ($strIntErr == "") {
        $strIntErr = "Valid Integer";
    } else {
        $logger->debug($strIntErr . " - entered value = " . $strInt);
    }

    $strIP = GetFromPOST("strIP");
    // check if input is a valid IP Address
    $strIPErr = isValidIP($strIP);
    if ($strIPErr == "") {
        $strIPErr = "Valid IP Address";
    } else {
        $logger->debug($strIPErr . " - entered value = " . $strIP);
    }

    $strURL = GetFromPOST("strURL");
    // check if input is a valid URL
    $strURLErr = isValidURL($strURL);
    if ($strURLErr == "") {
        $strURLErr = "Valid URL";
    } else {
        $logger->debug($strURLErr . " - entered value = " . $strURL);
    }

    $strDate = GetFromPOST("strDate");
    // check if input is a valid URL
    $strDateErr = isValidDate($strDate);
    if ($strDateErr == "") {
        $strDateErr = "Valid Date";
    } else {
        $logger->debug($strDateErr . " - entered value = " . $strDate);
    }
    
    $strHTMLDate = GetFromPOST("strHTMLDate");
    // check if input is a valid URL
    $strHTMLDateErr = isValidHTMLDate($strHTMLDate);
    if ($strHTMLDateErr == "") {
        $strHTMLDateErr = "Valid Date";
    } else {
        $logger->debug($strHTMLDateErr . " - entered value = " . $strHTMLDate);
    }
}
require "datatype-validation-test-form.php"
?>  