<?php
/**
Variables are a way to have a placeholder.  They are like variables in math - they stand for 
some value.  In PHP, variables start with $ - because they are cash money if you learn them.

Example:

$name = "Nick Ruffilo";

The variable "$name" now has the value of "Nick Ruffilo"
I can use this later:

echo $name; // this will print out "Nick Ruffilo" 

or I can perform actions on it - such as joining it to another string:

$names = $name . " The Coding Guru";

echo $names; //this will output "Nick Ruffilo The Coding Guru";
*/

//Types of variables - PHP IS LOOSE, so it's wibbly wobbly, but lets put that aside...

$counter = 0; //this is an integer/float value - a number...
$name = "Nick"; //this is a string - a set of numbers/letters - text...
$array = array("red","blue","green"); //this is an array - a collection of anything.  In this case, strings, but it can be numbers
$array[0]; //the value is red.  the [] is the way you access items in an array.  Items start at 0...

$associative_array = array("color"=>"red","height"=>16,"width"=>20); //this is an associative array.  You get to set the keys and values.
$associative_array['color']; //the value is "red"

$boolean = true; // a boolean - true or false

/**
What's with ' and "?  Well, both mean that: whatever is inside is a string value.  The double quotes will let you use a variable inside, the single will not...

Example:

echo 'My name is $name'; // returns: My name is $name
echo "My name is $name"; // returns: My name is Nick

DON'T WORRY - JUST USE WHICHEVER YOU WANT AND UNLESS IT DOESN'T WORK, DON'T WORRY :)
*/

//The next most important thing is an IF / ELSE statement...

$some_condition = true;
if ($some_condition) {
		
} else {
	
}

//You can also have if, else if...

$i = 10;

if ($i == 1) {
	echo "Do something 1";	
} else if ($i == 2) {
	echo "Do something 2";		
} else if ($i == 3) {
	echo "Do something 3";	
} else {
	echo "Do something 10";		
}

//another way to write this is using something called a SWITCH statement:

switch ($i) {
	case 1:
		echo "do something 1";
		break;
	case 2: 
		echo "Do something 2";
		break;
	case 3: 
		echo "Do something 3";
		break;
	default:
		echo "Do something - default - $i";
		break;
}

//We often want to do things more than once.  You may find the need to do something twice.  Many times, we
//want to do things over and over again.  For that, we have loops...  There are a few different types
//of loops, but the ones I use most are FOR and FOR EACH

//for loops let you iterate for a certain amount of times (they can do more, but lets keep it simple)

for ($i=0; $i<=10; $i++) {
	echo "This has run $i times\n";
}

//foreach is great for arrays, it runs through each element in the array
foreach ($array as $item) {
	echo "\$array had item: $item\n";
}

foreach ($associative_array as $key=>$value) {
	echo "\$associative_array had a key/value pair: $key / $value\n";	
}

//The next major concept is Functions.  Functions allow you to call a set of code with a single name.
//Like Las Vegas, what happens in a function, stays in a function, unless you choose to return it

function unzipAndLoadEpub($filename, $directory) {
	exec("unzip '{$filename}' -d $directory");
	
  $container = simplexml_load_file("$directory/META-INF/container.xml");

  //clean out the OPF: prefix from the .opf file to reduce compatibility issues.
  $opf_text = file_get_contents("$directory/".$container->rootfiles->rootfile['full-path']);

  $opf_file = (String)$container->rootfiles->rootfile['full-path'];
  //for some odd reason v 1.1 of XML fails to load, so load the file as a string then replace 1.1 with 1.0 for easy load
  $opf_string = str_ireplace('version="1.1"','version="1.0"',file_get_contents("$directory/".$container->rootfiles->rootfile['full-path']));
  $opf = simplexml_load_string($opf_string);
  //$opf = simplexml_load_file("{$root_url}/books/{$book_id}/assets/reflow/".$container->rootfiles->rootfile['full-path']);
  return array("container"=>$container, "opf"=>$opf,"opf_file"=>$opf_file);
}

$epub_info = unzipAndLoadEpub("zot.epub","./zot");
var_dump($epub_info['container']);
var_dump($epub_info['opf']);
var_dump($epub_info['opf_file']);



?>