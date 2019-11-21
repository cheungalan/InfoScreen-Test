<?php 

  // server side function call
function calc() 
{
	include_once "config.inc.php";

	$fontcolor="<font style='font-size:26pt; font-weight:bold' color='#336AA2'>";
//	$stock_time = "<font size='1' color='#336AA2'><i><u>Stock info last update</u> : ".$reg[2];

	$checkhsi=true;
	$checkdji=true;
	$checknaq=true;
	$checkssea=true;

	if($checkhsi == true)
	{
		$link = "/var/www/wsja/html/resource/feed/".'HSI.html';
		
		if (($handle = fopen($link, "rb")) === FALSE) 
		{ 
			fclose($handle); 
			return false; 
		}
			
		$contents = '';
		while (!feof($handle)) {
		  $contents .= fread($handle, 8192);
		}
		fclose($handle);
	
		$tt = strip_tags($contents);
			
		$items = preg_split("/HSI/", $tt, -1, PREG_SPLIT_NO_EMPTY);
		$str = preg_replace('/\s\s+/', ' ', trim($items[1]));
		$arr1 = preg_split('/ /', $str, -1, PREG_SPLIT_NO_EMPTY);
		$arr1[1] = str_replace("+",'<img border="0" src="\FullHD\images\up_2.jpg" alt="Up"><font color="#009900"><b>',$arr1[1]);
		$arr1[1] = str_replace("-",'<img border="0" src="\FullHD\images\down_2.jpg" alt="Down"><font color="#dc4444"><b>',$arr1[1]);
		$arr1[1] = str_replace("<font ",'<font style="font-size: 30pt "',$arr1[1]);
		$hsi_index = "%%<b>".$fontcolor."HSI</font></b>"."%%"."<b>".$fontcolor.$arr1[0]."</font></b>"."%%".$arr1[1]."</font></b>";
	}

	if($checkssea == true)
	{
		$link = "/var/www/wsja/html/resource/feed/".'ssea.html';

		if (($handle = fopen($link, "rb")) === FALSE) 
		{ 
			fclose($handle); 
			return false; 
		}
			
		$contents = '';
		while (!feof($handle)) {
			$contents .= fread($handle, 8192);
		}
		fclose($handle);
			
		$tt = strip_tags($contents);
			
		$items = preg_split("/SSE A/", $tt, -1, PREG_SPLIT_NO_EMPTY);
		$str = preg_replace('/\s\s+/', ' ', trim($items[1]));
		$arr1 = preg_split('/ /', $str, -1, PREG_SPLIT_NO_EMPTY);
		$arr1[1] = str_replace("+",'<img border="0" src="\FullHD\images\up_2.jpg" alt="Up"><font color="#009900"><b>',$arr1[1]);
		$arr1[1] = str_replace("-",'<img border="0" src="\FullHD\images\down_2.jpg" alt="Down"><font color="#dc4444"><b>',$arr1[1]);
		$arr1[1] = str_replace("<font ",'<font style="font-size: 30pt "',$arr1[1]);
		$shanghai_index = "%%<b>".$fontcolor."Shanghai A</font></b>"."%%"."<b>".$fontcolor.$arr1[0]."</font></b>"."%%".$arr1[1]."</font></b>";

		$result = ereg("(Last Updated:)(.*)(</b></font></td>)",$contents,$reg);
		$stock_time = $reg[2];

//		$fontcolor="<font style='font-size:17pt; font-weight:bold' color='#336AA2'>";

		$stock_time = "<font style='font-size:8pt' color='#336AA2'><i>&nbsp;&nbsp;<u>Stock info last update</u> : ".$reg[2];
		$stock_time .= "<br><font style='font-size:8pt' color='#336AA2'><i>* <u>Delay Stock Quote</u></i></font>";
	}

	if($checkdji == true)
	{
		$link = "/var/www/wsja/html/resource/feed/".'world.html';
		
		if (($handle = fopen($link, "rb")) === FALSE) 
		{ 
			fclose($handle); 
			return false; 
		}
			
		$contents = '';
		while (!feof($handle)) {
			$contents .= fread($handle, 8192);
		}
		fclose($handle);
			
		$tt = strip_tags($contents);
			
		$items = preg_split("/DJIA/", $tt, -1, PREG_SPLIT_NO_EMPTY);
		$str = preg_replace('/\s\s+/', ' ', trim($items[1]));

		$arr1 = preg_split('/ /', $str, -1, PREG_SPLIT_NO_EMPTY);
		$arr1[1] = str_replace("+",'<img border="0" src="\FullHD\images\up_2.jpg" alt="Up"><font color="#009900"><b>',$arr1[1]);
		$arr1[1] = str_replace("-",'<img border="0" src="\FullHD\images\down_2.jpg" alt="Down"><font color="#dc4444"><b>',$arr1[1]);
		$arr1[1] = str_replace("<font ",'<font style="font-size: 30pt "',$arr1[1]);
		$dji_index = "%%<b>".$fontcolor."DJI*</font></b>"."%%"."<b>".$fontcolor.$arr1[0]."</font></b>"."%%".$arr1[1]."</font></b>";
	}

	if($checknaq == true)
	{
		$link = "/var/www/wsja/html/resource/feed/".'world.html';
	
		if (($handle = fopen($link, "rb")) === FALSE) 
		{ 
			fclose($handle); 
			return false; 
		}
			
		$contents = '';
		while (!feof($handle)) {
			$contents .= fread($handle, 8192);
		}
		fclose($handle);
			
		$tt = strip_tags($contents);
			
		$items = preg_split("/NASDAQ/", $tt, -1, PREG_SPLIT_NO_EMPTY);
		$str = preg_replace('/\s\s+/', ' ', trim($items[1]));

		$arr1 = preg_split('/ /', $str, -1, PREG_SPLIT_NO_EMPTY);

		$arr1[1] = str_replace("+",'<img border="0" src="\FullHD\images\up_2.jpg" alt="Up"><font color="#009900"><b>',$arr1[1]);
		$arr1[1] = str_replace("-",'<img border="0" src="\FullHD\images\down_2.jpg" alt="Down"><font color="#dc4444"><b>',$arr1[1]);
		$arr1[1] = str_replace("<font ",'<font style="font-size: 30pt "',$arr1[1]);
		$nasdaq_index = "%%<b>".$fontcolor."NASDAQ*</font></b>"."%%"."<b>".$fontcolor.$arr1[0]."</font></b>"."%%".$arr1[1]."</font></b>";
	}

	return $stock_time."##".$hsi_index."##".$dji_index."##".$nasdaq_index."##".$sp500_index."##".$shanghai_index;
}

