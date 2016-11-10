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
      <h1>1-800-Bookmarks - Login</h1>
      <span class="formlabel">Username: </span>
      <span class="forminput"><input type="text" name="txtusername" value=""></span>
      <span class="formerror"></span>
      <br>
      <br>
      <span class="formlabel">Password: </span>
      <span class="forminput"><input type="password" name="txtpassword"></span>
      <span class="formerror"></span>
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