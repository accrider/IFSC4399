<?php

function isValidBoolean($var) {
    //Returns blank error message for a true character string, such as "1", "true", "on" and "yes"
    //Returns blank error message for a false character string, such as "0", "false", "off" and "no"
    //Otherwise returns an error message

    //Check for unsafe characters
    $msg = isSantizeString($var);
    if ($msg != "") {
        return $msg;
    }

    $msg = filter_var($var, FILTER_VALIDATE_BOOLEAN,  FILTER_NULL_ON_FAILURE);
    if ($msg === true || $msg === false) {
            return "";
    } else {
        return "Invalid Boolean";
    }
}

function isValidEmail($var) {
    //Returns blank error message for a valid email
    //Returns error message for an invalid email

    //Check for unsafe characters
    $msg = isSantizeString($var);
    if ($msg != "") {
        return $msg;
    }

    if (filter_var($var, FILTER_VALIDATE_EMAIL)) {
            return "";
        } else {
            return "Invalid Email";
    }
}

function isValidFloat($var) {
    //Returns blank error message for a valid float string
    //Returns error message for an invalid float string

    //Check for unsafe characters
    $msg = isSantizeString($var);
    if ($msg != "") {
        return $msg;
    }

    if (filter_var($var, FILTER_VALIDATE_FLOAT)) {
            return "";
        } else {
            return "Invalid Floating Number";
    }
}

function isValidInt($var) {
    //Returns blank error message for a valid integer string
    //Returns error message for an invalid integer string

    //Check for unsafe characters
    $msg = isSantizeString($var);
    if ($msg != "") {
        return $msg;
    }

    //Note: Special case for filter_var and zero values
    if (filter_var($var, FILTER_VALIDATE_INT) === 0 || filter_var($var, FILTER_VALIDATE_INT)) {
        return "";
    } else {
        return "Invalid Integer";
    }
}

function isValidIP($var) {
    //Returns blank error message for a valid IP address (xxx.xxx.xxx.xxx)
    //Returns error message for an invalid IP Address
    
    //Check for unsafe characters
    $msg = isSantizeString($var);
    if ($msg != "") {
        return $msg;
    }

    if (filter_var($var, FILTER_VALIDATE_IP)) {
        return "";
    } else {
        return "Invalid IP Address";
    }
}

function isValidURL($var) {
    //Returns blank error message for a valid URL
    //Returns error message for an invalid URL
    
    //Check for unsafe characters
    $msg = isSantizeString($var);
    if ($msg != "") {
        return $msg;
    }

    if (filter_var($var, FILTER_VALIDATE_URL)) {
        return "";
    } else {
        return "Invalid URL";
    }
}

function isValidDate ($var) {
    //Returns blank error message for a valid date (mm/dd/yy or mm/dd/yyyy)
    //Returns error message for an invalid date
    
    //Check for unsafe characters
    $msg = isSantizeString($var);
    if ($msg != "") {
        return $msg;
    }
    // Format mm/dd/yy or mm/dd/yyyy
    $tmpDate = explode("/",$var);

    //if the date can't be split into 3 parts, then a "/" was missing
    if (count($tmpDate) != 3) {
            return "Invalid Date";        
    }
    
    // isValidInt does not validate numbers with leading zeros.  Strip off the leading zeros.
    $tmpDate[0] = ltrim($tmpDate[0], "0"); 
    $tmpDate[1] = ltrim($tmpDate[1], "0"); 
    $tmpDate[2] = ltrim($tmpDate[2], "0");
    
    //Make sure all of the parts are valid numbers
    if (isValidInt($tmpDate[0]) == "" && isValidInt($tmpDate[1]) == "" && isValidInt($tmpDate[2]) == "") {
        
        // Use checkdate to validate the date
        if (checkdate($tmpDate[0], $tmpDate[1], $tmpDate[2])) { //checkdate(month, day, year)
            return "";
        } else {
            return "Invalid Date";
        }
    } else {
        return "Invalid Date";
    }
}

function isValidHTMLDate ($var) {
    //Returns blank error message for a valid date (yyyy-mm-dd or yy-mm-dd)
    //Returns error message for an invalid date

    //Check for unsafe characters
    $msg = isSantizeString($var);
    if ($msg != "") {
        return $msg;
    }
    // Format yyyy-mm-dd or yy-mm-dd
    $tmpDate = explode("-",$var);
    //if the date can't be split into 3 parts, then a "-" was missing
    if (count($tmpDate) != 3) {
            return "Invalid Date";        
    }

    // isValidInt does not validate numbers with leading zeros.  Strip off the leading zeros.
    $tmpDate[0] = ltrim($tmpDate[0], "0"); 
    $tmpDate[1] = ltrim($tmpDate[1], "0"); 
    $tmpDate[2] = ltrim($tmpDate[2], "0"); 

    //Make sure all of the parts are valid numbers
    if (isValidInt($tmpDate[0]) == "" && isValidInt($tmpDate[1]) == "" && isValidInt($tmpDate[2]) == "") {

        // Use checkdate to validate the date
        if (checkdate($tmpDate[1], $tmpDate[2], $tmpDate[0])) { //checkdate(month, day, year)
            return "";
        } else {
            return "Invalid Date";
        }
    } else {
        return "Invalid Date";
    }
}

function isSantizeString($var) {
    //Returns blank error message if the string does not contain special characters
    //Returns error message if it does

    //Sanitize the string, then see if there are any changes
    if (SanitizeString($var) == $var) {
        return "";
    } else {
        return "Invalid Characters";
    }
}

function SanitizeString($var) {
    //Returns a sanitized string
    
    $tmp = $var;
    //Trim off leading and trailing blanks
    $tmp = trim($tmp);
    //Remove slashes
    $tmp = stripslashes($tmp);
    //Remove special html characters
    $tmp = htmlspecialchars($tmp);
    //Remove non-printable characters
    $tmp = filter_var($tmp, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    return $tmp;
}

function GetFromPOST($var) {
    //Returns a value from the POST Superglobal
    //Note: some HTML elements are empty (such as radio button) if nothing is selected,
    //This will result in an error when looking it up in the POST array
    //Use empty to see if the value exists
    if(!empty($_POST[$var])) { 
        $tmp = $_POST[$var]; 
    } else {
        $tmp = "";
    }
    return $tmp;
}

function GetFromGET($var) {
    //Returns a value from the GET Superglobal
    //Note: some HTML elements are empty (such as radio button) if nothing is selected,
    //This will result in an error when looking it up in the GET array
    //Use empty to see if the value exists
    if(!empty($_GET[$var])) { 
        $tmp = $_GET[$var]; 
    } else {
        $tmp = "";
    }
    return $tmp;
}
?>