include_once("agent.php");
$agent->init(); 
  
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Info Page</title>
 <style>
<!--
BODY{
CURSOR: url(test.cur);
}
-->
</style>
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


<script TYPE="text/javascript" language="JavaScript1.2" src="js/common.js"></script>
<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript"> 
//	norightclick() ;
//	autoreload("1:00");
</SCRIPT>  

</head>

<script>

  function runcalc() {
    agent.call('','calc','callback');
    timer();
  }
  
  function callback(str) {
    string=str.split("##")
    string1=string[1].split("%%")
    string2=string[2].split("%%")
    string3=string[3].split("%%")
    //string4=string[4].split("%%")
    string5=string[5].split("%%")

	var host_hsi_index1 = document.getElementById('hsi_index1');
	if(document.getElementById('parent_hsi_index1'))
	{
		var parent_hsi_index1 = document.getElementById('parent_hsi_index1');
		host_hsi_index1.removeChild(parent_hsi_index1);
	}
	var parent_hsi_index1 = document.createElement('div');
	parent_hsi_index1.id = "parent_hsi_index1";
	host_hsi_index1.appendChild(parent_hsi_index1);
	document.getElementById('parent_hsi_index1').innerHTML = string1[1];	

	var host_hsi_index2 = document.getElementById('hsi_index2');
	if(document.getElementById('parent_hsi_index2'))
	{
		var parent_hsi_index2 = document.getElementById('parent_hsi_index2');
		host_hsi_index2.removeChild(parent_hsi_index2);
	}
	var parent_hsi_index2 = document.createElement('div');
	parent_hsi_index2.id = "parent_hsi_index2";
	host_hsi_index2.appendChild(parent_hsi_index2);
	document.getElementById('parent_hsi_index2').innerHTML = string1[2];	

	var host_hsi_index3 = document.getElementById('hsi_index3');
	if(document.getElementById('parent_hsi_index3'))
	{
		var parent_hsi_index3 = document.getElementById('parent_hsi_index3');
		host_hsi_index3.removeChild(parent_hsi_index3);
	}
	var parent_hsi_index3 = document.createElement('div');
	parent_hsi_index3.id = "parent_hsi_index3";
	host_hsi_index3.appendChild(parent_hsi_index3);
	document.getElementById('parent_hsi_index3').innerHTML = string1[3];	


	var host_dji_index1 = document.getElementById('dji_index1');
	if(document.getElementById('parent_dji_index1'))
	{
		var parent_dji_index1 = document.getElementById('parent_dji_index1');
		host_dji_index1.removeChild(parent_dji_index1);
	}
	var parent_dji_index1 = document.createElement('div');
	parent_dji_index1.id = "parent_dji_index1";
	host_dji_index1.appendChild(parent_dji_index1);
      document.getElementById('parent_dji_index1').innerHTML = string2[1];


	var host_dji_index2 = document.getElementById('dji_index2');
	if(document.getElementById('parent_dji_index2'))
	{
		var parent_dji_index2 = document.getElementById('parent_dji_index2');
		host_dji_index2.removeChild(parent_dji_index2);
	}
	var parent_dji_index2 = document.createElement('div');
	parent_dji_index2.id = "parent_dji_index2";
	host_dji_index2.appendChild(parent_dji_index2);
      document.getElementById('parent_dji_index2').innerHTML = string2[2];

	var host_dji_index3 = document.getElementById('dji_index3');
	if(document.getElementById('parent_dji_index3'))
	{
		var parent_dji_index3 = document.getElementById('parent_dji_index3');
		host_dji_index3.removeChild(parent_dji_index3);
	}
	var parent_dji_index3 = document.createElement('div');
	parent_dji_index3.id = "parent_dji_index3";
	host_dji_index3.appendChild(parent_dji_index3);
      document.getElementById('parent_dji_index3').innerHTML = string2[3];


	var host_nasdaq_index1 = document.getElementById('nasdaq_index1');
	if(document.getElementById('parent_nasdaq_index1'))
	{
		var parent_nasdaq_index1 = document.getElementById('parent_nasdaq_index1');
		host_nasdaq_index1.removeChild(parent_nasdaq_index1);
	}
	var parent_nasdaq_index1 = document.createElement('div');
	parent_nasdaq_index1.id = "parent_nasdaq_index1";
	host_nasdaq_index1.appendChild(parent_nasdaq_index1);
      document.getElementById('parent_nasdaq_index1').innerHTML = string3[1];


	var host_nasdaq_index2 = document.getElementById('nasdaq_index2');
	if(document.getElementById('parent_nasdaq_index2'))
	{
		var parent_nasdaq_index2 = document.getElementById('parent_nasdaq_index2');
		host_nasdaq_index2.removeChild(parent_nasdaq_index2);
	}
	var parent_nasdaq_index2 = document.createElement('div');
	parent_nasdaq_index2.id = "parent_nasdaq_index2";
	host_nasdaq_index2.appendChild(parent_nasdaq_index2);
      document.getElementById('parent_nasdaq_index2').innerHTML = string3[2];

	var host_nasdaq_index3 = document.getElementById('nasdaq_index3');
	if(document.getElementById('parent_nasdaq_index3'))
	{
		var parent_nasdaq_index3 = document.getElementById('parent_nasdaq_index3');
		host_nasdaq_index3.removeChild(parent_nasdaq_index3);
	}
	var parent_nasdaq_index3 = document.createElement('div');
	parent_nasdaq_index3.id = "parent_nasdaq_index3";
	host_nasdaq_index3.appendChild(parent_nasdaq_index3);
      document.getElementById('parent_nasdaq_index3').innerHTML = string3[3];

	var host_shanghai_index1 = document.getElementById('shanghai_index1');
	if(document.getElementById('parent_shanghai_index1'))
	{
		var parent_shanghai_index1 = document.getElementById('parent_shanghai_index1');
		host_shanghai_index1.removeChild(parent_shanghai_index1);
	}
	var parent_shanghai_index1 = document.createElement('div');
	parent_shanghai_index1.id = "parent_shanghai_index1";
	host_shanghai_index1.appendChild(parent_shanghai_index1);
      document.getElementById('parent_shanghai_index1').innerHTML = string5[1];

	var host_shanghai_index2 = document.getElementById('shanghai_index2');
	if(document.getElementById('parent_shanghai_index2'))
	{
		var parent_shanghai_index2 = document.getElementById('parent_shanghai_index2');
		host_shanghai_index2.removeChild(parent_shanghai_index2);
	}
	var parent_shanghai_index2 = document.createElement('div');
	parent_shanghai_index2.id = "parent_shanghai_index2";
	host_shanghai_index2.appendChild(parent_shanghai_index2);
      document.getElementById('parent_shanghai_index2').innerHTML = string5[2];


	var host_shanghai_index3 = document.getElementById('shanghai_index3');
	if(document.getElementById('parent_shanghai_index3'))
	{
		var parent_shanghai_index3 = document.getElementById('parent_shanghai_index3');
		host_shanghai_index3.removeChild(parent_shanghai_index3);
	}
	var parent_shanghai_index3 = document.createElement('div');
	parent_shanghai_index3.id = "parent_shanghai_index3";
	host_shanghai_index3.appendChild(parent_shanghai_index3);
      document.getElementById('parent_shanghai_index3').innerHTML = string5[3];


	var host_stock_time = document.getElementById('stock_time');
	if(document.getElementById('parent_stock_time'))
	{
		var parent_stock_time = document.getElementById('parent_stock_time');
		host_stock_time.removeChild(parent_stock_time);
	}
	var parent_stock_time = document.createElement('div');
	parent_stock_time.id = "parent_stock_time";
	host_stock_time.appendChild(parent_stock_time);
      document.getElementById('parent_stock_time').innerHTML = string[0];


  } 

  function timer() {
    setTimeout("runcalc()", 120000);
  }

