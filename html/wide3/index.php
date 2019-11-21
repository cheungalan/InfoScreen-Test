<?php
/*
$items = preg_split("/\|/", $_GET["client"], -1, PREG_SPLIT_NO_EMPTY);
$arr = array();
foreach ($items as $str) {
	$temp = preg_split("/=>/", $str, -1, PREG_SPLIT_NO_EMPTY);
	$arr[trim($temp[0])] = trim($temp[1]);	
}

$username = $arr["username"];
$password = $arr["password"];
$lang = $arr["lang"];
$numofstory = $arr["numofstory"];
$secondpagetime=$arr["secondpagetime"];

if ($secondpagetime == 0)
{ $secondpagetime = 30; }
*/	

if ($_GET["client"])
{
	$items = preg_split("/\|/", $_GET["client"], -1, PREG_SPLIT_NO_EMPTY);
	$arr = array();
	foreach ($items as $str) {
		$temp = preg_split("/=>/", $str, -1, PREG_SPLIT_NO_EMPTY);
		$arr[trim($temp[0])] = trim($temp[1]);	
	}

	$username 		= $arr["username"];
	$password 		= $arr["password"];
	$lang 			= $arr["lang"];
	$numofstory 	= $arr["numofstory"];
	$secondpagetime	= $arr["secondpagetime"];
}
else
{
	$username 		= filter_var($_GET['uid'], FILTER_SANITIZE_STRING);
	$lang 			= filter_var($_GET['lang'], FILTER_SANITIZE_STRING);
	$numofstory		= filter_var($_GET['numofstory'], FILTER_SANITIZE_STRING);
	$secondpagetime	= filter_var($_GET['secondpagetime'], FILTER_SANITIZE_STRING);
}
if ($secondpagetime == 0)
{ 
	$secondpagetime = 30; 
}
	
 
function weather_calc() {
	$type = $_GET["type"];
	$link = "http://www.weather.gov.hk/textonly/forecast/englishwx.htm";

	//Temperature
	$contents = file_get_contents($link); 
	$result = preg_match("/(AIR TEMPERATURE : )(.*)( DEGREES CELSIUS\nRELATIVE HUMIDITY)/i", $contents, $items);
	$temperature = $items[2]."&#176;C";

	//pic
	$result = preg_match("/(WEATHER CARTOON : NO.)(.*)( -)/", $contents, $items);
	$pic = "<img src=http://www.weather.gov.hk/images/wxicon/pic".trim($items[2]).".png width='25' height='25' border='0'>";
  
	return $temperature."***".$pic;
  }

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
	CURSOR: url(../wide/blank.cur);
}
-->
.drop { position: absolute; width: 3;  filter: flipV(), flipH(); font-size: 40; color: #ffffff }

</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>WSJA Infoscreen</title>
// Prevent Clickjacking
<style>
html { display:none; }
</style>
<script>
if (self == top)
{ document.documentElement.style.display = 'block'; }
else
{ top.location = self.location; }
</script>
// End Prevent Clickjacking
</head>
<body>

<div id = "main" style='position:absolute;background:#FFFFFF;width:1280; height:768;left:0; top:0;margin:0px;overflow:hidden;padding:0px;border-style:solid; border-width:1px; border-color:#5C5C5C;''>
<div id = "A" style='width:1280;height:768;position:absolute;'>
<iframe 
			<?php
					print 'src="../wide/main.php?username='.$username.'&lang='.$lang.'&numofstory='.$numofstory.'"'; 
				?>
	width="1280" height="768" 
	scrolling="no" 
	frameborder="0"
	marginwidth="0" marginheight="20" name="I1">
</iframe>
</div>
<div id = "B" style='width:1280;height:768;position:absolute;'>
<iframe 
	<?php
		print 'src="../wide/line-d_v2.php?uid='.$username.'"'; 
//		include_once("../wide/line-d_v2.php"); 
	?>
	width="1920" height="1080" 
	scrolling="no" 
	frameborder="0"
	marginwidth="0" marginheight="20" name="I1">
</iframe>	
</div>
</div>

<script>
var started = false;
function changeA(){
//	document.getElementById('A').style.pixelLeft += 128;
//	document.getElementById('B').style.pixelLeft += 128;
	x = parseInt(document.getElementById('A').style.left);
	y = parseInt(document.getElementById('B').style.left);
	document.getElementById('A').style.left = x + 128;
	document.getElementById('B').style.left = y + 128;
//	if (document.getElementById('A').style.pixelLeft == 0){
	if (parseInt(document.getElementById('A').style.left) == 0){		
		timerA();
	}else{
		changetimerA();
	}

}


function changeB(){
//	document.getElementById('A').style.pixelLeft -= 128;
//	document.getElementById('B').style.pixelLeft -= 128;
	x = parseInt(document.getElementById('A').style.left);
	y = parseInt(document.getElementById('B').style.left);
	document.getElementById('A').style.left = x - 128;
	document.getElementById('B').style.left = y - 128;
//	if (document.getElementById('B').style.pixelLeft == 0){
	if (parseInt(document.getElementById('B').style.left) == 0){	
		timerB();
	}else{
		changetimerB();
	}
}

function changetimerA(){
setTimeout("changeA();", 50);
}

function changetimerB(){
setTimeout("changeB();", 50);
}

function timerA(){
setTimeout("changeB();", 300000);
//setTimeout("changeB();", 10000);
//runcalc();
//callback2();
}

function timerB(){
setTimeout("changeA();", 120000);
//setTimeout("changeA();", 100000);
//action();
}

//document.getElementById('A').style.pixelLeft = 0;
//document.getElementById('B').style.pixelLeft = 1280;
document.getElementById('A').style.left = 0;
document.getElementById('B').style.left = 1280;
timerA();


</script>


</body>
</html>
