<?php

$items = preg_split("/\|/", $_GET["client"], -1, PREG_SPLIT_NO_EMPTY);

$items1 = preg_split("/=>/", $items[0], -1, PREG_SPLIT_NO_EMPTY);
$username = trim($items1[1]);

$items1 = preg_split("/=>/", $items[1], -1, PREG_SPLIT_NO_EMPTY);
$password = trim($items1[1]);

$items1 = preg_split("/=>/", $items[2], -1, PREG_SPLIT_NO_EMPTY);
$lang = trim($items1[1]);

$items1 = preg_split("/=>/", $items[3], -1, PREG_SPLIT_NO_EMPTY);
$numofstory = trim($items1[1]);


function calc() {
	$link = "/var/www/wsja/html/resource/include/stock.txt";
	$contents = "";  
	$contents = file_get_contents($link);
	return $contents;
}

  include_once("../resource/agent.php");
  $agent->init();

?>


<html>
<head>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>WSJA Infoscreen</title>
</head>
<body>
<div id = "main" style='position:absolute;background:#FFFFFF;width:1920; height:1080;left:0; top:0;margin:0px;overflow:hidden;padding:0px;border-style:solid; border-width:1px; border-color:#5C5C5C;''>
<div id = "A" style='width:1920;height:1080;position:absolute;'>
<iframe 
			<?php
					print 'src="main2.php?username='.$username.'&lang='.$lang.'&numofstory='.$numofstory.'"'; 
				?>
	width="1920" height="1080" 
	scrolling="no" 
	frameborder="0"
	marginwidth="0" marginheight="20" name="I1">
</iframe>
</div>
<div id = "B" style='width:1920;height:1080;position:absolute;background-color:#FFFFFF;'>
</div>
</div>

<script>
var started = false;
function changeA(){
	document.getElementById('A').style.pixelLeft += 1920;
	document.getElementById('B').style.pixelLeft += 1920;
	if (document.getElementById('A').style.pixelLeft == 0){
		timerA();
	}else{
		changetimerA();
	}

}


function changeB(){
	document.getElementById('A').style.pixelLeft -= 1920;
	document.getElementById('B').style.pixelLeft -= 1920;
	if (document.getElementById('B').style.pixelLeft == 0){
		timerB();
		//document.getElementById('B').innerHTML = '<embed src="EAG.swf" quality="high" bgcolor="#000000" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="1920" height="1080"></embed>';
		document.getElementById('B').innerHTML = '<iframe src="http://wsj.com/hk" width="1920" height="1080"></iframe>';

	}else{
		changetimerB();
	}
}

function changetimerA(){
setTimeout("changeA();", 1);
}

function changetimerB(){
setTimeout("changeB();", 1);
}

function timerA(){
//setTimeout("changeB();", 1800000);
setTimeout("changeB();", 10000);
//runcalc();
//callback2();
}

function timerB(){
setTimeout("changeA();", 10000);
//action();
}

document.getElementById('A').style.pixelLeft = 0;
document.getElementById('B').style.pixelLeft = 1920;

timerA();


</script>


</body>
</html>