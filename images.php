<?php
/**
There are a few ways you can work with images.  There are built-in function within PHP or you can use
a command line tool like imagemagick.

*/


$image_size = getimagesize("./confidence.gif");
var_dump($image_size);

?>