</script>

<body onload="runcalc()">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="557" height="224">
  <tr>
    <td width="241" style="font-family: Arial"></td>
    <td width="190" style="font-family: Arial"></td>
    <td width="126" style="font-family: Arial"></td>
  </tr>  
  <tr>
    <td width="241" style="font-family: Arial"><div id = "hsi_index1"></div></td>
    <td width="190" style="font-family: Arial"><div id = "hsi_index2"></div></td>
    <td width="126" style="font-family: Arial"><div id = "hsi_index3" style="color: #009900; font-size: 30pt; font-weight: bold"></div></td>
  </tr>
  <tr>
    <td width="241" style="font-family: Arial"><div id = "dji_index1"></div></td>
    <td width="190" style="font-family: Arial"><div id = "dji_index2"></div></td>
    <td width="126" style="font-family: Arial"><div id = "dji_index3" style="color: #009900; font-size: 30pt; font-weight: bold"></div></td>
  </tr>
  <tr>
    <td width="241" style="font-family: Arial"><div id = "nasdaq_index1"></div></td>
    <td width="190" style="font-family: Arial"><div id = "nasdaq_index2"></div></td>
    <td width="126" style="font-family: Arial"><div id = "nasdaq_index3" style="color: #009900; font-size: 30pt; font-weight: bold"></div></td>
  </tr>
  <tr>
    <td width="241" style="font-family: Arial"><div id = "shanghai_index1"></div></td>
    <td width="190" style="font-family: Arial"><div id = "shanghai_index2"></div></td>
    <td width="126" style="font-family: Arial"><div id = "shanghai_index3" style="color: #009900; font-size: 30pt; font-weight: bold"></div></td>
  </tr>
  <tr>
    <td colspan="3" width="557"><div id = "stock_time"></div></td>
  </tr>
</table> 