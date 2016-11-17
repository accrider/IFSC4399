<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Bookmark Manager">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="author" content="Adam Crider">
    <title>Bookmark Edit</title>
    <link rel="stylesheet" type="text/css" href="assets/style/bookmarks.css">
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?pkid=<?php echo $GLOBALS['PKID'] ?>">
    <div class="formcontainer">
    <h1>1-800-Bookmarks - Edit</h1>
    <fieldset id="detail">
    <legend>Bookmarks:</legend>
      
    <div id="leftdetail">
    
    <span class="formlabel">Title: </span>
    <input type="text" name="txtTitle" maxlength="25" size="25" value="<?php echo $GLOBALS['title'];?>">
    <span class="error"><?php echo $GLOBALS['titleErr'];?></span><br />
    
    <span class="formlabel">URL: </span>
    <input type="text" name="txtURL" maxlength="25" size="25" value="<?php echo $GLOBALS['URL'];?>">
    <span class="error"><?php echo $GLOBALS['URLErr'];?></span><br />

    <span class="formlabel">Tags: </span>
    <input type="text" name="txtTags" maxlength="35" size="35" value="<?php echo $GLOBALS['tags'];?>">
    <span class="error"><?php echo $GLOBALS['tagsErr'];?></span><br />

    <span class="formlabel">Comments: </span>
    <input type="text" name="txtComments" maxlength="50" size="50" value="<?php echo $GLOBALS['comments'];?>">
    <span class="error"><?php echo $GLOBALS['commentsErr'];?></span><br />
        
    </div>
<p>
    <span class="error"><?php echo $GLOBALS['errormessage'];?></span>
</p>
<p>
    <?php echo $GLOBALS['buttons'];?>
</p>
</fieldset>
</div>
</form>
</body>
</html>