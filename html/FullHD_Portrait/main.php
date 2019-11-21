<?php

$username = filter_var($_GET["username"],FILTER_SANITIZE_STRING);
$numofstory=filter_var($_GET['numofstory'],FILTER_SANITIZE_STRING);
$lang=filter_var($_GET['lang'],FILTER_SANITIZE_STRING);

print $username;
exit(1);

// connect database

	include_once "/var/www/wsja/admin/db_info.php";

	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);		
	
/*	
	$db = mysql_connect($dbserver, $dbuser, $dbpass);
	mysql_select_db("infoscreen", $db);
*/

// Select User Info
	$sql = "select * from userinfo where name=:username";
	$sth = $db->prepare($sql);
	$sth->bindValue(':username', $username);
	$sqlstatus = $sth->execute();


	if ($sth->rowCount() <= 0 )
	{
		print "Access Denied!";
		exit(1);
	}
	else
	{
		$rows = $sth->fetch(PDO::FETCH_ASSOC);
		$ticker = $rows['ticker'];
		$weather = $rows['weather'];
		$stock_page = $rows['stock_page'];

	}	

/*
	$username = filter_var($_GET['username'],FILTER_SANITIZE_STRING);
	$query = "select * from userinfo where name='".$username."'";
	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result))
	{
		$ticker = $row['ticker'];
		$weather = $row['weather'];
		$stock_page = $row['stock_page'];
	}
*/

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
<?php
//<script src="js/jquery-1.5.js"></script>
?>
<script src="/resource/js/jquery-3.3.1.min.js"></script>
<script src="js/jquery.formatCurrency-1.3.0.min.js"></script>

<script>
//weather
	function weather_runcalc() {
		agent.call('','weather_calc','weather_callback');
		timer();
	}

	function weather_callback(str) {
		string=str.split("***")
		var host_a = document.getElementById('weather_a');
		if(document.getElementById('parent_a'))
		{
			var parent_a = document.getElementById('parent_a');
			host_a.removeChild(parent_a);
		}
		var parent_a = document.createElement('div');
		parent_a.id = "parent_a";
		host_a.appendChild(parent_a);
		document.getElementById('weather_a').innerHTML = string[0];

		var host_b = document.getElementById('weather_b');
		if(document.getElementById('parent_b'))
		{
			var parent_b = document.getElementById('parent_b');
			host_b.removeChild(parent_b);
		}
		var parent_b = document.createElement('div');
		parent_b.id = "parent_b";
		host_b.appendChild(parent_b);
		document.getElementById('weather_b').innerHTML = string[1];
	}

	function timer() {
		setTimeout("weather_runcalc()", 600000);
	}

var $indexVal, $changeVal, $prevCloseVal, $openVal, $lastUpdateVal, $clock_div, $date_div, $market;
var dtext=new Array(30);
var mtext=new Array(30);

jQuery(document).ready(function(){
	$indexVal = jQuery("#index-value");
	$changeVal = jQuery("#change-value");
	$prevCloseVal = jQuery("#previous-close-value");
	$openVal = jQuery("#open-value");
	$lastUpdateVal = jQuery("#last-update-value");
	$clock_div = jQuery('#js_clock');
	$date_div = jQuery('#js_date');
	$market = jQuery('#status');

	dtext[0]="Sunday";
	dtext[1]="Monday"; 
	dtext[2]="Tuesday";
	dtext[3]="Wednesday";
	dtext[4]="Thursday";
	dtext[5]="Friday";
	dtext[6]="Saturday";

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
					
	window.setInterval(fresh, 1*60*1000);
	fresh();
});	

	function renderDisplay(data) {
		$indexVal.empty().html('').append("<div>"+data.last+"</div>");

		var change = parseFloat(data.change);
		if(change >0){
			$changeVal.empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
		}else if(change < 0){
			$changeVal.empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
		}else{
			$changeVal.html(change).css("color","green");			
		}
		$prevCloseVal.html(data.prevclose);
		$openVal.html(data.open);						
		$lastUpdateVal.html(data.lastupdate);		
	}

	function getMarketStatus(data){
		$market.empty().html('').html(data.replace("5", "5"));
	}
	
	function fresh(){
		jQuery.getJSON("../resource/mdcjob/indexes/HSI.csv", {}, renderDisplay);
		var currentTime = new Date();
		var hours = currentTime.getHours();
		var minutes = currentTime.getMinutes();

		//jQuery("img[name=chart]").css({"width":"790px", "margin-top":"45px", "margin-left":"15px"}).attr("src", "../resource/include/chart.png?"+hours+":"+minutes).attr("width","793px");
		jQuery.get("../resource/mdcjob/market/status.csv", {}, getMarketStatus);
		jQuery.get("google_chart.php?width=750&height=350", {}, getGoogleChart);									
	}

	function getGoogleChart(data){
		var currentTime = new Date();
		var hours = currentTime.getHours();
		var minutes = currentTime.getMinutes();		
		jQuery("#chart img").attr("src", data); //790px
	}		

