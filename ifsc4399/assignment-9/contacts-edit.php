<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
require "contacts-database-library.php";

$_SESSION["username"] = "Bauer";
$logger->trace("Beginning Edit Contacts...");

// Initialize all of the GLOBALS variables
$GLOBALS['PKID'] = "";
$GLOBALS['PKIDErr'] = "";
$GLOBALS['firstname'] = "";
$GLOBALS['firstnameErr'] = "";
$GLOBALS['lastname'] = "";
$GLOBALS['lastnameErr'] = "";
$GLOBALS['companyname'] = "";
$GLOBALS['companynameErr'] = "";
$GLOBALS['address'] = "";
$GLOBALS['addressErr'] = "";
$GLOBALS['city'] = "";
$GLOBALS['cityErr'] = "";
$GLOBALS['state'] = "";
$GLOBALS['stateErr'] = "";
$GLOBALS['zip'] = "";
$GLOBALS['zipErr'] = "";
$GLOBALS['phone1'] = "";
$GLOBALS['phone1Err'] = "";
$GLOBALS['phone2'] = "";
$GLOBALS['phone2Err'] = "";
$GLOBALS['web'] = "";
$GLOBALS['webErr'] = "";
$GLOBALS['email'] = "";
$GLOBALS['emailErr'] = "";
$GLOBALS['birthdate'] = "";
$GLOBALS['birthdateErr'] = "";
$GLOBALS['hiredate'] = "";
$GLOBALS['hiredateErr'] = "";
$GLOBALS['salary'] = "";
$GLOBALS['salaryErr'] = "";
$GLOBALS['errormessage'] = "";
$GLOBALS['buttons'] = "";
// Single Quote
$sq = "'";


