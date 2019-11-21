<?php

function calc($username) {

	include "config.inc.php";

	$property_name = $username;
	if ($property_name == "adsonly")
	{
		$mediatype = 2;
	}
	else
	{
		$mediatype = $_COOKIE["mediatype"];
	}

	// Sponsor ads
	include FILEPATH."/include/sponsor.php";
	if (sizeof($sponsor)> 0)
	{
		if(!isset($_COOKIE["sponsor"])) 
		{
			$timeout = $sponsor[0]["timeout"];
			$sponsorname = $sponsor[0]["sponsorname"];
			$duration = $sponsor[0]["duration"];
			$content = $sponsor[0]["html"];
			setcookie("sponsor", $sponsorname, time() + $timeout, "/");
			return $content."##".$duration."##".$mediatype."##".$prtyno_id."##".$prtyno."##".$adsno_id."##".$adsno;
		}
	}
    // End Sponsor Ads
	
	$prtyno_id=0;
	$adsno_id=0;

	if ($mediatype == 1)
	{
	// property
		include FILEPATH."/include/property_HD.php";

		if ($property_name == "")
		{
			$prtytotal = sizeof($prty);

			$prtyno_id=1;
			$prtyno = $_COOKIE["prtyno"];
			if ($prtyno < $prtytotal)
			{ $prtyno = $prtyno + 1; }
			else
			{ $prtyno = 1;}	
			$name = $prty[$prtyno-1][0];
			$duration = $prty[$prtyno-1][1];
			$content = $prty[$prtyno-1][2];
		}
		else
		{ 
			$prtytotal = sizeof($prty);

			$j = 0;
			for ($i=0; $i < $prtytotal; $i++)
			{
				if ($property_name == $prty[$i][0])
				{
			
					$durations[$j] = $prty[$i][1];
					$contents[$j] = $prty[$i][2];
					$j++;
				}
			}

			if ($j > 0)
			{
				$num = rand(0,$j-1);
				$duration = $durations[$num];
				$content = $contents[$num];
			}
			else
			{
				$duration = $durations[0];
				$content = $contents[0];
			}
		}
	}
	else
		{
	// Advertisment
		include FILEPATH."/include/ads_HD2.php";
		$adstotal = sizeof($ads);

		$adsno_id=1;
		$adsno = $_COOKIE["adsno"];
		if ($adsno < $adstotal)
		{ $adsno = $adsno + 1; }
		else
		{ $adsno = 1;}	
		$duration = $ads[$adsno-1][0];
		$content = $ads[$adsno-1][1];
	}

	$mediatype = $mediatype + 1;
	if ($mediatype > 2)
	{ $mediatype = 1; }

	return $content."##".$duration."##".$mediatype."##".$prtyno_id."##".$prtyno."##".$adsno_id."##".$adsno;
}

  include_once("../resource/agent.php");
  $agent->init(); 


?>

<!DOCTYPE html>
<html>

<head>
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="x-ua-compatible" content="IE=9">
<title>Welcome to Wall Street Journal Asia</title>

 <style>

</style>


<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript1.2"> 
 	function getParams() 
	{
		var idx = document.URL.indexOf('?');
		var params = new Array();
		if (idx != -1) 
		{
			var pairs = document.URL.substring(idx+1, document.URL.length).split('&');
			for (var i=0; i<pairs.length; i++) 
			{
				nameVal = pairs[i].split('=');
				params[nameVal[0]] = nameVal[1];
		   	}
		}
		return params;
	}
	params = getParams();	
	username = unescape(params["username"]);

 function runcalc() {
    agent.call('','calc','callback', username);
  }
  
  function callback(str) {
	string=str.split("##");
	string_min=string[1].split(":");
	document.getElementById('media').innerHTML = string[0];
	setTimeout("runcalc()", string_min[0]*60*1000+string_min[1]*1000);
	createCookie('mediatype', string[2], 60);
	if(string[3] == 1){
	createCookie('prtyno', string[4], 60);
	}
	if(string[5] == 1){
	createCookie('adsno', string[6], 60);
	}
}

//--------------------------------------------------------------------------------------------
// cookie

function createCookie(name,value,min) {
	if (min) {
		var date = new Date();
		date.setTime(date.getTime()+(min*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

runcalc();
</SCRIPT> 

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

</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="557" id="AutoNumber1">
  <tr>
    <td width="557" height="662" align="center" valign="middle">
		<div id="media" style="align:center"></div>
    </td>
  </tr>
</table>

</body>

</html>


