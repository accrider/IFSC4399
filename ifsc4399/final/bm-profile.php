<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
require "bm-database-library.php";
if (!isset($_SESSION['userPKID'])) {
    header("Location: index.php");
}
// reset the Globals
$GLOBALS['search'] = "";
$GLOBALS['searchErr'] = "";
$GLOBALS['bookmarkTable'] = "";

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
$GLOBALS['buttons'] = "";



//Singlel Quote
$sq = "'";

// Is this a postback
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (GetFromPost("btnUpdate") == "Update") {
        GetProfileFromPost();
        ValidateProfile();

        if ($GLOBALS['errorMessage'] == "") {
            if (strlen($GLOBALS['password']) > 0) {
                //Update password
                $sql = "update tblUsers set " .
                    " Firstname = " . $sq . $GLOBALS['firstname'] . $sq . ", " .
                    " Lastname = " . $sq . $GLOBALS['lastname'] . $sq . ", " .
                    " Username = " . $sq . $GLOBALS['username'] . $sq . ", " . 
                    " Password = " . $sq . sha1($GLOBALS['password']) . $sq .
                    " WHERE PKID = " . $_SESSION['userPKID'];
                    $result = RunSQL($sql); 
            } else { // Just update profile
                $sql = "update tblUsers set " .
                    " Firstname = " . $sq . $GLOBALS['firstname'] . $sq . ", " .
                    " Lastname = " . $sq . $GLOBALS['lastname'] . $sq . ", " .
                    " Username = " . $sq . $GLOBALS['username'] . $sq . 
                    " WHERE PKID = " . $_SESSION['userPKID'];
                    $result = RunSQL($sql);                   
            }
        }
    }
    if (GetFromPost("btnContinue") == "Continue") {
        header("Location: bm-page.php");
    }
    if (GetFromPost("btnCancel") == "Cancel") {
        header("Location: bm-page.php");
    }
    DisplayButtons(array("Continue"));
    
// Not a postback
} else {
    DisplayButtons(array("Update", "Cancel"));
    GetUserInformation();
}

function GetProfileFromPost() {
    $GLOBALS['firstname'] = GetFromPost("txtfirstname");
    $GLOBALS['lastname'] = GetFromPost("txtlastname");
    $GLOBALS['username'] = GetFromPost("txtusername");
    $GLOBALS['password'] = GetFromPost("txtpassword");
    $GLOBALS['confirmPassword'] = GetFromPost("txtconfirmpassword");
}

function ValidateProfile() {
    $GLOBALS['firstnameErr'] = isRequiredString($GLOBALS['firstname']);
    $GLOBALS['lastnameErr'] = isRequiredString($GLOBALS['lastname']);
    $GLOBALS['usernameErr'] = isValidEmail($GLOBALS['username']);
    //Check to see if email already exists, 
    //exclude current user from the search otherwise there's 
    //a conflict if the user doesn't update their email
    $sql = "SELECT * from tblUsers where Username = '" . $GLOBALS['username'] . "' and pkid != " . $_SESSION['userPKID'];
    //echo $sql;
    if (mysqli_num_rows(RunSQL($sql)) > 0) {
        $GLOBALS['usernameErr'] = "That username already exists";
    }
    if (strlen($GLOBALS['password']) > 0) {
        $GLOBALS['passwordErr'] = isRequiredString($GLOBALS['password']);
        $GLOBALS['confirmPasswordErr'] = isRequiredString($GLOBALS['confirmPassword']);
        if ($GLOBALS['password'] != $GLOBALS['confirmPassword']) {
            $GLOBALS['confirmPasswordErr'] = "Passwords do not match";
        }
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

function GetUserInformation() {
    $sql = "select * from tblUsers where pkid = " . $_SESSION['userPKID'];
    $result = RunSQL($sql);
    $row = mysqli_fetch_assoc($result);

    $GLOBALS['firstname'] = $row['Firstname'];
    $GLOBALS['lastname'] = $row['Lastname'];
    $GLOBALS['username'] = $row['Username'];
}


function DisplayButtons($buttonarray) {

    // double quote
    $dq = '"';
    
    for ($i = 0; $i < count($buttonarray); $i++) {
        switch ($buttonarray[$i]) {
            case "Update":
                $GLOBALS['buttons'] .= "<input type=" . $dq . "submit" . $dq . " name=" . $dq . "btnUpdate" . $dq . " value=" . $dq . "Update" . $dq . "> ";
                break;
            case "Add":
                $GLOBALS['buttons'] .= "<input type=" . $dq . "submit" . $dq . " name=" . $dq . "btnInsert" . $dq . " value=" . $dq . "Add" . $dq . "> ";
                break;
            case "Delete":
                $GLOBALS['buttons'] .= "<input type=" . $dq . "submit" . $dq . " name=" . $dq . "btnDelete" . $dq . " value=" . $dq . "Delete" . $dq . "> ";
                break;
            case "Cancel":
                $GLOBALS['buttons'] .= "<input type=" . $dq . "submit" . $dq . " name=" . $dq . "btnCancel" . $dq . " value=" . $dq . "Cancel" . $dq . "> ";
                break;
            case "Continue":
                $GLOBALS['buttons'] .= "<input type=" . $dq . "submit" . $dq . " name=" . $dq . "btnContinue" . $dq . " value=" . $dq . "Continue" . $dq . "> ";
                break;
        }
    }
}

require "bm-profile-form.php";
?>