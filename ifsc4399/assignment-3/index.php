<?php
echo "1. Split the following string:<br />";
$input = "082387";
echo "Sample string: {$input}<br />";
echo "Result: ";
echo chunk_split($input, 2, ":");
echo "<br /><br />";

echo "2. Check if a string contains the phrase \"jumps\":";
$string_1 = "The quick brown fox jumps over the lazy dog.";
echo "Sample string: " . $string_1;
/*
The specific word is present.
Sample string: The quick brown fox hops over the lazy dog.
The specific word is not present.
"*/
?>