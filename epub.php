<?php

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

function zipEpub($filename, $directory) {
	chdir($directory);
	exec("zip -0Xq $filename mimetype");
	exec("zip -Xr9Dq $filename ./* -x 'mimetype'");
}

zipEpub("zot2.epub","./zot");


?>