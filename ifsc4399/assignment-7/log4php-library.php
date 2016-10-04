<?php
// Place this file (log4php_library.php) in your assignment folder
// You must require this library as the first line of your php page.
// It cannot appear after any HTML.

// Start the session - primarily to save a session name
session_start();

//Set a custom error handler
set_error_handler("customErrorHandler");

//Set Last Chance Exception Handler
set_exception_handler("customExceptionHandler");

// The Timezone must be set for log4php
// You can set the timezone in php.ini:
//      see http://php.net/date.timezone
//      [Date]
//      ; Defines the default timezone used by the date functions
//      date.timezone = America/Chicago
//
//  -or-
//
//  Set the timezone programatically
date_default_timezone_set("America/Chicago");

// Include the log4php php files
// log4php folder is in the your assignment folder
include("log4php/Logger.php");

// log4php directory is in root of your website
// include($_SERVER['DOCUMENT_ROOT'] . '/log4php/Logger.php');

// Use the configuration file for log4php - located your assignment
Logger::configure("log4php-config.xml");

// Create the $logger logging object
$logger = Logger::getLogger("main");

//Custom Exception Handler - Calls customErrorHandler
function customExceptionHandler($Exception) {
    customErrorHandler(E_USER_ERROR, $Exception->getmessage(), $Exception->getfile(), $Exception->getline(), null);    
}    
// Customer Error Handler
function customErrorHandler($error_level, $error_message, $error_file, $error_line, $error_context) {

    // Use the logger that was create in the main routine
    global $logger;
    
    //Display the error on the screen - comment out for productional system
    echo "<b>Error:</b> [$error_level] $error_message. $error_file, $error_line <br>";
    
    //Put together the error message for the logging file
    $error_log_message = $error_message . " in " . $error_file . " line: " . $error_line;
    
    //Match $error_level to the log4php error levels
    switch($error_level)
    {
            //These errors are considered non-fatal and the program can continue
            case(E_NOTICE):
            case(E_RECOVERABLE_ERROR):
                $logger->trace($error_log_message);
                break;
            
            //These errors are warnings and the program can continue
            case(E_WARNING):
            case(E_USER_WARNING):
            case(E_USER_NOTICE):
            case(E_ALL):
                $logger->warn($error_log_message);
                break;
            
            //These errors are fatal the the program will stop
            case(E_USER_ERROR):
                $logger->fatal($error_log_message);
                echo "<br><br><strong>Abnormal Termination - Please call the Helpdesk</strong>";
                die();
                break;
    }
}
?>