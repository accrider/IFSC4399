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

//Singlel Quote
$sq = "'";

// Is this a postback
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (GetFromPost("btnProfile") == "Edit My Profile") {
            header("Location: bm-profile.php");
    }
    if (GetFromPost("btnLogoff") == "Logoff") {
        session_destroy();
        header("Location: index.php");
    }
    //  Get Last Name value and error message
    $GLOBALS['search'] = GetFromPOST("txtsearch");
    $GLOBALS['searchErr'] = isSantizeString($GLOBALS['search']);

    // If no errors, determine which button was clicked
    if ($GLOBALS['searchErr'] == "") {
        
        // Search Button
        if (GetFromPost("btnSearch") == "Search") {
            $_SESSION['offset'] = 0;
            $sql = SelectBookmarkList();
            $result = RunSQL($sql);
            FormatBookmarkList($result);
        }

        // Next Botton
        if (GetFromPost("btnNext") == "Next") {
            // Add the pagesize to the offset to get to the next page
            $_SESSION['offset'] = $_SESSION['offset'] + $_SESSION['pagesize'];
            $sql = SelectBookmarkList();
            $result = RunSQL($sql);
            FormatBookmarkList($result);
            // If no records were returned, then back up a page
            if ($GLOBALS['bookmarkTable'] == "0 records found") {
                $_SESSION['offset'] = $_SESSION['offset'] - $_SESSION['pagesize'];
                $sql = SelectBookmarkList();
                $result = RunSQL($sql);
                FormatBookmarkList($result);
            }
        }
        
        // Add Button - redirect to Edit page with no parameters
        if (GetFromPost("btnAdd") == "Add"){
            header("Location: bm-edit.php");
        }

        // Previous Button
        if (GetFromPost("btnPrevious") == "Previous") {
            //Back up a page.  Don't go past first page
            $_SESSION['offset'] = $_SESSION['offset'] - $_SESSION['pagesize'];
            if ($_SESSION['offset'] < 0) { 
                $_SESSION['offset'] = 0; 
            }
            $sql = SelectBookmarkList();
            $result = RunSQL($sql);
            FormatBookmarkList($result);
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
    $sql = SelectBookmarkList();
    $result = RunSQL($sql);
    FormatbookMarkList($result);
}

function FormatBookmarkList($result) {    

    $sq = "'";
    $dq = '"';

    // Using the result of the SQL, loop through the rows and bulid the table
    $recordcount = mysqli_num_rows($result);

    if ($recordcount > 0) {
        
        // Table Headers
        $GLOBALS['bookmarkTable'] = "<table>";
        $GLOBALS['bookmarkTable'] .= "<tr>";
        $GLOBALS['bookmarkTable'] .= "<th>Edit</th>";
        $GLOBALS['bookmarkTable'] .= "<th>Title</th>";
        $GLOBALS['bookmarkTable'] .= "<th>URL</th>";
        $GLOBALS['bookmarkTable'] .= "<th>Tags</th>";
        $GLOBALS['bookmarkTable'] .= "</tr>";

        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $GLOBALS['bookmarkTable'] .= "<tr><td>";
            // Notice a link is built with the PKID to pass to contacts-edit.php
            $GLOBALS['bookmarkTable'] .= ($row["userPKID"] == $_SESSION["userPKID"] ? "<a href='bm-edit.php?pkid=" . $row["PKID"] . "'>Edit</a>" : "")          . "</td><td>";
            $GLOBALS['bookmarkTable'] .= $row["Title"]      . "</td><td>";
            $GLOBALS['bookmarkTable'] .= $row["URL"]       . "</td><td>";
            $GLOBALS['bookmarkTable'] .= $row["Tags"]         . "</td>";
        }

        // Finish table
        $GLOBALS['bookmarkTable'] .= "</table>";

    } else {

        $GLOBALS['bookmarkTable'] = "0 records found";
    }
}

function SelectBookMarkList ()  {
    $sq = "'";
    
    // If a last name is present, then use a "LIKE" clause
    if ($GLOBALS['search'] == "") {
        $sql = "select * from tblBookmarks LIMIT " . $_SESSION['pagesize'] . " OFFSET " . $_SESSION['offset'];
    } else {
        if (GetFromPost("pubpriv") == "private") {
            $sql = "SELECT * FROM tblBookmarks WHERE tags LIKE " . $sq . $GLOBALS['search'] . "%" . $sq . " and userPKID = " . $_SESSION['userPKID'] ." LIMIT " . $_SESSION['pagesize'] . " OFFSET " . $_SESSION['offset'];
        } else {
            $sql = "SELECT * FROM tblBookmarks WHERE tags LIKE " . $sq . $GLOBALS['search'] . "%" . $sq . " LIMIT " . $_SESSION['pagesize'] . " OFFSET " . $_SESSION['offset'];
        }
    }
    return $sql;
}


require "bm-page-form.php";
?>