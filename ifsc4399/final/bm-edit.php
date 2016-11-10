<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
require "bm-database-library.php";

$_SESSION["username"] = "Adam";
$logger->trace("Beginning Edit Contacts...");

// Initialize all of the GLOBALS variables
$GLOBALS['PKID'] = "";

$GLOBALS['title'] = "";
$GLOBALS['titleErr'] = "";
$GLOBALS['URL'] = "";
$GLOBALS['URLErr'] = "";
$GLOBALS['tags'] = "";
$GLOBALS['tagsErr'] = "";
$GLOBALS['comments'] = "";
$GLOBALS['commentsErr'] = "";
$GLOBALS['errormessage'] = "";
$GLOBALS['buttons'] = "";
// Single Quote
$sq = "'";

$GLOBALS['PKID'] = GetFromGet("pkid");
// Is this a Postback
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Was the Update button pressed
    if (GetFromPost("btnUpdate") == "Update") {

        // Get the contact information from POST
        GetContactFromPost();
        
        // Validate all of the fields
        ValidateBookmark();        
                
        // If at least one field is invalid, the error message field has a message
        // Do not update if there is an error
        if ($errormessage == "") {
            
            // Build the Update SQL
            $sql = "UPDATE tblBookmarks Set " .
            "Title=" . $sq . $GLOBALS['title'] . $sq . ", " .
            "URL=" . $sq . $GLOBALS['URL'] . $sq . ", " .
            "Tags=" . $sq . $GLOBALS['tags'] . $sq . ", " .
            "Comments=" . $sq . $GLOBALS['comments'] . $sq 
            . " WHERE PKID=" . $GLOBALS['PKID'];            
            //print($sql);
            // Run the Update SQL
            $result = RunSQL($sql);

            // Check the result
            if ($result) {
                $errormessage = "Record Updated";
            } else {
                $errormessage = "Error - Record not Updated";
            }
            // Continue back to page display
            displaybuttons(array("Continue"));
        } else {
            
            // A field has an error - correct or cancel
            displaybuttons(array("Update", "Cancel"));
        }
    }
    
    // Was the Add Button pressed
    if (GetFromPost("btnInsert") == "Add") {
        // Get the contact information from POST
        GetContactFromPost();
        
        // Validate all of the fields
        ValidateBookmark();        
                
        // If at least one field is invalid, the error message field has a message
        // Do not add if there is an error
        if ($errormessage == "") {

            // Build the Insert SQL
            $sql = "INSERT INTO tblBookmarks (userPKID, Title, URL, Tags, Comments) VALUES (" .
                $sq . $_SESSION['userPKID'] . $sq . ", " .
                $sq . $GLOBALS['title'] . $sq . ", " .
                $sq . $GLOBALS['URL'] . $sq . ", " . 
                $sq . $GLOBALS['tags'] . $sq . ", " . 
                $sq . $GLOBALS['comments'] . $sq . ")";

            // Run the SQL
            $result = RunSQL($sql);

            // Check the result
            if ($result) {
                $errormessage = "Record Added";
            } else {
                $errormessage = "Error - Record not Added";
            }
            // Continue back to page display
            displaybuttons(array("Continue"));
        } else {
            // A field has an error - correct or cancel
            displaybuttons(array("Add", "Cancel"));
        }
    }

    // Was the Delete button pressed
    if (GetFromPost("btnDelete") == "Delete") {

        // Get the contact information from POST
        GetContactFromPost();
        
        // Validate all of the fields
        ValidateBookmark();        
                
        // If at least one field is invalid, the error message field has a message
        // Do not delete if there is an error
        if ($errormessage == "") {
            
            // Build the Update SQL
            $sql = "DELETE FROM tblBookmarks  WHERE PKID=" . $GLOBALS['PKID'];            

            // Run the Update SQL
            $result = RunSQL($sql);

            // Check the result
            if ($result) {
                $errormessage = "Record Deleted";
            } else {
                $errormessage = "Error - Record not Deleted";
            }
            // Continue back to page display
            displaybuttons(array("Continue"));
        } else {
            
            // A field has an error - correct or cancel
            displaybuttons(array("Delete", "Cancel"));
        }
    }

    // Was the Continue button pressed
    if (GetFromPost("btnContinue") == "Continue") {
        // Pass the current offset as a parameter to stay on the same page
        // Used after successfule Add, Delete, or Update
        header("Location: bm-page.php?offset=" . $_SESSION["offset"]);
    }

    // Was the Cancel button pressed
    if (GetFromPost("btnCancel") == "Cancel") {
        // Pass the current offset as a parameter to stay on the same page
        header("Location: bm-page.php?offset=" . $_SESSION["offset"]);
    }
    
} else {
    
    // Not a Postback    
    $GLOBALS['PKID'] = GetFromGet("pkid");

    //No PKID - must be adding a contact
    if ($PKID == "") {
        displaybuttons(array("Add", "Cancel"));
    
    } else {
    //PKID Present - Get Contact from Table
        GetBookmarkFromTable();
        displaybuttons(array("Update", "Delete", "Cancel"));
    }
}

function GetBookmarkFromTable() {

    // Get row out of contacts table and put into global variables
    $sql = "SELECT * FROM tblBookmarks where pkid=" . $GLOBALS['PKID'];
    $result = RunSQL($sql);
    $row = mysqli_fetch_assoc($result);

    $GLOBALS['PKID'] = $row["PKID"];
    $GLOBALS['title'] = $row["Title"];
    $GLOBALS['URL'] = $row["URL"];
    $GLOBALS['tags'] = $row["Tags"];
    $GLOBALS['comments'] = $row["Comments"];
    
}

function GetContactFromPost() {

    // Get data out of POST superglobal
    $GLOBALS['title'] = GetFromPost("txtTitle");
    $GLOBALS['URL'] = GetFromPost("txtURL");
    $GLOBALS['tags'] = GetFromPost("txtTags");
    $GLOBALS['comments'] = GetFromPost("txtComments");   
}

function ValidateBookmark() {
   
    // Validate all of the fields and set the appropriate error messages
    $GLOBALS['titleErr'] = isRequiredString($GLOBALS['title']);
    $GLOBALS['URLErr'] = isValidURL($GLOBALS['URL']);
    $GLOBALS['tagsErr'] = isSantizeString($GLOBALS['tags']);
    $GLOBALS['commentsErr'] = isSantizeString($GLOBALS['comments']);
    
    // if any errors are present, then set the error message
    if ($GLOBALS['titleErr'] == "" && 
        $GLOBALS['URLErr'] == "" && 
        $GLOBALS['tagsErr'] == "" && 
        $GLOBALS['commentsErr'] == "") {
        
        $GLOBALS['errormessage'] = "";
    } else {
        $GLOBALS['errormessage'] = "Record has invalid fields";
    }
}

// Outputs "selected based on the state.  Used to set the default in a dropdown box
function stateselect($tmpstate) {
    if ($tmpstate == $GLOBALS['state']) {
        return "selected";
    } else {
    return "";
    }
}

// Dynamicall builds the buttons based on what is present in the array
function displaybuttons($buttonarray) {

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

require "bm-edit-form.php"; 
?>