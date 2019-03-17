<?php
/*
PHP has some wonderful built-in functions for working with XML and HTML.

NOTE: Both functions will and can alter the structure of your document.  It will
standardize tags, and potentially remove non-conformant elements or attributes,
so TEST WELL after using these functions...
*/

//Function for making HTML/XML content display with nice formatting.
public static function meXMLPrettyOneDay($xml_string) {
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml_string);
		$pretty_xml = $dom->saveXML();
		
		if(($pretty_xml == '') || ($pretty_xml == '<?xml version="1.0"?>'."\n")) return $xml_string;
		else return $pretty_xml;
}

//Simple XML - http://php.net/manual/en/book.simplexml.php
$xmlstring = file_get_contents("sample.xml");
$xml = simplexml_load_string($xmlstring);

//DOM Document - https://www.w3schools.com/php/php_xml_dom.asp
//Tutorial: https://www.binarytides.com/php-tutorial-parsing-html-with-domdocument/


?>