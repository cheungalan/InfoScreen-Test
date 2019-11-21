<?php

error_reporting(E_ALL & ~E_NOTICE);

define("FILEPATH","/var/www/wsja/html/resource");
include_once "/var/www/wsja/admin/db_info.php";

// include "config.inc.php";

// Select User Info
	$username=filter_var($_GET['username'],FILTER_SANITIZE_STRING);

function calc($username) {

	global $username;
	global $dbserver,$dbuser, $dbpass;
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);
	
	$property_name = $username;
	if ($property_name == "adsonly")
	{
		$mediatype = 2;
	}
	else
	{
		$mediatype = $_COOKIE["mediatype"];
	}

	$prtyno_id=0;
	$adsno_id=0;

	if ($mediatype == 1)
	{
	// property

		$query = "SELECT userinfo.id,userinfo.name, userimage.duration, userimage.code from userinfo, userimage where userinfo.id=userimage.user_id and userimage.page=1 and version='normal' and active=1 and name=:username";
		$sth = $db->prepare($query);
		$sth->bindValue(':username', $username);
		$status = $sth->execute();		
		$usertotal = $sth->rowCount();
		
		if ($usertotal >= 1)
		{
			$userno = rand(1,$usertotal);
			
			$i=1;
			while($row = $sth->fetch(PDO::FETCH_ASSOC))
			{
				if ($i != $userno)
				{
					$i++;
					continue;
				}
				else
				{
					$duration = $row['duration'];
					$content = $row['code'];
					break;
				}
			}	
		}
	}
	else
	{
	// Advertisment
		$query = "SELECT * FROM bannercode where version='normal' and active=1";
		$sth = $db->prepare($query);
		$sth->bindValue(':username', $username);
		$status = $sth->execute();		
		$adstotal = $sth->rowCount();
		
		$adsno_id=1;
		$adsno = $_COOKIE["adsno"];
		if ($adsno < $adstotal)
		{ 
			$adsno = $adsno + 1; 
		}
		else
		{ 
			$adsno = 1;
		}	

		$i=1;
		while($row = $sth->fetch(PDO::FETCH_ASSOC))
		{
			if ($i != $adsno)
			{
				$i++;
				continue;
			}
			else
			{
				$duration = $row['bannerduration'];;
				$content = $row['bannercode'];
				break;
			}
		}	
	}

	$mediatype = $mediatype + 1;
	if ($mediatype > 2)
	{ $mediatype = 1; }

	return $content."##".$duration."##".$mediatype."##".$prtyno_id."##".$prtyno."##".$adsno_id."##".$adsno;
}

  include_once("../resource/agent.php");
  $agent->init(); 


?>


<html>

<head>
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Welcome to Wall Street Journal Asia</title>

<style>
<!--
BODY{
CURSOR: url(../wide/blank.cur);
}
-->
</style>

<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript1.2"> 
	username = "<?php echo filter_var($_GET['username'],FILTER_SANITIZE_STRING) ?>";

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
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="398" id="AutoNumber1">
  <tr>
    <td width="398" height="468" align="center" valign="middle">
		<div id="media" style="align:center"></div>
    </td>
  </tr>
</table>

</body>

</html>


