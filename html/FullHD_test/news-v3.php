<?php

error_reporting(E_ALL & ~E_NOTICE);

define("FILEPATH","/var/www/wsja/html/resource");
include_once "/var/www/wsja/admin/db_info_new.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);

// Select User Info
	$username=filter_var($_GET['uid'],FILTER_SANITIZE_STRING);
	$sql = "select * from userinfo where name=:username";

	$sth = $db->prepare($sql);
	$sth->bindValue(':username', $username);
	$status = $sth->execute();

	while($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$newsfeed = $row['newsfeed'];
		$newscount = $row['newscount'];
		if ($newscount < 0)
		{
			$newscount = 8;
		}
		$news_array = explode(":", $newsfeed);
	}

// server side function call
	function calc() {
		global $news_array, $newscount;

		$totalfeed = '';
		foreach ($news_array as $feedname)
		{
			$totalfeed .= getnews($feedname,$newscount);
		}

		return $totalfeed;
	}

	function checkupdate(){
		global $dbserver,$dbuser, $dbpass;
		$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);
		$sql = "select * from newsfeed";
		$sth = $db->prepare($sql);
		$status = $sth->execute();
		
		$i = 0;
		while($row = $sth->fetch(PDO::FETCH_ASSOC))
		{
			$lastupdate[$i] .= $row['lastupdate'];
			$i++;
		}
		return $lastupdate;

	}

	function getnews($feedname, $numofstory)
	{
		global $dbserver,$dbuser, $dbpass;
		$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);
		$sql = "select * from newsfeed where feedname=:feedname";
		$sth = $db->prepare($sql);
		$sth->bindValue(':feedname', $feedname);
		$status = $sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);	
		
		$feedtitle = $row['Title'];
		$charset   = $row['Language'];
		$feedlink  = $row['URL'];
		$feedfile  = $row['filename'];
		$contents  = str_replace(array("&gt;", "&lt;"), array(">", "<"), htmlspecialchars($row['content_utf8'],ENT_NOQUOTES));

		$xml = simplexml_load_string($contents);
		switch ($charset) {
			case "gb2312":
			case "big5" :
				$xml_items = $xml;
				break;
			default:
				$xml_items = $xml->channel;
				break;
		}

		$ttfeed = '';
		$i = 0;
		foreach ($xml_items->item as $item)
		{
			$title = $item->title;
			$hlink = $item->link;
			$description = $item->description;
			$pubdate = $item->pubDate;
			
			switch ($charset) {
				case "gb2312" :
					$title_final       = '<font style="font-size:45pt;" color="#336AA2" face="SimHei"><b>'.$title.'</b></font><br>';
					$description_final = '<font style="font-size:40pt;" color="#000000" face="SimHei">'.$description.'</font><p>';
					$pubdate_final     = '<font style="font-size:40pt;" color="#336AA2" face="SimHei"><i>'.$pubdate.'</i></font><p>';
					break;
				case "big5"   :
					$title_final       = '<font style="font-size:45pt;" color="#336AA2" face="MingLiU"><b>'.$title.'</b></font><br>';
					$description_final = '<font style="font-size:40pt;" color="#000000" face="MingLiU">'.$description.'</font><p>';
					$pubdate_final     = '<font style="font-size:40pt;" color="#336AA2" face="MingLiU"><i>'.$pubdate.'</i></font><p>';
					break;			
				default       :
					$title_final       = '<font style="font-size:45pt;" color="#336AA2" face="Arial"><b>'.$title.'</b></font><br>';
					$description_final = '<font style="font-size:40pt;" color="#000000" face="Arial">'.$description.'</font><p>';
					$pubdate_final     = '<font style="font-size:40pt;" color="#336AA2" face="Arial"><i>'.$pubdate.'</i></font><p>';
					break;			
			}
			
			$ttfeed .= $title_final . $description_final . "$$";
			$i++;
			if ($i > $numofstory)
			{
				break;
			}
		}
		
		return $ttfeed;

	}  
  
include_once("../resource/agent.php");
$agent->init(); 

$uid = filter_var($_GET["uid"],FILTER_SANITIZE_STRING);

include_once "/var/www/wsja/admin/db_info_new.php";
$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);		
$sql = "select * from userinfo where name=:uid";
$sth = $db->prepare($sql);
$sth->bindValue(':uid', $uid);
$sqlstatus = $sth->execute();

if ($sth->rowCount() <= 0 )
{
	print "Access Denied!";
	exit(1);
}

  
  
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>News Info</title>
</head>

<body bgcolor="#FFFFFF">
<script language="JavaScript1.2" src="js/scroller.js"></script>
<style>
<!--
BODY{
CURSOR: url(test.cur);
}
-->
</style>

<script>
var firststart = false;

runcalc();

  function runcalc()
{
	agent.call('','calc','callback');
	timer();

}
    
 function callback(str)
{
	ddate = new Date();
	temp = str.split("$$");
	content = new Array();
	for (i=0;i<temp.length;i++)
	{
		content[i]=temp[i];
	}

	if(firststart == false){
		action();
		firststart = true;
	}

}
 
function timer()
{
	setTimeout('runcalc()', 24000);
}

function timer2()
{
	setTimeout('call_checkupdate()', 900000);
}

function call_checkupdate(){
	agent.call('','checkupdate','callback_checkupdate');
	timer2();
}

call_checkupdate();

function callback_checkupdate(data)
{
	var endDate= new Date(); 
	var startDate= new Date(data[0].replace("-", "/")); 
	var df=(endDate.getTime()-startDate.getTime())/3600/1000; 
	if(df<0.5)
	{
		document.getElementById('noupdate').style.display = "none";
	}
	else
	{
		document.getElementById('noupdate').style.display = "inline";
	}
}
</script>

</body>

</html>
