<?php 
require "log4php-library.php";

// Set a usersname for the logger
$_SESSION["username"] = "Adam";

//Example of some logging
$logger->trace("This is an trace message...");
$logger->debug("This is a debug message...");
$logger->info("This is a informational message...");
$logger->warn("This is a warning message...");
$logger->error("This is an error message...");
$logger->fatal("This is a fatal message...");

//Test to call the Custom Error Handler
$filename = "welcome.txt";
$logger->trace("Opening file: " . $filename);
// This statment will cause an warning and call the Custom Error Handler
$file=fopen("welcome.txt","r");

// The trigger_error statement can also be used to capture an error
// Note that using E_USER_ERROR will be fatal and will halt execution
trigger_error('Can not connect to database', E_RECOVERABLE_ERROR); 

// Trigger an uncaught exception...this will be fatal and will halt execution
//throw new Exception("Uncaught Exceptions are always fatal...");

//This is never executed due to above fatal error
$heading = "Log4php Test";
require "log4php-test-form.php";
?>