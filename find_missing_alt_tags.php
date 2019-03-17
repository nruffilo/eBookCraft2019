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
$details = unzipAndLoadEpub("zot.epub","./zot");

$opf = $details['opf'];

echo "Found " . count($opf->manifest->item) . " items\n";
foreach ($opf->manifest->item as $item) {
	//check to see if the media type is application/xhtml+xml so we know to look for links
	//echo "Checking " . $item['href'] . " with media type:  " . $item['media-type'] . "\n";
	if ((String)$item['media-type']	== "application/xhtml+xml") {
		//we have an HTML file, lets check it for images and then make sure they have alt tags.
		$html = new DOMDocument();
		$html->load("./zot/".$item['href']);
		$images = $html->getElementsByTagName("img");
		if ($images->length == 0) {
			echo "{$item['href']}	had no images...\n";
		}
		foreach ($images as $image) {
			$alt_text = "";
			if (!$image->hasAttribute('alt')) {
				$alt_text = "NO ALT";
			} else {
				$alt_text = $image->getAttribute('alt');
			}
			
			echo "{$item['href']} - " . $image->getAttribute('src') . " ALT: {$alt_text}\n";
		}
	}
}


?>