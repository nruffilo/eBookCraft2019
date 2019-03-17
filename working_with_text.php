<?php
/** Working with text/strings and manipulating them is likely the most bang-for-your-buck.
PHP Offers a few ways to do this ranging from the simple to the complex.
*/

$starting_string =<<<EOSTRING
This is a string.
<a href='https://zenoftechnology.com'>Zen of Technology</a>
<p>This is a paragraph</p>
EOSTRING;


//basic find/replace
$new_string = str_replace($find, $replace, $starting_string);

/**
$find and $replace can be strings such as "<p>" and "<a>" or they can be arrays
which lets you do multiple find/replaces at once
*/

$new_string = str_replace(array("<a>","</a>","<p>","</p>"), array("<A>","</A>","<P>","</P>",$starting_string);
echo $new_string;

//There is also str_ireplace which is case insensitive

/**
If you like Regular Expressions there is preg_match and preg_replace
http://php.net/manual/en/function.preg-match.php
http://php.net/manual/en/function.preg-replace.php

**/

?>