// Is this a Postback
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Was the Update button pressed
    if (GetFromPost("btnUpdate") == "Update") {

        // Get the contact information from POST
        GetContactFromPost();
        
        // Validate all of the fields
        ValidateContact();        
                
        // If at least one field is invalid, the error message field has a message
        // Do not update if there is an error
        if ($errormessage == "") {
            
            // Build the Update SQL
            $sql = "UPDATE Contacts Set " .
            "FirstName=" . $sq . $GLOBALS['firstname'] . $sq . ", " .
            "LastName=" . $sq . $GLOBALS['lastname'] . $sq . ", " .
            "CompanyName=" . $sq . $GLOBALS['companyname'] . $sq . ", " .
            "Address=" . $sq . $GLOBALS['address'] . $sq . ", " .
            "City=" . $sq . $GLOBALS['city'] . $sq . ", " .
            "State=" . $sq . $GLOBALS['state'] . $sq . ", " .
            "Zip=" . $sq . $GLOBALS['zip'] . $sq . ", " .
            "Phone1=" . $sq . $GLOBALS['phone1'] . $sq . ", " .
            "Phone2=" . $sq . $GLOBALS['phone2'] . $sq . ", " .
            "Email=" . $sq . $GLOBALS['email'] . $sq . ", " .
            "Web=" . $sq . $GLOBALS['web'] . $sq . ", " .    
            "Hiredate=" . $sq . ConvertShorttoISODate($GLOBALS['hiredate']) . $sq . ", " .
            "Birthdate=" . $sq . ConvertShorttoISODate($GLOBALS['birthdate']) . $sq . ", " .
            "Salary=" . $GLOBALS['salary'] . " WHERE " .
            "PKID=" . $GLOBALS['PKID'];            

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
        ValidateContact();        
                
        // If at least one field is invalid, the error message field has a message
        // Do not add if there is an error
        if ($errormessage == "") {

            // Build the Insert SQL
            $sql = "INSERT INTO Contacts (FirstName, LastName, CompanyName, Address, City, State, Zip, Phone1, Phone2, Email, Web, Hiredate, Birthdate, Salary) VALUES (" .
                $sq . $GLOBALS['firstname'] . $sq . ", " .
                $sq . $GLOBALS['lastname'] . $sq . ", " . 
                $sq . $GLOBALS['companyname'] . $sq . ", " .
                $sq . $GLOBALS['address'] . $sq . ", " .
                $sq . $GLOBALS['city'] . $sq . ", " .
                $sq . $GLOBALS['state'] . $sq . ", " .
                $sq . $GLOBALS['zip'] . $sq . ", " .
                $sq . $GLOBALS['phone1'] . $sq . ", " .
                $sq . $GLOBALS['phone2'] . $sq . ", " .
                $sq . $GLOBALS['email'] . $sq . ", " .
                $sq . $GLOBALS['web'] . $sq . ", " .
                $sq . ConvertShorttoISODate($GLOBALS['hiredate']) . $sq . ", " .
                $sq . ConvertShorttoISODate($GLOBALS['birthdate']) . $sq . ", " .
                $salary . ")";

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
        ValidateContact();        
                
        // If at least one field is invalid, the error message field has a message
        // Do not delete if there is an error
        if ($errormessage == "") {
            
            // Build the Update SQL
            $sql = "DELETE FROM Contacts  WHERE PKID=" . $GLOBALS['PKID'];            

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
        header("Location: contacts-page.php?offset=" . $_SESSION["offset"]);
    }

    // Was the Cancel button pressed
    if (GetFromPost("btnCancel") == "Cancel") {
        // Pass the current offset as a parameter to stay on the same page
        header("Location: contacts-page.php?offset=" . $_SESSION["offset"]);
    }
    
} else {
    
    // Not a Postback    
    $PKID = GetFromGet("PKID");

    //No PKID - must be adding a contact
    if ($PKID == "") {
        displaybuttons(array("Add", "Cancel"));
    
    } else {
    //PKID Present - Get Contact from Table
        GetContactFromTable();
        displaybuttons(array("Update", "Delete", "Cancel"));
    }
}

function GetContactFromTable() {

    // Get row out of contacts table and put into global variables
    $sql = "SELECT * FROM Contacts where pkid=" . $GLOBALS['PKID'];
    $result = RunSQL($sql);
    $row = mysqli_fetch_assoc($result);

    $GLOBALS['PKID'] = $row["PKID"];
    $GLOBALS['firstname'] = $row["FirstName"];
    $GLOBALS['lastname'] = $row["LastName"];
    $GLOBALS['companyname'] = $row["CompanyName"];
    $GLOBALS['address'] = $row["Address"];
    $GLOBALS['city'] = $row["City"];
    $GLOBALS['state'] = $row["State"];
    $GLOBALS['zip'] = $row["Zip"];
    $GLOBALS['phone1'] = $row["Phone1"];
    $GLOBALS['phone2'] = $row["Phone2"];
    $GLOBALS['web'] = $row["Web"];
    $GLOBALS['email'] = $row["Email"];
    $GLOBALS['birthdate'] = ConvertISOtoShortDate($row["BirthDate"]);
    $GLOBALS['hiredate'] = ConvertISOtoShortDate($row["HireDate"]);
    $GLOBALS['salary'] = $row["Salary"];
    
}

function GetContactFromPost() {

    // Get data out of POST superglobal
    $GLOBALS['PKID'] = GetFromPost("txtPKID");
    $GLOBALS['firstname'] = GetFromPost("txtFirstName");
    $GLOBALS['lastname'] = GetFromPost("txtLastName");
    $GLOBALS['companyname'] = GetFromPost("txtCompanyName");
    $GLOBALS['address'] = GetFromPost("txtAddress");
    $GLOBALS['city'] = GetFromPost("txtCity");
    $GLOBALS['state'] = GetFromPost("txtState");
    $GLOBALS['zip'] = GetFromPost("txtZip");
    $GLOBALS['phone1'] = GetFromPost("txtPhone1");
    $GLOBALS['phone2'] = GetFromPost("txtPhone2");
    $GLOBALS['web'] = GetFromPost("txtWeb");
    $GLOBALS['email'] = GetFromPost("txtEmail");
    $GLOBALS['birthdate'] = GetFromPost("txtBirthDate");
    $GLOBALS['hiredate'] = GetFromPost("txtHireDate");
    $GLOBALS['salary'] = GetFromPost("txtSalary");    
}

function ValidateContact() {
   
    // Validate all of the fields and set the appropriate error messages
    $GLOBALS['firstnameErr'] = isRequiredString($GLOBALS['firstname']);
    $GLOBALS['lastnameErr'] = isRequiredString($GLOBALS['lastname']);
    $GLOBALS['companynameErr'] = isRequiredString($GLOBALS['companyname']);
    $GLOBALS['addressErr'] = isRequiredString($GLOBALS['address']);
    $GLOBALS['cityErr'] = isRequiredString($GLOBALS['city']);
    $GLOBALS['stateErr'] = isRequiredString($GLOBALS['state']);
    $GLOBALS['zipErr'] = isRequiredString($GLOBALS['zip']);
    if ($GLOBALS['zipErr'] == "") {
        if (!preg_match ('/^[0-9]{5}$/', $GLOBALS['zip'])) {
            $GLOBALS['zipErr'] = "Invalid Zip Code";
        }
    }
    $GLOBALS['phone1Err'] = isRequiredString($GLOBALS['phone1']);
    if ($GLOBALS['phone1Err'] == "") {
        if (!preg_match ('/\d{3}-\d{3}-\d{4}/', $GLOBALS['phone1'])) {
            $GLOBALS['phone1Err'] = "Invalid Phone Number 999-999-9999";
        }
    }
    $GLOBALS['phone2Err'] = isSantizeString($GLOBALS['phone2']);
    if ($GLOBALS['phone2Err'] == "" && $GLOBALS['phone2'] != "") {
        if (!preg_match ('/\d{3}-\d{3}-\d{4}/', $GLOBALS['phone2'])) {
            $GLOBALS['phone2Err'] = "Invalid Phone Number 999-999-9999";
        }
    }
    $GLOBALS['webErr'] = isValidURL($GLOBALS['web']);
    $GLOBALS['emailErr'] = isValidEmail($GLOBALS['email']);
    $GLOBALS['birthdateErr'] = isValidShortDate($GLOBALS['birthdate']);
    $GLOBALS['hiredateErr'] = isValidShortDate($GLOBALS['hiredate']);
    $GLOBALS['salaryErr'] = isValidInt($GLOBALS['salary']);
    
    // if any errors are present, then set the error message
    if ($GLOBALS['PKIDErr'] == "" && 
        $GLOBALS['firstnameErr'] == "" && 
        $GLOBALS['lastnameErr'] == "" && 
        $GLOBALS['companynameErr'] == "" && 
        $GLOBALS['addressErr'] == "" && 
        $GLOBALS['cityErr'] == "" && 
        $GLOBALS['stateErr'] == "" && 
        $GLOBALS['zipErr'] == "" && 
        $GLOBALS['phone1Err'] == "" && 
        $GLOBALS['phone2Err'] == "" && 
        $GLOBALS['webErr'] == "" && 
        $GLOBALS['emailErr'] == "" && 
        $GLOBALS['birthdateErr'] == "" && 
        $GLOBALS['hiredateErr'] == "" && 
        $GLOBALS['salaryErr'] == "") {
        
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

require "contacts-edit-form.php"; 
?>