<?php

$post_url = "https://en.wikipedia.org/wiki/E-book";

$ch = curl_init();
$post_fields = array("var1"=>"value1","var2"=>"value2");
curl_setopt($ch, CURLOPT_URL, $post_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER,array("Content-type: text/xml"));
curl_setopt($ch, CURLOPT_POSTFIELDS,$post_fields);

$return = curl_exec($ch);
curl_close($ch);

echo $return;
?>