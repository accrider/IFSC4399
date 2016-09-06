<?php
function printBreak() {
    echo "<br /><br /><br />";
}
function printSample($input) {
    echo "Sample string: {$input}<br />";
}
echo "<br /><br />1. Split the following string:<br />";
$string_1 = "082387";
printSample($string_1);
echo "Result: ";
//Chunk_split adds values at the end, need substring to get rid of last colon
echo substr(chunk_split($string_1, 2, ":"),0,8); 
printBreak();

echo "2. Check if a string contains the phrase \"jumps\":";
$string_2 = "The quick brown fox jumps over the lazy dog.";
echo "<br />";
printSample($string_2);
if (strpos($string_2, "jumps") > -1) {
    echo "The specific word is present.";
} else {
    echo "The specific word is not present.";
}
echo "<br />";
$string_2 = "The quick brown fox hops over the lazy dog.";
printSample($string_2);
if (strpos($string_2, "jumps") > -1) {
    echo "The specific word is present.";
} else {
    echo "The specific word is not present.";
}
printBreak();

echo "3. Extract the file name from the following string: <br />";
$string_3 = "www.example.com/public_html/index.php";
printSample($string_3);
echo "Result: " . substr(strrchr($string_3, "/"),1);
printBreak();

echo "4. Extract the user name from the following email ID: <br />";
$string_4 = "rayy@example.com";
printSample($string_4);
echo "Result: " . strstr($string_4, "@", true);
printBreak();

echo "5. Get the last three characters of a string:<br />";
$string_5 = $string_4;
printSample($string_5);
echo "Result: " . substr($string_5, -3);
printBreak();

echo "6. Replace the first \"the\" of the following string with \"That\": <br />";
$string_6 = "the quick brown fox jumps over the lazy dog.";
printSample($string_6);
$rep = "the"; // Set the replacement as a variable so it's easy to change later
echo "Result: " . substr_replace($string_6, "That", strpos($rep), strpos($rep) + strlen($rep));
printBreak();

echo "7. Remove a part of a string from the beginning: <br />";
$string_7 = $string_4;
printSample($string_7);
?>