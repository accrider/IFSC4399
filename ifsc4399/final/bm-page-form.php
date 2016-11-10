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
        <?php echo $GLOBALS['bookmarkTable']; ?><br><br>
        <input type="submit" name="btnPrevious" value="Previous">
        <input type="submit" name="btnNext" value="Next">
        <input type="submit" name="btnAdd" value="Add"><br><br>
        <span class="formlabel">Search for tag: </span>
        <span class="forminput"><input type="text" name="txtsearch" value="<?php echo $GLOBALS['search'];?>"></span>    <input type="submit" name="btnSearch" value="Search">
        <span class="formerror"> * <?php echo $GLOBALS['searchErr'];?></span><br><br>
        <span class="formlabel"></span>
        <span class="forminput">
            <input type="radio" name="pubpriv" value="private" <?php if (GetFromPost("pubpriv") == "" || GetFromPost("pubpriv") == "private") echo "checked"  ?>>Your Bookmarks
        </span>
        <br />
        <span class="formlabel"></span>
        <span class="forminput">
            <input type="radio" name="pubpriv" value="public" <?php if (GetFromPost("pubpriv") == "public") echo "checked"  ?>>All Bookmarks
        </span>
        <br />
        <input type="submit" name="btnProfile" value="Edit My Profile">
        <input type="submit" name="btnLogoff" value="Logoff">
    </div>
</form>
</body>
</html>