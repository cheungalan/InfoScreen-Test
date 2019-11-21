<?php

$uid = filter_var($_GET["uid"],FILTER_SANITIZE_STRING);

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

<style>

body {
	margin: 0px;
}

.text {
	margin-left: 10px;
	font-size:30pt;
	font-weight:bold;
	position: absolute;	
}

.indexno {
	margin-left: 240px;
	font-size:30pt;
	font-weight:bold;	
	position: absolute;	
}

.change {
	margin-left: 410px;
	font-size:30pt;
	font-weight:bold;	
	position: absolute;	
} 

.row1 {
	margin-top:0px;
	color:#336AA2;
	font-family:Arial;
	white-space:nowrap;
}

.row2 {
	margin-top:50px;
	color:#336AA2;	
	font-family:Arial;	
}

.row3 {
	margin-top:100px;
	color:#336AA2;	
	font-family:Arial;	
}

.row4 {
	margin-top:150px;
	color:#336AA2;	
	font-family:Arial;	
}


</style>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 6.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Info Page</title>
<?php
//<script src="js/jquery-1.5.js"></script>
?>
<script src="/resource/js/jquery-3.3.1.min.js"></script>
<script src="js/jquery.formatCurrency-1.3.0.min.js"></script>
<script type=text/javascript>
	jQuery(document).ready(function(){
		update();
		window.setInterval(update, 3*60*1000);
	});
	
	function update(){
		var date = new Date();
		jQuery.getJSON('/resource/api/indices.php?indices=HK:HSI&' + date.getTime(), function(data){
			jQuery("#HSI-indexno").empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				jQuery("#HSI-change").empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				jQuery("#HSI-change").empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
			}else{
				jQuery("#HSI-change").html(change).css("color","green");			
			}
		});

		jQuery.getJSON('/resource/api/indices.php?indices=DJI&' + date.getTime(), function(data){
			jQuery("#DJI-indexno").empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				jQuery("#DJI-change").empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				jQuery("#DJI-change").empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
			}else{
				jQuery("#DJI-change").html(change).css("color","green");			
			}
		});
		
		jQuery.getJSON('/resource/api/indices.php?indices=NASDAQ&' + date.getTime(), function(data){
			jQuery("#NAS-indexno").empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				jQuery("#NAS-change").empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				jQuery("#NAS-change").empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
			}else{
				jQuery("#NAS-change").html(change).css("color","green");			
			}
		});
		
		jQuery.getJSON('/resource/api/indices.php?indices=CN:SHCOMP&' + date.getTime(), function(data){
			jQuery("#SHA-indexno").empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				jQuery("#SHA-change").empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				jQuery("#SHA-change").empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
			}else{
				jQuery("#SHA-change").html(change).css("color","green");			
			}
		});		

	}	

</script>
<div id=index>
	<div id=HSI-text class="text row1">HSI</div>
	<div id=HSI-indexno class="indexno row1"></div>
	<div id=HSI-change class="change row1"></div>
	<div id=DJI-text class="text row2">DJI</div>
	<div id=DJI-indexno class="indexno row2"></div>
	<div id=DJI-change class="change row2"></div>
	<div id=NAS-text class="text row3">NASDAQ</div>
	<div id=NAS-indexno class="indexno row3"></div>
	<div id=NAS-change class="change row3"></div>
	<div id=SHA-text class="text row4">SH Comp</div>
	<div id=SHA-indexno class="indexno row4"></div>
	<div id=SHA-change class="change row4"></div>			
</div>	