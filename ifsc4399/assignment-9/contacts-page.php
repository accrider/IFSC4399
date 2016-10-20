<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
require "contacts-database-library.php";

$_SESSION["username"] = "Bauer";
$logger->trace("Beginning List Contacts...");

// reset the Globals
$GLOBALS['lastname'] = "";
$GLOBALS['lastnameErr'] = "";
$GLOBALS['contacttable'] = "";

//Singlel Quote
$sq = "'";

// Is this a postback
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //  Get Last Name value and error message
    $GLOBALS['lastname'] = GetFromPOST("txtlastname");
    $GLOBALS['lastnameErr'] = isSantizeString($GLOBALS['lastname']);

    // If no errors, determine which button was clicked
    if ($GLOBALS['lastnameErr'] == "") {
        
        // Search Button
        if (GetFromPost("btnSearch") == "Search") {
            $_SESSION['offset'] = 0;
            $sql = SelectContactList();
            $result = RunSQL($sql);
            FormatContactList($result);
        }

        // Next Botton
        if (GetFromPost("btnNext") == "Next") {
            // Add the pagesize to the offset to get to the next page
            $_SESSION['offset'] = $_SESSION['offset'] + $_SESSION['pagesize'];
            $sql = SelectContactList();
            $result = RunSQL($sql);
            FormatContactList($result);
            // If no records were returned, then back up a page
            if ($GLOBALS['contacttable'] == "0 records found") {
                $_SESSION['offset'] = $_SESSION['offset'] - $_SESSION['pagesize'];
                $sql = SelectContactList();
                $result = RunSQL($sql);
                FormatContactList($result);
            }
        }
        
        // Add Button - redirect to Edit page with no parameters
        if (GetFromPost("btnAdd") == "Add"){
            header("Location: contacts-edit.php");
        }

        // Previous Button
        if (GetFromPost("btnPrevious") == "Previous") {
            //Back up a page.  Don't go past first page
            $_SESSION['offset'] = $_SESSION['offset'] - $_SESSION['pagesize'];
            if ($_SESSION['offset'] < 0) { 
                $_SESSION['offset'] = 0; 
            }
            $sql = SelectContactList();
            $result = RunSQL($sql);
            FormatContactList($result);
        }

    } 
    
// Not a postback
} else {
    // Set the offset
    // See if the current offset was passed back, if not then start at beginning
    if (GetFromGet("offset") == "") {
        $_SESSION['offset'] = 0;
    } else {
        $_SESSION['offset'] = GetFromGet("offset");
    }
    
    // Set the pagesize to 15 (always)
    $_SESSION['pagesize'] = 15;
    
    // Display the page
    $sql = SelectContactList();
    $result = RunSQL($sql);
    FormatContactList($result);
}

function FormatContactList($result) {    

    $sq = "'";
    $dq = '"';

    // Using the result of the SQL, loop through the rows and bulid the table
    $recordcount = mysqli_num_rows($result);

    if ($recordcount > 0) {
        
        // Table Headers
        $GLOBALS['contacttable'] = "<table>";
        $GLOBALS['contacttable'] .= "<tr>";
        $GLOBALS['contacttable'] .= "<th>Edit</th>";
        $GLOBALS['contacttable'] .= "<th>PKID</th>";
        $GLOBALS['contacttable'] .= "<th>FirstName</th>";
        $GLOBALS['contacttable'] .= "<th>LastName</th>";
        $GLOBALS['contacttable'] .= "<th>CompanyName</th>";
        $GLOBALS['contacttable'] .= "<th>Address</th>";
        $GLOBALS['contacttable'] .= "<th>City</th>";
        $GLOBALS['contacttable'] .= "<th>State</th>";
        $GLOBALS['contacttable'] .= "<th>Zip</th>";
        $GLOBALS['contacttable'] .= "<th>HireDate</th>";
        $GLOBALS['contacttable'] .= "<th>BirthDate</th>";
        $GLOBALS['contacttable'] .= "<th>Salary</th>";
        $GLOBALS['contacttable'] .= "</tr>";

        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $GLOBALS['contacttable'] .= "<tr><td>";
            // Notice a link is built with the PKID to pass to contacts-edit.php
            $GLOBALS['contacttable'] .= "<a href=" . $dq . "contacts-edit.php?PKID=" . $row["PKID"] . $dq . ">Edit</a></td><td>";
            $GLOBALS['contacttable'] .= $row["PKID"]           . "</td><td>";
            $GLOBALS['contacttable'] .= $row["FirstName"]      . "</td><td>";
            $GLOBALS['contacttable'] .= $row["LastName"]       . "</td><td>";
            $GLOBALS['contacttable'] .= $row["CompanyName"]    . "</td><td>";
            $GLOBALS['contacttable'] .= $row["Address"]        . "</td><td>";
            $GLOBALS['contacttable'] .= $row["City"]           . "</td><td>";
            $GLOBALS['contacttable'] .= $row["State"]          . "</td><td>";
            $GLOBALS['contacttable'] .= $row["Zip"]            . "</td><td>";
            $GLOBALS['contacttable'] .= ConvertISOtoShortDate($row["HireDate"])       . "</td><td>";
            $GLOBALS['contacttable'] .= ConvertISOtoShortDate($row["BirthDate"])      . "</td><td>";
            $GLOBALS['contacttable'] .= $row["Salary"]         . "</td>";
        }

        // Finish table
        $GLOBALS['contacttable'] .= "</table>";

    } else {

        $GLOBALS['contacttable'] = "0 records found";
    }
}

function SelectContactList ()  {
    $sq = "'";
    
    // If a last name is present, then use a "LIKE" clause
    if ($GLOBALS['lastname'] == "") {
        $sql = "SELECT * FROM Contacts ORDER by LastName, FirstName LIMIT " . $_SESSION['pagesize'] . " OFFSET " . $_SESSION['offset'];
    } else {
        $sql = "SELECT * FROM Contacts WHERE LastName LIKE " . $sq . $GLOBALS['lastname'] . "%" . $sq . " ORDER BY Lastname, FirstName" . " LIMIT " . $_SESSION['pagesize'] . " OFFSET " . $_SESSION['offset'];
    }
    return $sql;
}


require "contacts-page-form.php"; 
?>