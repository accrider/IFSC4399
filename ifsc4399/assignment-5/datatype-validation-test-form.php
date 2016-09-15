<!DOCTYPE HTML>  
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta charset="UTF-8">
<meta name="description" content="Data Type Validation">
<meta name="keywords" content="HTML, CSS, PHP, Validation">
<meta name="author" content="Bruce Bauer">
<title>Data Type Validation</title>

<!-- Note: The following inline stylesheet should be put in an external file 
     in the CSS folder
-->
<style>
.formerror {
    color: #FF0000;
    display: inline-block; 
    text-align: left;
}

/* labels are right aligned */
.formlabel {
    display: inline-block; 
    width: 125px;
    text-align: right;
}

/* textboxes are left aligned */
.forminput {
    display: inline-block; 
    width: 190px;
    text-align: left;
    }

.formcontainer {
    width: 600px;
}
</style>
</head>

<body>  
<h2>Datatype Validation</h2>
    
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
<div class="formcontainer">
<fieldset>
    <legend>Enter Data for Validation</legend>

    <br>
    <span class="formlabel">Boolean: </span>
    <span class="forminput"><input type="text" name="strBoolean" value="<?php echo $strBoolean;?>"></span>
    <span class="formerror"> * <?php echo $strBooleanErr;?></span>
    <br><br>

    <span class="formlabel">Email: </span>
    <span class="forminput"><input type="text" name="strEmail" value="<?php echo $strEmail;?>"></span>
    <span class="formerror"> * <?php echo $strEmailErr;?></span>
    <br><br>

    <span class="formlabel">Floating Number: </span>
    <span class="forminput"><input type="text" name="strFloat" value="<?php echo $strFloat;?>"></span>
    <span class="formerror"> * <?php echo $strFloatErr;?></span>
    <br><br>

    <span class="formlabel">Integer: </span>
    <span class="forminput"><input type="text" name="strInt" value="<?php echo $strInt;?>"></span>
    <span class="formerror"> * <?php echo $strIntErr;?></span>
    <br><br>

    <span class="formlabel">IP Address: </span>
    <span class="forminput"><input type="text" name="strIP" value="<?php echo $strIP;?>"></span>
    <span class="formerror"> * <?php echo $strIPErr;?></span>
    <br><br>

    <span class="formlabel">URL: </span>
    <span class="forminput"><input type="text" name="strURL" value="<?php echo $strURL;?>"></span>
    <span class="formerror"> * <?php echo $strURLErr;?></span>
    <br><br>

    <span class="formlabel">Date: </span>
    <span class="forminput"><input type="text" name="strDate" value="<?php echo $strDate;?>"></span>
    <span class="formerror"> * <?php echo $strDateErr;?></span>
    <br><br>

    <span class="formlabel">HTML Date: </span>
    <span class="forminput"><input type="date" name="strHTMLDate" value="<?php echo $strHTMLDate;?>"></span>
    <span class="formerror"> * <?php echo $strHTMLDateErr;?></span>
    <br><br>
</fieldset>
<br><br>
<input type="submit" name="submit" value="Submit">
</div>
</form>
</body>
</html>