<style>

body {
	margin: 0px;
}

.text {
	margin-left: 5px;
	font-size:20pt;
	font-weight:bold;
	position: absolute;	
}

.text_small {
	margin-left: 5px;
	font-size:16pt;
	font-weight:bold;
	position: absolute;	
}
.indexno {
	margin-left: 163px;
	font-size:20pt;
	font-weight:bold;	
	position: absolute;	
}

.change {
	margin-left: 295px;
	font-size:20pt;
	font-weight:bold;	
	position: absolute;	
} 

.row1 {
	margin-top:0px;
	color:#336AA2;
	font-family:Arial;
}

.row2 {
	margin-top:40px;
	color:#336AA2;	
	font-family:Arial;	
}

.row3 {
	margin-top:80px;
	color:#336AA2;	
	font-family:Arial;	
}

.row4 {
	margin-top:120px;
	color:#336AA2;	
	font-family:Arial;	
}

.row5 {
	margin-top:160px;
	color:#336AA2;	
	font-family:Arial;	
}

.row6 {
	margin-top:200px;
	color:#336AA2;	
	font-family:Arial;	
}

.row7 {
	margin-top:240px;
	color:#336AA2;	
	font-family:Arial;	
}

img {
	width: 10px;
	height: 20px;
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
		
		jQuery.getJSON('/resource/mdcjob/indexes/HSI.csv?' + date.getTime() , function(data){
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

		jQuery.getJSON('/resource/mdcjob/indexes/DJI.csv?' + date.getTime(), function(data){
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
		
		jQuery.getJSON('/resource/mdcjob/indexes/NAS.csv?' + date.getTime(), function(data){
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

		jQuery.getJSON('/resource/mdcjob/indexes/N225.csv?' + date.getTime(), function(data){
			jQuery("#N225-indexno").empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				jQuery("#N225-change").empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				jQuery("#N225-change").empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
			}else{
				jQuery("#N225-change").html(change).css("color","green");			
			}
		});
		
		jQuery.getJSON('/resource/mdcjob/indexes/SHA.csv?' + date.getTime(), function(data){
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
		
		jQuery.getJSON('/resource/mdcjob/indexes/US_SPX.csv?' + date.getTime(), function(data){
			jQuery("#SP500-indexno").empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				jQuery("#SP500-change").empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				jQuery("#SP500-change").empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
			}else{
				jQuery("#SP500-change").html(change).css("color","green");			
			}
		});

		jQuery.getJSON('/resource/mdcjob/indexes/UK_UKX.csv?' + date.getTime(), function(data){
			jQuery("#FTSE-indexno").empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				jQuery("#FTSE-change").empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				jQuery("#FTSE-change").empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
			}else{
				jQuery("#FTSE-change").html(change).css("color","green");			
			}
		});		

		jQuery.getJSON('/resource/mdcjob/indexes/XX_SXXP.csv?' + date.getTime(), function(data){
			jQuery("#STOXX-indexno").empty().html('').append("<div>"+data.last+"</div>");

			var change = parseFloat(data.change);
			if(change >0){
				jQuery("#STOXX-change").empty().html('').append("<div>" + "<img src=\"images/arrowup.png\">" + change + "</div>").css("color","green");
			}else if(change < 0){
				jQuery("#STOXX-change").empty().html('').append("<div><img src=\"images/arrowdown.png\">" + data.change.replace("-", "") + "</div>").css("color","red");
			}else{
				jQuery("#STOXX-change").html(change).css("color","green");			
			}
		});			
		
	}	

</script>
<div id=index>
	<div id=HSI-text class="text row1" style="display:none">HSI</div>
	<div id=HSI-indexno class="indexno row1"  style="display:none"></div>
	<div id=HSI-change class="change row1" style="display:none"></div>
	
	<div id=DJI-text class="text row1">DJI</div>
	<div id=DJI-indexno class="indexno row1"></div>
	<div id=DJI-change class="change row1"></div>
	
	<div id=NAS-text class="text row2">NASDAQ</div>
	<div id=NAS-indexno class="indexno row2"></div>
	<div id=NAS-change class="change row2"></div>
	
	<div id=N225-text class="text row3">NIKKEI</div>
	<div id=N225-indexno class="indexno row3"></div>
	<div id=N225-change class="change row3"></div>
	
	<div id=SHA-text class="text row4">SH Comp</div>
	<div id=SHA-indexno class="indexno row4"></div>
	<div id=SHA-change class="change row4"></div>	

	<div id=SP500-text class="text row5">S&P 500</div>
	<div id=SP500-indexno class="indexno row5"></div>
	<div id=SP500-change class="change row5"></div>

	<div id=FTSE-text class="text row6">FTSE 100</div>
	<div id=FTSE-indexno class="indexno row6"></div>
	<div id=FTSE-change class="change row6"></div>
	
	<div id=STOXX-text class="text row7">STOXX 600</div>
	<div id=STOXX-indexno class="indexno row7"></div>
	<div id=STOXX-change class="change row7"></div>	
</div>	