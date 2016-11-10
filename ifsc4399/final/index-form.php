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
      <h1>1-800-Bookmarks</h1>
      <p>Welcome to 1-800-Bookmarks, your cross browser storage for bookmarks.</p>
    </div>
    <input type="submit" name="btnLogin" value="Login">
    <input type="submit" name="btnSignup" value="Signup">
  </form>
</body>

</html>