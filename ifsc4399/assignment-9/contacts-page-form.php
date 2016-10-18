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
    <h1>Contacts</h1>
    <?php echo $GLOBALS['contacttable']; ?><br><br>
    <input type="submit" name="btnPrevious" value="Previous">
    <input type="submit" name="btnNext" value="Next">
    <input type="submit" name="btnAdd" value="Add"><br><br>
    <span class="formlabel">Search for Last Name: </span>
    <span class="forminput"><input type="text" name="txtlastname" value="<?php echo $GLOBALS['lastname'];?>"></span>
    <span class="formerror"> * <?php echo $GLOBALS['lastnameErr'];?></span><br><br>
    <input type="submit" name="btnSearch" value="Search"><br><br>
    </div>
</form>
</body>
</html>