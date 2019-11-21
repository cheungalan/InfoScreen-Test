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

		$handle = fopen($link, "rb");
		$contents = '';
		while (!feof($handle)) {
		  $contents .= fread($handle, 8192);
		}
		fclose($handle);
		if ($charset=='GB' || $charset=='BIG5' )
		{
			$items = preg_split("/<item rdf:/", $contents, -1, PREG_SPLIT_NO_EMPTY);
		}
		else
		{
			$items = preg_split("/<item/", $contents, -1, PREG_SPLIT_NO_EMPTY);
		}		


		$pubdate=array();
		reset($items);
		$count=1;
		while (current($items))
		{
			$reg=array();
			$result = preg_match("/(<title>)(.*)(<\/title>)/",$items[$count],$reg);
		      $title[$count] = $reg[2];

			$reg=array();
			$result = preg_match("/(<link>)(.*)(<\/link>)/",$items[$count],$reg);
		      $hlink[$count] = $reg[2];

			$reg=array();
			$result = preg_match("/(<description>)(.*)(<\/description>)/",$items[$count],$reg);
		      $description[$count] = $reg[2];		
			$description[$count]=str_replace ("&lt;","<",$description[$count]);
			$description[$count]=str_replace ("&gt;",">",$description[$count]);
			$description[$count]=str_replace ("<p>","",$description[$count]);
			$description[$count]=str_replace ("</p>","",$description[$count]);
			$description[$count]=str_replace ("[地焊刁ら厨穝эRSS狝叭叫祅魁Chinese.WSJ.com秆冈薄]","",$description[$count]);
			$description[$count]=str_replace ("[《华尔街日报》全新改版RSS服务，请登录Chinese.WSJ.com了解详情]","",$description[$count]);
			$description[$count]=preg_replace("/(<img)(.*)(<\/img>)/","",$description[$count]);

			$reg=array();						
			$result = preg_match("/(<pubDate>)(.*)(<\/pubDate>)/",$items[$count],$reg);
		      $pubdate[$count] = $reg[2];
	
			$count++;
			next($items);
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
					$title1 = '<font style="font-size:45pt;" color="#336AA2" face="MingLiU" ><b>'.$title[$i].'</b></font><br>';
					$description[$i] = strip_tags(str_replace("'","&#039",$description[$i]));
					$content = '<font style="font-size:40pt; letter-spacing: 3px; line-height: 120%" color="#000000" face="MingLiU">'.$description[$i].'</font><p>';
					$pubdate1 = '<font style="font-size:40pt;" color="#336AA2" face="MingLiU"><i>'.$pubdate[$i].'</i></font><p>';

					$title1 =  iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $title1));
					$content = iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $content));
					$pubdate1 = iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $pubdate1));

				}
				else if ($charset == 'gb2312')
				{
					$title[$i] = str_replace("'","&#039",$title[$i]);
					$title1 = '<font style="font-size:45pt;" color="#336AA2" face="SimHei"><b>'.$title[$i].'</b></font><br>';
					$description[$i] = strip_tags(str_replace("'","&#039",$description[$i]));
					$content = '<font style="font-size:40pt; letter-spacing: 3px; line-height: 120%" color="#000000" face="SimHei">'.$description[$i].'</font><p>';
					$pubdate1 = '<font style="font-size:40pt;" color="#336AA2" face="SimHei"><i>'.$pubdate[$i].'</i></font><p>';

					$title1 =  iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $title1));
					$content = iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $content));
					$pubdate1 = iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $pubdate1));

				}
				else 
				{ 
					$title[$i] = str_replace("'","&#039",$title[$i]);
					$title1 = '<font style="font-size:45pt;" color="#336AA2" face="Arial"><b>'.$title[$i].'</b></font><br>';
					$description[$i] = strip_tags(str_replace("'","&#039",$description[$i]));
					$content = '<font style="font-size:40pt;" color="#000000" face="Arial">'.$description[$i].'</font><p>';
					$pubdate1 = '<font style="font-size:40pt;" color="#336AA2" face="Arial"><i>'.$pubdate[$i].'</i></font><p>';

					$title1 =  iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $title1));
					$content = iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $content));
					$pubdate1 = iconv($charset, "UTF-8", preg_replace('/[\r\n]+/m', "", $pubdate1));

				}

				//print "content[".$storynum."] = '".$title1."<br>".$content."<br>".$pubdate1."';\n";

				
				$ttfeed.=$title1.$content."$$";
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>News Info</title>

<style type="text/css">
 .tab { font-weight:bold;font-size:12px; text-align:center; font-family: "Arial", "Helvetica";}
 .tabb { font-weight:bold; font-size:14px; font-family: "Arial", "Helvetica"; text-align:center;}
 .tabbb { font-weight:bold; font-size:10px; font-family: "Arial", "Helvetica"; text-align:center;}
</style>

<style type="text/css"> 

/* external file "myvsstyle.css" begins */
A { text-decoration:none;}
A:link { color: blue }
A:visited { color: blue }
A:hover { color: red;background-color:#ffffff; }
 .tabmsg { font-size:12px; font-family: "Arial", "Helvetica", sans-serif; color:navy;}
 .stileupdn {font-weight:bold; font-size:8px; font-family: "Arial", "Helvetica, sans-serif"; text-align:center; color:blue;}
 .stileret {font-size:8px; font-family: "Arial", "Helvetica", sans-serif;}
/* end of external file "myvsstyle.css" */

</style> 

</head>

<body>
<script language="javascript" src="js/myvsbody.js"></script>
</body>

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
		slmg = new Array();
		for (i=0;i<temp.length;i++)
		{
			slmg[i]=temp[i] + ddate.toString();
		}

	if(firststart == false){
		vsscrollstart();
		firststart = true;
	}
	
	}
	 
	function timer()
	{
		setTimeout('runcalc()', 24000);
	}
</script>

</html>