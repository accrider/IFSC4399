<?php
require "log4php-library.php"; 
require "datatype-validation-library.php";
$_SESSION["username"] = "Adam";
$logger->trace("Beginning Dice Roll Freqency assignment.");
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Dice Roll Frequency">
    <meta name="keywords" content="HTML, CSS, PHP, Validation">
    <meta name="author" content="Adam Crider">
    <link rel="stylesheet" type="text/css" href="./assets/style/site.css" />
    <title>Dice Roll Frequency</title>

</head>

<?php 
$start = microtime(true);
$rolls = array();
$rolls = array_pad($rolls, 13, 0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cases = GetFromPOST("test-cases");
    $strError = isValidInt($cases);
    if ($strError != "") {
        $logger->debug("Entered value: " . $strError);
        $strError = "Number of rolls must be between 1 and 10000000";
    } else {
        if ($cases >= 1 && $cases <= 10000000) {
            for ($i = 0; $i < $cases; $i++) {
                $rolls[rand(1,6) + rand(1,6)]++;
            }
        } else {
            $strError = "Number of rolls must be between 1 and 10000000";
        }
    }

}
?>

<body>
    <div class="header">
        <h1>Dice Roll Freqency</div>
    </div>
        <div class="row">
            <form action="." method="post" class="form-group">
                <div class="form-item">
                    <input type="text" name="test-cases" class="text-box">
                    <span class="danger"> * <?php if (isset($strError)) echo $strError ?></span>
                </div>
                <div class="form-item">
                    <input type="submit" class="btn btn-submit">
                </div>
            </div>
        </div>
        <div class="row">
            <table border="1">
                <tr>
                    <th>Roll</th>
                    <th>Freqency</th>
                </tr>
                <?php
                   for ($i = 2; $i <= 12; $i++) {
                       echo "<tr><td>{$i}</td><td>" . $rolls[$i] . "</td></tr>";
                   } 

                ?>
            </table>
         </div>
         <div class="row">
            <p>Dice Rolls = <?php echo count($rolls) ?></p>
            <p>Execution Time = <?php echo (microtime(true) - $start) ?> seconds</p>
         </div>

</body>

</html>