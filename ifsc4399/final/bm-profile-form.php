<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Contacts Pages">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="author" content="Bruce Bauer">
    <title>Contact List</title>
    <link rel="stylesheet" type="text/css" href="assets/style/contacts.css">
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="formcontainer">
        <h1>1-800-Bookmarks - My Profile</h1>
        <span class="formlabel">First Name: </span>
        <span class="forminput"><input type="text" name="txtfirstname" value="<?php echo $GLOBALS['firstname'] ?>"></span>
        <span class="formerror"><?php echo $GLOBALS['firstnameErr'] ?></span><br><br>
        <span class="formlabel">Last Name: </span>
        <span class="forminput"><input type="text" name="txtlastname" value="<?php echo $GLOBALS['lastname'] ?>"></span>
        <span class="formerror"><?php echo $GLOBALS['lastnameErr'] ?></span><br><br>
        <span class="formlabel">Username (Email): </span>
        <span class="forminput"><input type="text" name="txtusername" value="<?php echo $GLOBALS['username'] ?>"></span>
        <span class="formerror"><?php echo $GLOBALS['usernameErr'] ?></span><br><br>
        <span class="formlabel">Password: </span>
        <span class="forminput"><input type="password" name="txtpassword"></span>
        <span class="formerror"><?php echo $GLOBALS['passwordErr'] ?></span><br><br>
        <span class="formlabel">Confirm Password: </span>
        <span class="forminput"><input type="password" name="txtconfirmpassword"></span>
        <span class="formerror"><?php echo $GLOBALS['confirmPasswordErr']?></span><br><br>
        <p>
        <span class="error"><?php echo $GLOBALS['errorMessage'] ?></span>
        </p>
        <p>
        <?php echo $GLOBALS['buttons'] ?>
        </p>
    </div>
</form>
</body>
</html>