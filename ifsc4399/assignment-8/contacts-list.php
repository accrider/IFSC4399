<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
$_SESSION["username"] = "Bauer";
$logger->trace("Beginning List Contacts...");

//Credentials for database
$servername = "adamcrider.com";
$username = "db1adm";
$password = "U@LR2016";
$dbname = "db1";
    
$sql = "SELECT * FROM Contacts ORDER BY Lastname, FirstName";
$logger->trace("List Contacts - SQL=" . $sql);

// Create connection to database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    mysqli_close($conn);
    $logger->fatal("Error: SQL Connection failed: " . mysqli_connect_error());
    die();
}

// Run the SQL statement
$result = mysqli_query($conn, $sql);

// Check for error
if (mysqli_error($conn)) {
    $logger->fatal("Error: SQL Excecution failed: " . mysqli_error($conn));
    mysqli_close($conn);
    die();
}

// Make sure you got a record back
$recordcount = mysqli_num_rows($result);

if ($recordcount > 0) {
    
    // Format the table headers
    $contacttable = "<table>";
    $contacttable .= "<tr>";
    $contacttable .= "<th>PKID</th>";
    $contacttable .= "<th>FirstName</th>";
    $contacttable .= "<th>LastName</th>";
    $contacttable .= "<th>CompanyName</th>";
    $contacttable .= "<th>Address</th>";
    $contacttable .= "<th>City</th>";
    $contacttable .= "<th>State</th>";
    $contacttable .= "<th>Zip</th>";
    $contacttable .= "<th>HireDate</th>";
    $contacttable .= "<th>BirthDate</th>";
    $contacttable .= "<th>Salary</th>";
    $contacttable .= "</tr>";

    // Loop through each row of data and format a table row
    while($row = mysqli_fetch_assoc($result)) {
        $contacttable .= "<tr><td>";
        $contacttable .= $row["PKID"]           . "</td><td>";
        $contacttable .= $row["FirstName"]      . "</td><td>";
        $contacttable .= $row["LastName"]       . "</td><td>";
        $contacttable .= $row["CompanyName"]    . "</td><td>";
        $contacttable .= $row["Address"]        . "</td><td>";
        $contacttable .= $row["City"]           . "</td><td>";
        $contacttable .= $row["State"]          . "</td><td>";
        $contacttable .= $row["Zip"]            . "</td><td>";
        $contacttable .= $row["HireDate"]       . "</td><td>";
        $contacttable .= $row["BirthDate"]      . "</td><td>";
        $contacttable .= $row["Salary"]         . "</td></tr>";
    }

    // Finish the table
    $contacttable .= "</table>";

} else {

    $contacttable = "0 records found";
}

// Close the database connection

mysqli_close($conn);
require "contacts-list-form.php"; 
?>