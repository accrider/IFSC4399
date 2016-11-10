<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
require "bm-database-library.php";

$GLOBAL['username'] = "";
$GLOBAL['password'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (GetFromPost("btnLogin") == "Login") {
        GetLoginFromPost();

    }
}
function GetLoginFromPost();
require "bm-login-form.php";
?>