<script>
var $weather_temp, $weather_pic;

jQuery(document).ready(function(){

	$weather_temp = jQuery("#weather_temp");
	$weather_pic = jQuery("#weather_pic");
	
	window.setInterval(get_weather_job, 30*60*1000);	
	get_weather_job();
});

	function get_weather(data){
		$weather_temp.empty().html('').html(data.temperature + "&#176;C"); 
		$weather_pic.empty().html('').html("<img src=//www.weather.gov.hk/images/wxicon/pic"+ data.pic + ".png>");
	}
	
	function get_weather_job(){
		jQuery.getJSON("/resource/api/weather.php", {}, get_weather);
	}


</script>
<style>
#weather_temp {
	font-family:Arial;
	font-size:26pt;
	color:#FFFFFF;
	width:80px;
	height:32px;
	text-align:right;
	margin-top: -6px;
}

#weather_pic {
	font-family:Arial;
	font-size:26px;
	color:#FFFFFF;
}

#weather_pic img {
	width:32px;
	height:32px;
	border:0px;
}
</style>
<table>
<tr>
<td>
	<div id = "weather_temp"></div>
</td>
<td align="center">
	<div id = "weather_pic"></div>
</td>
</tr>
</table>
 