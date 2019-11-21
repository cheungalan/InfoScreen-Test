<?php

function calc(){
/*
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
*/	
	$content = file_get_contents('http://localhost/resource/api/stock.php?ver=2');
	return $content;
}

  include_once("../resource/agent.php");
  $agent->init(); 
?>

<div id='F'>&nbsp;</div>
<script language="JavaScript1.2" src="js/scroller_left.js"></script>
<script>
var started = false;
  function runcalc() {
    agent.call('','calc','callback');
	Timer();
  }
  
  function callback(str) {
	var ddate = new Date();
	var djnews = Array();
	djnews = str.split("##");
	for(i=0;i<djnews.length - 1;i++){
//	content[i] = djnews[i] + ddate.toString();
	content[i] = djnews[i];

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
