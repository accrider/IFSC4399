<?php


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

function insertSQL($sql) {
    global $logger;
    $logger->trace("insertSQL - SQL=" . $sql);
    // Create connection to database
    $servername = "adamcrider.com";
    $username = "db1adm";
    $password = "U@LR2016";
    $dbname = "bm";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection to database
    if (!$conn) {
        mysqli_close($conn);
        $logger->fatal("inesrtSQL Error: SQL Connection failed: " . mysqli_connect_error());
        die();
    }
    // Execute SQL
    $result = mysqli_query($conn, $sql);
    // Check for error
    if (mysqli_error($conn)) {
        $logger->fatal("insertSQL Error: SQL Excecution failed: " . mysqli_error($conn));
    }
    $last_id = mysqli_insert_id($conn);
    
    // Connection is open then close it
    if ($conn) {
        mysqli_close($conn);
    }
    // Return dataset for select or Boolean for insert, update, delete
    return $last_id;
}
?>