<?php

include_once "config.inc.php";

$curdir=FILEPATH."/stocknews/";
$dir = scandir($curdir);

$content = "";
foreach ($dir as $file)
{
	if ($file == "." || $file=="..")
		continue;
		$content .= addslashes(file_get_contents($curdir.$file));
		$content .= "##";
}

echo $content;


?>