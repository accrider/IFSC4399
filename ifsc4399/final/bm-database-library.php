<?php

$_SESSION['userPKID'] = 1;
function runSQL($sql) {
    global $logger;
    
    // Database credentials
    $servername = "adamcrider.com";
    $username = "db1adm";
    $password = "U@LR2016";
    $dbname = "bm";
    $logger->trace("runSQL - SQL=" . $sql);
    // Create connection to database
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection to database
    if (!$conn) {
        mysqli_close($conn);
        $logger->fatal("runSQL Error: SQL Connection failed: " . mysqli_connect_error());
        die();
    }
    // Execute SQL
    $result = mysqli_query($conn, $sql);
    // Check for error
    if (mysqli_error($conn)) {
        $logger->fatal("runSQL Error: SQL Excecution failed: " . mysqli_error($conn));
    }
    
    // Connection is open then close it
    if ($conn) {
        mysqli_close($conn);
    }
    // Return dataset for select or Boolean for insert, update, delete
    return $result;
}
?>