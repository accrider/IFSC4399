<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Data Type Validation">
    <meta name="keywords" content="HTML, CSS, PHP, Validation">
    <meta name="author" content="Bruce Bauer">
    <link rel="stylesheet" type="text/css" href="./assets/style/site.css" />
    <title>Data Type Validation</title>

</head>

<body>
    <h2>PHP Calculator</h2>
    <p><span class="danger">* required field.</span></p>
    <form action="." method="POST">
        <div class="form-group">
            <span>Operand 1: </span>
            <input type="text" name="op1" value="<?php if (isset($op1)) echo $op1 ?>" />
            <span class="danger">* <?php echo $strOp1Error ?></span>
        </div>
        <div class="form-group">
            <span>Operator:</span>
            <ul class="form-list">
                <?php
                    $operators = array("+","-","*","/");
                    foreach ($operators as $oper) {
                        echo '<li><input type="radio" name="operator" value="'. $oper .'" ';
                        if (isset($operator) && $oper == $operator) {
                            echo "checked";
                        }
                        echo " >{$oper}</li>";
                    }
                ?>
            </ul>
            <span class="danger">* <?php echo $strOpError ?></span>
        </div>
        <div class="form-group">
            <span>Operand 2:</span>
            <input type="text" name="op2" value="<?php if (isset($op2)) echo $op2 ?>">
            <span class="danger">* <?php echo $strOp2Error ?></span>
        </div>
        <div class="form-gorup">
            <p>Result: <?php echo $result ?></p>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</body>

</html>