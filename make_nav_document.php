<?php
//assume the epub is unzipped...

function meXMLPrettyOneDay($xml_string) {
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml_string);
		$pretty_xml = $dom->saveXML();
		
		if(($pretty_xml == '') || ($pretty_xml == '<?xml version="1.0"?>'."\n")) return $xml_string;
		else return $pretty_xml;
}

//load the TOC
$toc = simplexml_load_file("./sytycc/OEBPS/toc.ncx");
//load the OPF
$opf_text = file_get_contents("./sytycc/OEBPS/content.opf");

//for some odd reason v 1.1 of XML fails to load, so load the file as a string then replace 1.1 with 1.0 for easy load
$opf_string = str_ireplace('version="1.1"','version="1.0"',file_get_contents("$directory/".$container->rootfiles->rootfile['full-path']));
$opf = simplexml_load_string($opf_string);

//create a new NAV document
$nav_document = new SimpleXMLElement("<nav></nav>");
$main_ol = $nav_document->addChild("ol");
foreach ($toc->navMap->navPoint as $point) {
	$li = $main_ol->addChild("li");
	$a = $li->addChild("a",$point->navLabel->text);
	$a['href'] = $point->content['src'];
	if (count($point->navPoint) > 0) {
		$ol = $li->addChild("ol");
		foreach ($point->navPoint as $sub_point) {
			$li2 = $ol->addChild("li");
			$a2 = $li2->addChild("a");
			$a2["href"] = $sub_point->content['src'];
			$a2[0] = $sub_point->navLabel->text;
			//echo "SUB - " . $sub_point->content['src'] . "\n";
			//echo "SUB - " . $sub_point->navLabel->text . "\n";	
		}
	}
}

echo meXMLPrettyOneDay($nav_document->saveXML());

?>
