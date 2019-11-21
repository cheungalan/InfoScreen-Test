<?php

error_reporting(E_ALL & ~E_NOTICE);

include_once "/var/www/wsja/admin/db_info.php";

$username	= filter_var($_GET["username"],FILTER_SANITIZE_STRING);
$numofstory	= filter_var($_GET['numofstory'],FILTER_SANITIZE_STRING);
$lang		= filter_var($_GET['lang'],FILTER_SANITIZE_STRING);

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);

// Select User Info
	$sql = "select * from userinfo where name=:username";

	$sth = $db->prepare($sql);
	$sth->bindValue(':username', $username);
	$status = $sth->execute();

	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$ticker = filter_var($row['ticker'],FILTER_SANITIZE_STRING);
		$weather = filter_var($row['weather'],FILTER_SANITIZE_STRING);
		$stock_page = "stock_dj.php";
	}


function weather_calc() {
	$type = $_GET["type"];
	$link = "http://www.weather.gov.hk/textonly/forecast/englishwx.htm";

	//Temperature
	$contents = file_get_contents($link); 
	$result = preg_match("/(AIR TEMPERATURE : )(.*)( DEGREES CELSIUS\nRELATIVE HUMIDITY)/i", $contents, $items);
	$temperature = $items[2]."&#176;C";

	//pic
	$result = preg_match("/(WEATHER CARTOON : NO.)(.*)( -)/i", $contents, $items);
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

<HTML>
<HEAD>
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<script src="/resource/js/jquery-3.3.1.min.js"></script>
<style>
<!--
BODY{
CURSOR: url(../wide/blank.cur);
}
-->
</style>

<TITLE>TV_1280x768</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
</HEAD>
<BODY bgcolor="#000000"  MARGINWIDTH=0 MARGINHEIGHT=0 topmargin="0" leftmargin="0">
<!-- ImageReady Slices (TV_1280x768.jpg) -->
<TABLE WIDTH=1280 BORDER=0 CELLPADDING=0 CELLSPACING=0 background="../wide/images/TV_1280x768.jpg" style="border-collapse: collapse" bordercolor="#00FF00" height="768" bgcolor="#000000">
	<TR>
		<TD width="18" height="16">
			&nbsp;</TD>
		<TD width="627" height="16">
			&nbsp;</TD>
		<TD width="152" height="16">
			&nbsp;</TD>
		<TD width="53" height="16">
			&nbsp;</TD>
		<TD width="18" height="16">
			&nbsp;</TD>
		<TD width="292" height="16">
			&nbsp;</TD>
		<TD width="106" height="16">
			&nbsp;</TD>
		<TD width="14" height="16">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="29">
			&nbsp;</TD>
		<TD width="627" height="29" align="center">
			<div style="float: left; margin-left: 64px;margin-top:-10px;">
				<img src="/wide/images/Logo-CN_White.png" style="height: 38px;">
			</div>		
		</TD>
		<TD width="152" height="29" style="color: #FFFFFF; font-family: Arial; font-size: 14pt; font-weight: bold; float: right">
		<div id="js_clock" style="float: center">
		<script language="javascript">
		function js_clock(){
			var clock_time = new Date();
			var clock_hours = clock_time.getHours();
			var clock_minutes = clock_time.getMinutes();
			var clock_seconds = clock_time.getSeconds();
			var clock_suffix = "AM";
			if (clock_hours > 11){
				clock_suffix = "PM";
				clock_hours = clock_hours - 12;
			}
			if (clock_hours == 0){
				clock_hours = 12;
			}
			if (clock_hours < 10){
				clock_hours = "0" + clock_hours;
			}
			if (clock_minutes < 10){
				clock_minutes = "0" + clock_minutes;
			}
			if (clock_seconds < 10){
				clock_seconds = "0" + clock_seconds;
			}
			var clock_div = document.getElementById('js_clock');
			clock_div.innerHTML = clock_hours + ":" + clock_minutes + ":" + clock_seconds + " " + clock_suffix;
			setTimeout("js_clock()", 1000);
		}
		js_clock();
		</script>
		</div>
			</TD>
		<TD width="363" height="29" colspan="3" align="center" style="font-weight: bold">
			<div id="js_date" width="363" height="29" style="color: #FFFFFF; font-family: Arial; font-size: 14pt; float: center;  margin-top:-10px;">
			<script language="javascript">
			function js_date(){
				var digital = new Date();
				var theDay=digital.getDay();
				var theMonth=digital.getMonth();
				var dtext=new Array(30);
				dtext[0]="Sunday";
				dtext[1]="Monday"; 
				dtext[2]="Tuesday";
				dtext[3]="Wednesday";
				dtext[4]="Thursday";
				dtext[5]="Friday";
				dtext[6]="Saturday";
				var mtext=new Array(30);
				mtext[0]="January";
				mtext[1]="February";
				mtext[2]="March";
				mtext[3]="April";
				mtext[4]="May";
				mtext[5]="June";
				mtext[6]="July";
				mtext[7]="August";
				mtext[8]="September";
				mtext[9]="October";
				mtext[10]="November";
				mtext[11]="December";
				dispDate = dtext[theDay] + ", " + mtext[theMonth] + " " + digital.getDate() + ", " + digital.getFullYear();
				var date_div = document.getElementById('js_date');
				date_div.innerHTML = dispDate;
				setTimeout("js_date()", 1000);	
			}
			js_date();
			</script>
			</div>	
			</TD>
		<TD width="106" height="29" align="right">
	     	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="80" id="AutoNumber2">
<tr>
<td width="60" height="25" align="center">
<?php include_once "weather_v2.php"; ?>
<!--
<font style="font-family:Arial; font-size:20px;color:#FFFFFF;">
<p align="right">
<div id = "a"></div>
</td>
<td align="center">
<div id = "b"></div>
</font>
-->
</td>
</tr>
</table>
</TD>
		<TD width="14" height="29">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="58"></TD>
		<TD width="627" height="58"></TD>
		<TD width="152" height="58"></TD>
		<TD width="53" height="58"></TD>
		<TD width="18" height="58"></TD>
		<TD width="292" height="58"></TD>
		<TD width="106" height="58"></TD>
		<TD width="14" height="58"></TD>
	</TR>
	<TR>
		<TD width="18" height="40">
			&nbsp;</TD>
		<TD width="627" height="40">
			&nbsp;</TD>
		<TD width="152" height="40">
			&nbsp;</TD>
		<TD width="53" height="40">
			&nbsp;</TD>
		<TD width="18" height="40">
			&nbsp;</TD>
		<TD width="398" height="155" colspan="2" rowspan="4" align="center">
		   <?php
			print "<iframe ";
			print "	src='../wide/".$stock_page."?username=".$username."'" ;
			print "	width='388' height='155' ";
			print	"	scrolling='no' ";
			print "	frameborder='0'";
			print "	marginwidth='0' marginheight='0' name='I1'>";
			print "</iframe>";
		   ?>
		</TD>
		<TD width="14" height="40">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="40">
			&nbsp;</TD>
		<TD width="832" height="437" colspan="3" rowspan="5" align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="832" height="437">
  <tr>
    <td width="100%" height="10"></td>
  </tr>
  <tr>
    <td width="100%" height="427">
		<div style="position:absolute;background:#000000;width:830; height:510;left:18; top:165;margin:0px;overflow:hidden;padding:0px;border-style:solid; border-width:0px; border-color:#fffff;">
			<iframe 
				<?php
					print 'src="../wide/news.php?username='.$username.'&lang='.$lang.'&numofstory='.$numofstory.'"'; 
				?>
                width="832" height="510" 
				scrolling="no" 
				frameborder="0"
				marginwidth="0" marginheight="0" name="I3">
			</iframe>
		</div>
	</td>
  </tr>
</table>
				</TD>
		<TD width="18" height="40">
			&nbsp;</TD>
		<TD width="14" height="40">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="39">
			&nbsp;</TD>
		<TD width="18" height="39">
			&nbsp;</TD>
		<TD width="14" height="39">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="36">
			&nbsp;</TD>
		<TD width="18" height="36">
			&nbsp;</TD>
		<TD width="14" height="36">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="16">
			&nbsp;</TD>
		<TD width="18" height="16">
			&nbsp;</TD>
		<TD width="292" height="16">
			&nbsp;</TD>
		<TD width="106" height="16">
			&nbsp;</TD>
		<TD width="14" height="16">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="306">
			&nbsp;</TD>
		<TD width="18" height="306">
			&nbsp;</TD>
		<TD width="398" height="469" colspan="2" rowspan="2" align="center"><iframe 
				<?php
					print 'src="../wide/media.php?username='.$username.'"'; 
				?>
            width="398" height="469" 
				scrolling="no" 
				frameborder="0"
				marginwidth="0" marginheight="0" name="I4"></iframe></TD>
		<TD width="14" height="306">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="163">
			&nbsp;</TD>
		<TD width="832" height="163" colspan="3">
			&nbsp;</TD>
		<TD width="18" height="163">
			&nbsp;</TD>
		<TD width="14" height="163">
			&nbsp;</TD>
	</TR>
	<TR>
		<TD width="18" height="22">
			&nbsp;</TD>
		<TD width="627" height="22">
			&nbsp;</TD>
		<TD width="152" height="22">
			&nbsp;</TD>
		<TD width="53" height="22">
			&nbsp;</TD>
		<TD width="18" height="22">
			&nbsp;</TD>
		<TD width="292" height="22">
			&nbsp;</TD>
		<TD width="106" height="22">

			&nbsp;</TD>
		<TD width="14" height="22">
			&nbsp;</TD>
	</TR>
</TABLE>
<!-- End ImageReady Slices -->
</BODY>
</HTML>

<div style="position:absolute;width:830; height:50;left:18; top:695;margin:0px;overflow:hidden;padding:0px;border-style:solid; border-width:0px; border-color:#fffff;">
<?php
print "<iframe ";
print "	src='../wide/".$ticker."'";
print "      width='832' height='50' ";
print "	scrolling='no' ";
print "	frameborder='0'";
print "	marginwidth='0' marginheight='0' name='I3'>";
print "</iframe>";
?>
</div>