</script>

<HTML>
<HEAD>
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">

<style>
BODY{
	cursor: none;
	background-image: url("images/TV_1080x1920.jpg");
	background-repeat: no-repeat;
	height:1920px;
	weight:1080px;
	overflow-x:hidden;
}
#js_clock {
	margin-top:20px;
	margin-left:460px;
	color:#FFFFFF;
	font-family:Arial;
	font-size:14pt;
	font-weight:bold;
	float:left;
	
}

#js_date{
	margin-top:20px;
	margin-left:70px;
	color:#FFFFFF;
	font-family:Arial;
	font-size:14pt;
	font-weight:bold;
	float:left;
}

#js_weather{
	margin-top:20px;
	margin-left:975px;
	color:#FFFFFF;
	font-family:Arial;
	font-size:14pt;
	font-weight:bold;
	position:absolute;
	float:left;
	overflow-x:hidden;
}

#weather_a{
	float:left;
	margin-left:5px;
}

#weather_b{
	float:left;
	margin-top:-4px;
	margin-left:5px;
}

#dj_news{
	position:absolute;
	background:#000000;
	width:630; height:680;
	left:18; 
	top:165;
	margin:0px;
	overflow:hidden;
	padding:0px;
	border-style:solid; 
	border-width:0px; 
	border-color:#fffff;
}

#chart {
	height: 465px;
	width: 640px;
	position: absolute;
	margin-top: 875px;
	margin-left: 15px;
}

#chart img{
	width:640px;
	height:465px;
}

#hsi_index {
	margin-top: 110px;
	margin-left: 670px;
	position: absolute;
	border: 0px solid black;
	width: 398px;
	height: 556px;
}

.text_big{
	font-size:32px;
}

.text_small{
	font-size:24px;
}

.text {
	border: 0px solid black;
	width: 300px;
	height: 60px;
	margin-left: 5px;
	position: absolute;
	font-family: Arial;
	font-weight:bold;
	line-height:60px;
}

.value {
	border: 0px solid black;
	width: 345px;
	height: 60px;
	margin-left: 210px;
	text-align:left;
	float:left;
	position: absolute;	
	font-family: Arial;
	font-weight:bold;	
	color:#005196;
	line-height:60px;	
}

#index-text {
	margin-top: 70px;
}

#index-value {
	margin-top: 70px;
	font-size:40px;	
}

#change-text {
	margin-top: 130px;
}

#change-value {
	margin-top: 130px;
	font-size:40px;	
}

#previous-close-text {
	margin-top: 190px;
}

#previous-close-value {
	margin-top: 190px;
	font-size:30px;
}

#open-text {
	margin-top: 245px;
}

#open-value {
	margin-top: 245px;
	font-size:30px;
}

#last-update-text {
	margin-top: 300px;
}

#last-update-value {
	margin-top: 300px;
	font-size: 18px;
}

#status{
	margin-top: 370px;
	margin-left: -130px;
	border: 0px solid black;
	height: 90px;
	width: 655px;
	text-align: center;	
	position: absolute;		
	font-size:30px;
}


