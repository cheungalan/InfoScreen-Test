<?php 

  error_reporting(E_ALL & ~E_NOTICE);

  // server side function call
   
function calc() {
	$type = $_GET["type"];
	$link = "http://www.weather.gov.hk/textonly/forecast/englishwx.htm";

	//Temperature
	$contents = file_get_contents($link); 
	$result = preg_match("/(AIR TEMPERATURE : )(.*)( DEGREES CELSIUS\nRELATIVE HUMIDITY)/i", $contents, $items);
	$temperature = $items[2]."&#176;C";

	//pic
	$result = preg_match("/(WEATHER CARTOON : NO.)(.*)( -)/i", $contents, $items);
	$pic = "<img src=http://www.weather.gov.hk/images/wxicon/pic".trim($items[2]).".png width='35' height='35' border='0'>";
  
	return $temperature."***".$pic;



  }

  include_once("../resource/agent.php");
  $agent->init(); 
  
?>
<script TYPE="text/javascript" language="JavaScript1.2" src="js/common.js"></script>
<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript"> 
	norightclick() ;
//	autoreload("1:00");
</SCRIPT> 
<script>

  function runcalc() {
    agent.call('','calc','callback');
    timer();
  }
  
  function callback(str) {
    string=str.split("***")
	var host_a = document.getElementById('a');
	if(document.getElementById('parent_a'))
	{
		var parent_a = document.getElementById('parent_a');
		host_a.removeChild(parent_a);
	}
	var parent_a = document.createElement('div');
	parent_a.id = "parent_a";
	host_a.appendChild(parent_a);
      document.getElementById('a').innerHTML = string[0];


	var host_b = document.getElementById('b');
	if(document.getElementById('parent_b'))
	{
		var parent_b = document.getElementById('parent_b');
		host_b.removeChild(parent_b);
	}
	var parent_b = document.createElement('div');
	parent_b.id = "parent_b";
	host_b.appendChild(parent_b);
      document.getElementById('b').innerHTML = string[1];
  }

  function timer() {
    setTimeout("runcalc()", 600000);
  }

</script>

<style>
  p { font-size: 12px; font-family: Verdana, Arial; }; 
</style>
 <style>
<!--
BODY{
CURSOR: url(test.cur);
}
-->
</style>
<body onload="runcalc()" bgcolor="#221E1F">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="135" id="AutoNumber2">
<tr>
<td width="135" height="37">
<font style="font-family:Arial; font-size:35px; color:#FFFFFF;">
<p align="right">
<div id = "a"></div>
</td>
<td>
<div id = "b"></div>
</font>
</td>
</tr>
</table>
</body>
 
