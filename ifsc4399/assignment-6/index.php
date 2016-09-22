<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
$_SESSION["username"] = "Adam";
$logger->trace("Beginning calculator assignment.");

$strOp1Error = "";
$strOp2Error = "";
$strOpError = "";

$op1;
$op2;
$operator;

$result = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $op1 = GetFromPOST("op1");
    $strOp1Error = isValidFloat($op1);
    if ($strOp1Error != "") {
        $logger->debug($strOp1Error . " - entered value = " . $strOp1Error);
    }


    $op2 = GetFromPOST("op2");
    $strOp2Error = isValidFloat($op2);
    if ($strOp2Error != "") {
        $logger->debug($strOp2Error . " - entered value = " . $strOp2Error);
    }
    $operator = GetFromPOST("operator");

    if ($strOp1Error == "" && $strOp2Error == "") {
        switch ($operator) {
            case '+':
                $result = $op1 + $op2;
                break;
            case '-':
                $result = $op1 - $op2;
                break;
            case '*':
                $result = $op1 * $op2;
                break;
            case '/':
                if ($op2 != 0) { //No Division by 0
                    $result = $op1 / $op2;
                } else {
                    $strOp2Error = "Division by 0";
                }
                break;
            default:
                $strOpError = "Invalid Operator";
                break;
        }
    }
}

require 'calculator.php';
?>