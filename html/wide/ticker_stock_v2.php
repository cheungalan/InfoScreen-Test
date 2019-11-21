<?php

define("FILEPATH","/var/www/wsja/html/resource");

function calc(){

//   include_once "config.inc.php";
/*
   $curdir=FILEPATH."/stocknews/";
   $dir = scandir($curdir);

   $content = "";
   foreach ($dir as $file)
   {
			$content .= addslashes(file_get_contents($curdir.$file));
			$content .= "##";
	}
*/
	$content = file_get_contents('http://localhost/resource/api/stock.php?ver=2');
	return $content;
}

  include_once("../resource/agent.php");
  $agent->init(); 
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DJ News Scrolling</title>
<style>
<!--
BODY{
CURSOR: url(../wide/blank.cur);
}
-->
</style>
</head>
<body bgcolor="#FFFFFF">

<div id='F'>&nbsp;</div>
<script language="JavaScript1.2" src="js/scroller_left_v2.js"></script>
<script>
var started = false;
  function runcalc() {
    agent.call('','calc','callback');
	Timer();
  }
  
  function callback(str) {
str=str.replace(/size: 65/g, "size: 50");
	var djnews = Array();
	djnews = str.split("##");
	for(i=0;i<djnews.length - 1;i++){
	content[i] = djnews[i + 1];
	}

if (started == false){
	action();
	started = true;
	}
  }

  function Timer(){
setTimeout("runcalc()", 60000);
}
runcalc();


</script>

</body>
</html>