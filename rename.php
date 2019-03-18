<?php
$files = glob("*.htm.html");
foreach ($files as $file) {
	exec("cp $file " . str_replace(".htm.html",".xhtml",$file));
	//echo $file;
}

?>
