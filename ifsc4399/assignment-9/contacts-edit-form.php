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
    <h1>Contact</h1>
    <fieldset id="detail">
    <legend>Contacts:</legend>
      
    <div id="leftdetail">
    <span class="formlabel">PKID:</span>
    <input type="text" name="txtPKID" readonly value="<?php echo $GLOBALS['PKID'];?>">
    <span class="error"><?php echo $GLOBALS['PKIDErr'];?></span><br />
    
    <span class="formlabel">First Name: </span>
    <input type="text" name="txtFirstName" maxlength="25" size="25" value="<?php echo $GLOBALS['firstname'];?>">
    <span class="error"><?php echo $GLOBALS['firstnameErr'];?></span><br />
    
    <span class="formlabel">Last Name: </span>
    <input type="text" name="txtLastName" maxlength="25" size="25" value="<?php echo $GLOBALS['lastname'];?>">
    <span class="error"><?php echo $GLOBALS['lastnameErr'];?></span><br />

    <span class="formlabel">Company Name: </span>
    <input type="text" name="txtCompanyName" maxlength="35" size="35" value="<?php echo $GLOBALS['companyname'];?>">
    <span class="error"><?php echo $GLOBALS['companynameErr'];?></span><br />

    <span class="formlabel">Address: </span>
    <input type="text" name="txtAddress" maxlength="50" size="50" value="<?php echo $GLOBALS['address'];?>">
    <span class="error"><?php echo $GLOBALS['addressErr'];?></span><br />

    <span class="formlabel">City:</span>
    <input type="text" name="txtCity" maxlength="25" size="25" value="<?php echo $GLOBALS['city'];?>">
    <span class="error"><?php echo $GLOBALS['cityErr'];?></span><br />

    <span class="formlabel">State: </span>
    <select name="txtState">
        <option value="AL" <?php echo stateselect("AL");?>>Alabama</option>
        <option value="AK" <?php echo stateselect("AK");?>>Alaska</option>
        <option value="AZ" <?php echo stateselect("AZ");?>>Arizona</option>
        <option value="AR" <?php echo stateselect("AR");?>>Arkansas</option>
        <option value="CA" <?php echo stateselect("CA");?>>California</option>
        <option value="CO" <?php echo stateselect("CO");?>>Colorado</option>
        <option value="CT" <?php echo stateselect("CT");?>>Connecticut</option>
        <option value="DE" <?php echo stateselect("DE");?>>Delaware</option>
        <option value="DC" <?php echo stateselect("DC");?>>District Of Columbia</option>
        <option value="FL" <?php echo stateselect("FL");?>>Florida</option>
        <option value="GA" <?php echo stateselect("GA");?>>Georgia</option>
        <option value="HI" <?php echo stateselect("HI");?>>Hawaii</option>
        <option value="ID" <?php echo stateselect("ID");?>>Idaho</option>
        <option value="IL" <?php echo stateselect("IL");?>>Illinois</option>
        <option value="IN" <?php echo stateselect("IN");?>>Indiana</option>
        <option value="IA" <?php echo stateselect("IA");?>>Iowa</option>
        <option value="KS" <?php echo stateselect("KS");?>>Kansas</option>
        <option value="KY" <?php echo stateselect("KY");?>>Kentucky</option>
        <option value="LA" <?php echo stateselect("LA");?>>Louisiana</option>
        <option value="ME" <?php echo stateselect("ME");?>>Maine</option>
        <option value="MD" <?php echo stateselect("MD");?>>Maryland</option>
        <option value="MA" <?php echo stateselect("MA");?>>Massachusetts</option>
        <option value="MI" <?php echo stateselect("MI");?>>Michigan</option>
        <option value="MN" <?php echo stateselect("MN");?>>Minnesota</option>
        <option value="MS" <?php echo stateselect("MS");?>>Mississippi</option>
        <option value="MO" <?php echo stateselect("MO");?>>Missouri</option>
        <option value="MT" <?php echo stateselect("MT");?>>Montana</option>
        <option value="NE" <?php echo stateselect("NE");?>>Nebraska</option>
        <option value="NV" <?php echo stateselect("NV");?>>Nevada</option>
        <option value="NH" <?php echo stateselect("NH");?>>New Hampshire</option>
        <option value="NJ" <?php echo stateselect("NJ");?>>New Jersey</option>
        <option value="NM" <?php echo stateselect("NM");?>>New Mexico</option>
        <option value="NY" <?php echo stateselect("NY");?>>New York</option>
        <option value="NC" <?php echo stateselect("NC");?>>North Carolina</option>
        <option value="ND" <?php echo stateselect("ND");?>>North Dakota</option>
        <option value="OH" <?php echo stateselect("OH");?>>Ohio</option>
        <option value="OK" <?php echo stateselect("OK");?>>Oklahoma</option>
        <option value="OR" <?php echo stateselect("OR");?>>Oregon</option>
        <option value="PA" <?php echo stateselect("PA");?>>Pennsylvania</option>
        <option value="RI" <?php echo stateselect("RI");?>>Rhode Island</option>
        <option value="SC" <?php echo stateselect("SC");?>>South Carolina</option>
        <option value="SD" <?php echo stateselect("SD");?>>South Dakota</option>
        <option value="TN" <?php echo stateselect("TN");?>>Tennessee</option>
        <option value="TX" <?php echo stateselect("TX");?>>Texas</option>
        <option value="UT" <?php echo stateselect("UT");?>>Utah</option>
        <option value="VT" <?php echo stateselect("VT");?>>Vermont</option>
        <option value="VA" <?php echo stateselect("VA");?>>Virginia</option>
        <option value="WA" <?php echo stateselect("WA");?>>Washington</option>
        <option value="WV" <?php echo stateselect("WV");?>>West Virginia</option>
        <option value="WI" <?php echo stateselect("WI");?>>Wisconsin</option>
        <option value="WY" <?php echo stateselect("WY");?>>Wyoming</option>
    </select>	        
    <span class="error"><?php echo $GLOBALS['stateErr'];?></span><br />
        
    <span class="formlabel">Zip:</span>
    <input type="text" name="txtZip" maxlength="5" size="5" value="<?php echo $GLOBALS['zip'];?>">
    <span class="error"><?php echo $GLOBALS['zipErr'];?></span><br />

    </div>
    <div id="rightdetail">

    <span class="formlabel">Phone1: </span>
    <input type="text" name="txtPhone1" maxlength="12" size="12" value="<?php echo $GLOBALS['phone1'];?>">
    <span class="error"><?php echo $GLOBALS['phone1Err'];?></span><br />

    <span class="formlabel">Phone2: </span>
    <input type="text" name="txtPhone2" maxlength="12" size="12" value="<?php echo $GLOBALS['phone2'];?>">
    <span class="error"><?php echo $GLOBALS['phone2Err'];?></span><br />

    <span class="formlabel">Web: </span>
    <input type="text" name="txtWeb" maxlength="50" size="50" value="<?php echo $GLOBALS['web'];?>">
    <span class="error"><?php echo $GLOBALS['webErr'];?></span><br />

    <span class="formlabel">Email: </span>
    <input type="text" name="txtEmail" maxlength="50" size="50" value="<?php echo $GLOBALS['email'];?>">
    <span class="error"><?php echo $GLOBALS['emailErr'];?></span><br />

    <span class="formlabel">BirthDate: </span>
    <input type="text" name="txtBirthDate" maxlength="10" size="10" value="<?php echo $GLOBALS['birthdate'];?>">
    <span class="error"><?php echo $GLOBALS['birthdateErr'];?></span><br />

    <span class="formlabel">HireDate: </span>
    <input type="text" name="txtHireDate" maxlength="10" size="10" value="<?php echo $GLOBALS['hiredate'];?>">
    <span class="error"><?php echo $GLOBALS['hiredateErr'];?></span><br />

    <span class="formlabel">  Salary: </span>
    <input type="text" name="txtSalary" maxlength="7" size="7" value="<?php echo $GLOBALS['salary'];?>">
    <span class="error"><?php echo $GLOBALS['salaryErr'];?></span>
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