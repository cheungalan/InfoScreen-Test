<?php

$uid = filter_var($_GET["uid"],FILTER_SANITIZE_STRING);
$numofstory=filter_var($_GET['numofstory'],FILTER_SANITIZE_STRING);
$lang=filter_var($_GET['lang'],FILTER_SANITIZE_STRING);

include_once "/var/www/wsja/admin/db_info.php";
$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);		
$sql = "select * from userinfo where name='".$uid."'";
$sth = $db->prepare($sql);
$sqlstatus = $sth->execute();

if ($sth->rowCount() <= 0 )
{
	print "Access Denied!";
	exit(1);
}
else
{
	$rows = $sth->fetch(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html>
<head>
<?php
//<script src="../wide/js/jquery-1.5.js"></script>
?>
<script src="/resource/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="../wide/js/jquery.formatCurrency-1.3.0.min.js"></script>
<style>

body {
	margin: 0px;
}

#bg {
	width:1280px;
	height:1024px;
	background:url('/wide/images/secondslide.jpg');
	background-repeat: no-repeat;
}

#stock {
	height: 238px;
	width: 1884px;
	border: 0px solid #000;
	position: absolute;
	margin-top:540px;
	margin-left:16px;
}

#wsjlogo {
	height:38px;
	background:url('/wide/images/Logo-CN_White.png');
	background-repeat: no-repeat;
	background-size: auto 38px;
	margin-top:6px;
	margin-left:78px;	
	width:300px;
	position:absolute;
}

#js_clock {
	color: #FFFFFF;
	font-family: Arial;
	font-size: 14pt;
	font-weight: bold;
	width:200px;
	height:31px;
	border: 0px solid #fff;
	position: absolute;
	margin-top:12px;
	margin-left:669px;
}

#js_date {
	color: #FFFFFF;
	font-family: Arial;
	font-size: 14pt;
	font-weight: bold;
	float: center;
	width:400px;
	height:31px;
	border: 0px solid #fff;	
	position: absolute;	
	margin-top:12px;
	margin-left:852px;		
}

#weather {
	width:150px;
	height:40px;
	border: 0px solid #fff;
	position: absolute;
	margin-top: 6px;
	margin-left: 1152px;	
}

#chart {
	height: 350px;
	width: 750px;
	position: absolute;
	margin-top: 140px;
	margin-left: 15px;
}

#chart img{
	width:750px;
	height:340px;
}

#index {
	margin-top: 90px;
	margin-left: 830px;
	position: absolute;
	border: 0px solid black;
	width: 670px;
	height: 595px;
}

.text_big {
	font-size:32px;
}

.text_small {
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
	margin-left: 220px;
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
	margin-top: 120px;
}

#change-value {
	margin-top: 120px;
	font-size:40px;	
}

#previous-close-text {
	margin-top: 170px;
}

#previous-close-value {
	margin-top: 170px;
	font-size:26px;
}

#open-text {
	margin-top: 220px;
}

#open-value {
	margin-top: 220px;
	font-size:26px;
}

#last-update-text {
	margin-top: 270px;
}

#last-update-value {
	margin-top: 270px;
	font-size: 18px;
}

#status{
	font-size : 30px;
	margin-top: 340px;
	margin-left: -100px;
	border: 0px solid black;
	height: 90px;
	width: 655px;
	text-align: center;	
	position: absolute;		
}


#hsi-name {
	font-size:30pt;
	font-family: Arial;
	font-weight:bold;
	border: 0px solid #000;
	margin-top: 5px;
	margin-left: 15px;
	line-height: 50pt;
	width: 640px;
	color:#005196;
	position: absolute;		
}



.label {
	bolder: 1px solid #000;
	margin-top:500px;
	height:20px;
	width:180px;
	font-size:24px;
	font-family:Arial;
	font-weight:bold;
	position: absolute;	
	
}

#symbol-txt {
	margin-left:50px;
}

#name-txt {
	margin-left:200px;
}

#index-value-txt {
	margin-left:560px;
}

#change-txt {
	margin-left:770px;
}

#prev-close-txt {
	margin-left:910px;
}

#open-txt {
	margin-left:1130px;
}

</style>
<script>
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
		window.setInterval(js_clock, 1000);
		fresh();
		
});

		function renderDisplay(data) {
			$indexVal.empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				$changeVal.empty().html('').append("<div>" + "<img src=\"../wide/images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				$changeVal.empty().html('').append("<div><img src=\"../wide/images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
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
		
					jQuery.getJSON("../resource/api/indices.php?indices=HK:HSI", {}, renderDisplay);
					var currentTime = new Date();
					var hours = currentTime.getHours();
					var minutes = currentTime.getMinutes();

					//jQuery("img[name=chart]").css({"width":"790px", "margin-top":"45px", "margin-left":"15px"}).attr("src", "../resource/include/chart.png?"+hours+":"+minutes).attr("width","793px");
					jQuery.get("../resource/api/status.php", {}, getMarketStatus);
					jQuery("#chart").load('/resource/include/chart.php?width=750&height=345&size=20');
<?php					
//					jQuery.get("../wide/google_chart.php?width=750&height=350", {}, getGoogleChart);
?>					

		}

		function getGoogleChart(data){
					var currentTime = new Date();
					var hours = currentTime.getHours();
					var minutes = currentTime.getMinutes();		
					jQuery("#chart img").attr("src", data); //790px
		}		
		
		function js_clock(){
			var clock_time = new Date();
			var clock_hours = clock_time.getHours();
			var clock_minutes = clock_time.getMinutes();
			var clock_seconds = clock_time.getSeconds();
			var theDay=clock_time.getDay();
			var theMonth=clock_time.getMonth();			

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
			 
			$clock_div.empty().html("").append("<div>" + clock_hours + ":" + clock_minutes + ":" + clock_seconds + " " + clock_suffix + "</div>");

			$date_div.empty().html("").append("<div>" + dtext[theDay] + ", " + mtext[theMonth] + " " + clock_time.getDate() + ", " + clock_time.getFullYear() + "</div>");
		}

</script>	
</head>
<body>
	<div id=bg>
		<div id=chart></div>
		<div id=index>
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
		<div id=stock><?php include_once "stock.php"; ?></div>
		<div id="wsjlogo"></div>		
		<div id="js_clock"></div>
		<div id="js_date"></div>
		<div id="weather"><?php include_once "weather_v2.php"; ?></div>
		<div id="symbol-txt" class="label">Symbol</div>
		<div id="name-txt"  class="label">Name</div>
		<div id="index-value-txt"  class="label">Index Value</div>
		<div id="change-txt"  class="label">Change</div>
		<div id="prev-close-txt"  class="label">Prev Close</div>
		<div id="open-txt"  class="label">Open</div>
	</div>
</body>
</html>