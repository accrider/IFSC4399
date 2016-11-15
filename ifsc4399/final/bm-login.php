<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
require "bm-database-library.php";

$GLOBALS['username'] = "";
$GLOBALS['usernameErr'] = "";
$GLOBALS['password'] = "";
$GLOBALS['passwordErr'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (GetFromPost("btnLogin") == "Login") {
        GetLoginFromPost(true);
        if ($GLOBALS['passwordErr'] != "" || $GLOBALS['usernameErr'] != "") {

        } else {
            $sql = "select pkid, password, Retry from tblUsers where username = '" . $GLOBALS['username'] . "'";
            //print($sql);
            $result = RunSQL($sql);
            if (mysqli_num_rows($result) == 1) {
                //success 
                $row = mysqli_fetch_assoc($result);
                if ($row['Retry'] <= 10) { //Within retry count
                    if ($row['password'] == sha1($GLOBALS['password'])) {
                        $_SESSION['userPKID'] = $row['pkid'];
                        header("Location: bm-page.php");
                    } else {
                        $GLOBALS['passwordErr'] = "Invalid password";
                        //increment retry count
                        $sql = "update tblUsers set Retry = Retry + 1 where username = '" . $GLOBALS['username'] . "'";
                        RunSQL($sql);
                    }
                } else {
                    $GLOBALS['usernameErr'] = "This account is currently locked.";
                }

            } else { // bad username
                $GLOBALS['usernameErr'] = "That username does not exist.";
            }
        }
    }
    if (GetFromPost("btnReset") == "Reset My Password") {
        GetLoginFromPost(false);
        if ($GLOBALS['usernameErr'] == "") {
            $to      = 'accrider@ualr.edu';
            $subject = 'the subject';
            $message = 'hello';
            $headers = 'From: noreply@adamcrider.com' . "\r\n" .
                'Reply-To: noreply@adamcrider.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
        } // else no username
    }
}
function GetLoginFromPost($isPasswordReqruired) {
    $GLOBALS['username'] = GetFromPost("txtUsername");
    $GLBOALS['usernameErr'] = isRequiredString($GLOBALS['username']);
    $GLOBALS['password'] = GetFromPost("txtPassword");
    if ($isPasswordReqruired) {
        $GLOBALS['passwordErr'] = isRequiredString($GLOBALS['password']);
        //if (len($GLOBALS['password']) < 
    }
}
require "bm-login-form.php";
?>