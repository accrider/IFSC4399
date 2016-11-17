<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
  <meta charset="UTF-8">
    <meta name="description" content="Bookmark Manager">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="author" content="Adam Crider">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="assets/style/bookmarks.css">
</head>

<body>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="formcontainer">
      <h1>1-800-Bookmarks - Login</h1>
      <span class="formlabel">Username: </span>
      <span class="forminput"><input type="text" name="txtUsername" value=""></span>
      <span class="formerror"><?php echo $GLOBALS['usernameErr'] ?></span>
      <br>
      <br>
      <span class="formlabel">Password: </span>
      <span class="forminput"><input type="password" name="txtPassword"></span>
      <span class="formerror"><?php echo $GLOBALS['passwordErr'] ?></span>
      <br>
      <br>
      <p>
        <span class="error"></span>
      </p>
      <p>
        <input type="submit" name="btnLogin" value="Login">
        <input type="submit" name="btnReset" value="Reset My Password">
        <input type="submit" name="btnCancel" value="Cancel"> </p>
    </div>
  </form>
</body>

</html>