#hsi-name {
	font-size:30pt;
	font-family: Arial;
	font-weight:bold;
	border: 0px solid #000;
	margin-top: 5px;
	margin-left: 11px;
	line-height: 50pt;
	width: 640px;
	color:#005196;
	position: absolute;		
}



.label {
	bolder: 1px solid #000;
	margin-top:160px;
	height:20px;
	width:180px;
	font-size:24px;
	font-family:Arial;
	font-weight:bold;
	position: absolute;	
	
}

#symbol-txt {
	margin-left:10px;
}

#name-txt {
	margin-left:115px;
}

#index-value-txt {
	margin-left:465px;
}

#change-txt {
	margin-left:655px;
}

#prev-close-txt {
	margin-left:800px;
}

#open-txt {
	margin-left:974px;
}

#hsi_stock {
	border: 0px solid #000;
	margin-top:520px;
	margin-left:670px;
	float:left;
}

#id_media {
	position: absolute;
	margin-top: 873px;
	margin-left: 667px;

}

#stock_list_header {
	height: 238px;
	width: 1884px;
	border: 0px solid #000;
	position: absolute;
	margin-top:1210px;
	margin-left:16px;
}

#stock_list{
	position:absolute;
	margin-top:1410px;
}

</style>



<TITLE>TV_1080x1920</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
</HEAD>
<?php
	if ($weather == 1)
	{ 
		print '<BODY onload="weather_runcalc()" bgcolor="#000000"  MARGINWIDTH=0 MARGINHEIGHT=0 topmargin="0" leftmargin="0">';
	}
	else
	{ 
		print '<BODY bgcolor="#000000"  MARGINWIDTH=0 MARGINHEIGHT=0 topmargin="0" leftmargin="0">';
	}
?>
<!-- ImageReady Slices (TV_1080x1920.jpg) -->
<div id="js_clock">
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

<div id="js_date">
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

<div id="js_weather">
	<div id="weather_a"></div>
	<div id="weather_b"></div>
</div>

<div id="dj_news">
	<iframe 
		<?php
			print 'src="news.php?username='.$username.'&lang='.$lang.'&numofstory='.$numofstory.'"'; 
		?>
		width="630" height="680" 
		scrolling="no" 
		frameborder="0"
		marginwidth="0" marginheight="0" name="I3">
	</iframe>
</div>

<div id=hsi_index>
	<div id=hsi-name>HANG SENG INDEX</div>
	<div id=index-text class="text text_big">Index Value:</div>
	<div id=index-value class="value"></div>
	<div id=change-text class="text text_big">Change:</div>
	<div id=change-value class="value"></div>
	<div id=previous-close-text class="text text_small">Prev Close:</div>
	<div id=previous-close-value class="value"></div>
	<div id=open-text class="text text_small">Open:</div>
	<div id=open-value class="value"></div>
	<div id=last-update-text class="text text_small">Last Update:</div>
	<div id=last-update-value class="value"></div>
	<div id=status></div>
</div>	

<div id="hsi_stock">
   <?php
	print "<iframe ";
	print "	src='stock_dj.php?username=".$username."'" ;
	print "	width='388' height='280' ";
	print	"	scrolling='no' ";
	print "	frameborder='0'";
	print "	marginwidth='0' marginheight='0' name='I1'>";
	print "</iframe>";
   ?>
</div>

<div id="chart">
	<img>
</div>

<div id="id_media">
	<iframe 
		<?php
			print 'src="../wide/media.php?username='.$username.'"'; 
		?>
		width="398" height="469" 
		scrolling="no" 
		frameborder="0"
		marginwidth="0" marginheight="0" name="I4">
	</iframe>
</div>

<div id="stock_list_header">
	<div id="symbol-txt" class="label">Symbol</div>
	<div id="name-txt"  class="label">Name</div>
	<div id="index-value-txt"  class="label">Index Value</div>
	<div id="change-txt"  class="label">Change</div>
	<div id="prev-close-txt"  class="label">Prev Close</div>
	<div id="open-txt"  class="label">Open</div>
</div>
<div id="stock_list">
	<?php include_once "stock.php"; ?>
</div>

</BODY>
</HTML>



