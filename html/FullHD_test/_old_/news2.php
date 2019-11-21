<?php
	// server side function call
	function calc() {
		include_once "config.inc.php";
		include FILEPATH."/include/feed.php";
		$feedtotal = sizeof($feed);
		$username=$_GET['username'];
		$lang=$_GET['lang'];
		$storynum = 0;
		$totalfeed="";
		$title=array();
		$hlink=array();
		$description=array();
		$i = 0;

		if ($lang > 999){
			$totalfeed .= getnews(3);
			$lang = $lang - 1000;
		}
		if($lang > 99){
			$totalfeed .= getnews(2);
			$lang = $lang - 100;
		}
		if($lang > 9){
			$totalfeed .= getnews(1);
			$lang = $lang - 10;
		}
		if($lang > 0){
			$totalfeed .= getnews(0);
			$lang = $lang - 1;
		}
		return $totalfeed;
	}

	function getnews($feedno){
		include FILEPATH."/include/feed.php";
		$numofstory=$_GET['numofstory'];
		$feedtitle = $feed[$feedno][1];
		$charset = $feed[$feedno][2];
		$feedlink = $feed[$feedno][3];
		$feedfile = $feed[$feedno][4];
		$feedname = $feed[$feedno][5];
		$link = FILEPATH."/feed/".$feedfile;

		$contents = file_get_contents($link);
		if ($feedno == 2)
		{
			$xml = new SimpleXmlElement(str_replace("&","&amp;",$contents));
		}
		else
		{
			$xml = new SimpleXmlElement($contents);
		}

		$count=1;
		if ($charset=='gb2312' || $charset=='big5' )
		{
			foreach ($xml->item as $item)
			{
				$title[$count] = $item->title;
				$hlink[$count] = $item->link;
				$description[$count] = $item->description;
				$pubdate[$count] = $item->pubDate;
				$count++;
			}
		}
		else
		{
			foreach ($xml->channel->item as $item)
			{
				$title[$count] = $item->title;
				$hlink[$count] = $item->link;
				$description[$count] = strip_tags($item->description);
				$pubdate[$count] = $item->pubDate;
				$count++;
			}
		}
		
		$j = 0;
		$i = 0;

		for ($i=1; $i<=$count; $i++)
		{
			if (strlen($description[$i]) > 10)
			{
				if ($charset == 'big5')
				{
					$title[$i] = str_replace("'","&#039",$title[$i]);
					$title1 = '<font style="font-size:45pt;" color="#336AA2" face="MingLiU"><b>'.$title[$i].'</b></font><br>';
					$description[$i] = strip_tags(str_replace("'","&#039",$description[$i]));
					$content = '<font style="font-size:40pt;" color="#000000" face="MingLiU">'.$description[$i].'</font><p>';
					$pubdate1 = '<font style="font-size:40pt;" color="#336AA2" face="MingLiU"><i>'.$pubdate[$i].'</i></font><p>';
				}
				else if ($charset == 'gb2312')
				{
					$title[$i] = str_replace("'","&#039",$title[$i]);
					$title1 = '<font style="font-size:45pt;" color="#336AA2" face="SimHei"><b>'.$title[$i].'</b></font><br>';
					$description[$i] = strip_tags(str_replace("'","&#039",$description[$i]));
					$content = '<font style="font-size:40pt;" color="#000000" face="SimHei">'.$description[$i].'</font><p>';
					$pubdate1 = '<font style="font-size:40pt;" color="#336AA2" face="SimHei"><i>'.$pubdate[$i].'</i></font><p>';
				}
				else 
				{ 
					$title[$i] = str_replace("'","&#039",$title[$i]);
					$title1 = '<font style="font-size:45pt;" color="#336AA2" face="Arial"><b>'.$title[$i].'</b></font><br>';
					$description[$i] = strip_tags(str_replace("'","&#039",$description[$i]));
					$content = '<font style="font-size:40pt;" color="#000000" face="Arial">'.$description[$i].'</font><p>';
					$pubdate1 = '<font style="font-size:40pt;" color="#336AA2" face="Arial"><i>'.$pubdate[$i].'</i></font><p>';
				}

				$ttfeed.=$title1.$content.$pubdate1."$$";
				$storynum++;
				$j++;
				if ($j > $numofstory-1)
				{
					break;
				}
			}
		}
		return $ttfeed;
	}

  include_once("../resource/agent.php");
  $agent->init(); 
  
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
cursor: url(images/stars.jpg), auto;
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


</script>

</body>

</html>
