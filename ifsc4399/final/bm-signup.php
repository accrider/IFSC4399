<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
require "bm-database-library.php";

$GLOBALS['firstname'] = "";
$GLOBALS['firstnameErr'] = "";
$GLOBALS['lastname'] = "";
$GLOBALS['lastnameErr'] = "";
$GLOBALS['username'] = "";
$GLOBALS['usernameErr'] = "";
$GLOBALS['password'] = "";
$GLOBALS['passwordErr'] = "";
$GLOBALS['confirmPassword'] = "";
$GLOBALS['confirmPasswordErr'] = "";
$GLOBALS['errorMessage'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (GetFromPost("btnSignup") == "Signup") {
        GetProfileFromPost();
        ValidateProfile();
        if ($GLOBALS['errorMessage'] == "") {
            $sql = "INSERT INTO tblUsers (Username, Password, LoginDate, Retry, FirstName, LastName) " . 
                "VALUES ('" . $GLOBALS['username'] . "', '" . sha1($GLOBALS['password']) . "', " . 
                "CURRENT_TIMESTAMP, 0, '" . $GLOBALS['firstname'] . "', '" . $GLOBALS['lastname'] . "')";
            $_SESSION['userPKID'] = insertSQL($sql); //Insert sql returns last_inserted_id
            header("Location: bm-page.php");
        }
    }
    if (GetFromPost("btnCancel") == "Cancel") {
        header("Location: index.php");
    }    
}

function ValidateProfile() {
    $GLOBALS['firstnameErr'] = isRequiredString($GLOBALS['firstname']);
    $GLOBALS['lastnameErr'] = isRequiredString($GLOBALS['lastname']);
    $GLOBALS['usernameErr'] = isValidEmail($GLOBALS['username']);
    //Check to see if email already exists, 
    //exclude current user from the search otherwise there's 
    //a conflict if the user doesn't update their email
    $sql = "SELECT * from tblUsers where Username = '" . $GLOBALS['username'] . "'";
    if (mysqli_num_rows(RunSQL($sql)) > 0) {
        $GLOBALS['usernameErr'] = "That username already exists";
    }
    $GLOBALS['passwordErr'] = isRequiredString($GLOBALS['password']);
    $GLOBALS['confirmPasswordErr'] = isRequiredString($GLOBALS['confirmPassword']);
    if ($GLOBALS['password'] != $GLOBALS['confirmPassword']) {
        $GLOBALS['confirmPasswordErr'] = "Passwords do not match";
    }

    if ($GLOBALS['firstnameErr'] == "" &&
        $GLOBALS['lastnameErr'] == "" &&
        $GLOBALS['usernameErr'] == "" &&
        $GLOBALS['passwordErr'] == "" &&
        $GLOBALS['confirmPasswordErr'] == "") {
        
        $GLOBALS['errorMessage'] = "";
    } else {
        $GLOBALS['errorMessage'] = "Record has invalid fields";
    } 
}
function GetProfileFromPost() {
    $GLOBALS['firstname'] = GetFromPost("txtfirstname");
    $GLOBALS['lastname'] = GetFromPost("txtlastname");
    $GLOBALS['username'] = GetFromPost("txtusername");
    $GLOBALS['password'] = GetFromPost("txtpassword");
    $GLOBALS['confirmPassword'] = GetFromPost("txtconfirmpassword");
}


require "bm-signup-form.php";
?>