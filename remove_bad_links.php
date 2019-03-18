<?php
$files = glob("./sytycc/OEBPS/*.xhtml");

foreach ($files as $file) {
	echo "Loading $file\n";
	$html = new DOMDocument();
	$html->load($file);
	
	//strip for all those odd "tag" attributes...
	$all_items = $html->getElementsByTagName("*");

	$updated = false;

	foreach ($all_items as $item) {
		if ($item->hasAttribute("tag")) {
			$item->removeAttribute("tag");
			$updated = true;
		}
	}

	$links = $html->getElementsByTagName("a");
	if ($links->length == 0) {
		continue;
	} else {
		foreach ($links as $link) {
			if ($link->hasAttribute("href")) {
				$url_to_check = explode("#",$link->getAttribute("href"));
				$filecheck = $url_to_check[0];
				if (!file_exists("./sytycc/OEBPS/" . $filecheck)) {
					echo "In $file the link to $filecheck did not exist -- replacing\n";
					$updated = true;

					$div = $html->createElement("div");
					$div->setAttribute("style","display:inline-block;");
					$div->setAttribute("class",$link->getAttribute("class"));
					$link->parentNode->replaceChild($div,$link);
										
				}
				//echo "In $file we have a link with source: " . basename($link->getAttribute("href")) . "\n";
			}
		}
		if ($updated) {
			file_put_contents($file,$html->saveXML());
			//echo $html->saveXML();
			//die();
		}


	}



}
?>
