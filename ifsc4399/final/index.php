<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
require "bm-database-library.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (GetFromPost("btnLogin") == "Login") {
        header("Location: bm-login.php");
    }
    if (GetFromPost("btnSignup") == "Signup") {
        header("Location: bm-signup.php");
    }
}
require "index-form.php";
?>