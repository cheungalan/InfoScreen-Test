<?php

	$allow_hosts = array(
						"infoscreen.wsj-asia.com", 
						"infoscreen2.wsj-asia.com", 
						"52.192.249.35", 
						"52.198.220.230"
						);
	$referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
	
	if (!in_array($referer, $allow_hosts))
	{
		//print "Not Allow!";
		exit(1);
	}
	
	date_default_timezone_set('Asia/Hong_Kong');
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	
	$sql = "select max(indexvalue) as max, min(indexvalue) as min from hsi_indices order by lastupdate";
	$sth = $db->prepare($sql);
	$status = $sth->execute();
	
	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$vmax = filter_var($row['max'],FILTER_SANITIZE_STRING) + 1;
		$vmin = filter_var($row['min'],FILTER_SANITIZE_STRING) - 1;
	}
	
	define('MAX_STEPS', 6);
	$step_size = ceil(($vmax - $vmin) / MAX_STEPS / 10) * 10;
	
	$vmin = floor($vmin / $step_size) * $step_size;
	$vmax = ceil($vmax / $step_size) * $step_size;	
	
	$htick = "";
	for ($i= $vmin; $i<=$vmax; $i += $step_size)
	{
		$htick .= $i."," ;
	}
	
	$width = filter_var($_GET['width'],FILTER_SANITIZE_STRING);
	$height = filter_var($_GET['height'],FILTER_SANITIZE_STRING);
	$size = filter_var($_GET['size'],FILTER_SANITIZE_STRING);
?> 

    <!--Load the AJAX API-->
<?php	
	if ($referer == "")
	{
		print '	<script src="/resource/js/jquery-3.3.1.min.js"></script>'."\r\n";
		print '	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>'."\r\n";
	}
?>	
	<script type="text/javascript">
		google.charts.load('current', {packages: ['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {  
		  // Create the data table.
			  var data = new google.visualization.DataTable();
			  data.addColumn('number', 'Time');
			  data.addColumn('number', 'Indexes');

			  stockdata = JSON.parse("[" + update() + "]")
			  data.addRows(stockdata);

 
			 // Set chart options
			  var options = {
							 'width':<?php print $width; ?>,
							 'height':<?php print $height; ?>,
							 'chartArea': {left:100, bottom:40,'width': '90%', 'height': '85%'},
							 'legend': 'none',
							 'fontSize' : <?php print $size; ?>,
							 'lineWidth' : 2,
							 'hAxis': { gridlines: { count:1, color: 'f7f2f2'},
										ticks: [
													{v:29, f:'10:00'},
													{v:59, f:'11:00'},
													{v:89, f:'12:00'},
													{v:119, f:'13:00'},
													{v:149, f:'14:00'},
													{v:179, f:'15:00'},
													{v:209, f:'16:00'},
													{v:229, f:''},
												],
									  },
							 'enableInteractivity' : false, 
							 'colors': ['3333dd'],
							 'vAxis' : { gridlines: { count: 1,color: 'f7f2f2'},
										 ticks: [ <?php print $htick; ?>],
										 format: '#####',
										 baseline: <?php print ceil(($vmin-$step_size)/10)*10;
										 baselineColor: 'black'
										 ?>,
									   },
							};

			  // Instantiate and draw our chart, passing in some options.
			  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			  chart.draw(data, options);
			}

		function update(){
			var date = new Date();
			var scriptUrl = '/resource/api/timedata4.php?' + date.getTime();
			 $.ajax({
				url: scriptUrl,
				type: 'get',
				dataType: 'html',
				async: false,
				success: function(data) {
					result = data;
				} 
			 });
			 return result;
		}
		
	</script>	

	<!--Div that will hold the pie chart-->
	<div id="chart_div" style="width:<?php print $width; ?>; height:<?php print $height; ?>"></div>
