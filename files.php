<?php
/*
	Reading and writing to files is one of the most important things when it comes to automation
*/

/*
 The variable we will use later to reference the file
 |
 |	           - The name of the file
 |            |
 |            |           - how you want to open the file.
 v            v          v
*/
$fh = fopen("file.txt","w+");
/* 
for a full list of options see: http://php.net/manual/en/function.fopen.php
But, here's the important ones:
r = read only
r+ = read/write
w = write only
w+ = read/write, clear the file if it has something in it, attempt to create it if it doesn't exist.
*/


//WHAT TO DO WITH THE FILE ONCE IT'S OPEN

fread($fh, 1024); // read a single line of the file
fwrite($fh, "Content"); // write content to the file

//read the whole file:

while (!feof($fh)) {
	$line = fread($fh,1024);
	//OR:
	$line = fgetcsv($fh); // this reads in a CSV into an array of values
		
}


//WANT TO READ AN ENTIRE FILE:
$file_contents = file_get_contents("file.txt");

//WANT TO WRITE IT ALL OUT?
file_put_contents("newfile.txt",$file_contents);


fclose($fh); //Closes the file.  Not technically required, but you should do it to prevent issues with the file.
?>