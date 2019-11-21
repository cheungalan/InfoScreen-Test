<?php

	define('TIMEDATA_FILE', '/var/www/wsja/html/resource/timedata3.csv');
	#define('TIMEDATA_FILE', 'timedata.csv');

	define('USE_EXTENDED_ENCODE', true);
	define('TIME_START', 9);
	define('TIME_END', 16.5);
	define('TIME_FREQUENCY', 2);																									# in minutes
	
	define('CHART_WIDTH', 	isset($_GET['width']) ? intval($_GET['width']) : 900);
	define('CHART_HEIGHT', 	isset($_GET['height']) ? intval($_GET['height']) : 280);
	
	define('MAX_STEPS', 6);

	define('TIME_1000', (10-TIME_START) * 60 / TIME_FREQUENCY);
	define('TIME_1100', (11-TIME_START) * 60 / TIME_FREQUENCY);
	define('TIME_1200', (12-TIME_START) * 60 / TIME_FREQUENCY);
	define('TIME_1300', (13-TIME_START) * 60 / TIME_FREQUENCY);
	define('TIME_1400', (14-TIME_START) * 60 / TIME_FREQUENCY);
	define('TIME_1500', (15-TIME_START) * 60 / TIME_FREQUENCY);
	define('TIME_1600', (16-TIME_START) * 60 / TIME_FREQUENCY);			
	
	# Program starts
	$num_data_points = (TIME_END - TIME_START) * 60 / TIME_FREQUENCY;
	
	$external_data = file_get_contents(TIMEDATA_FILE);
	$external_data = str_getcsv(preg_replace('/,$/', '', $external_data));

	$data = array_fill(0, $num_data_points, -1);
	$data = array_replace($data, $external_data);
	$data = array_slice($data, 0, $num_data_points);

	# horizontal axis
	$timeline = array_fill(0, $num_data_points, '');
	$timeline[TIME_1000 - 1] = '10:00';
	$timeline[TIME_1100 - 1] = '11:00';
	$timeline[TIME_1200 - 1] = '12:00';
	$timeline[TIME_1300 - 1] = '13:00';
	$timeline[TIME_1400 - 1] = '14:00';
	$timeline[TIME_1500 - 1] = '15:00';
	$timeline[TIME_1600 - 1] = '16:00';
	
	# vertical axis
	$min = min($external_data) - 1;
//	$min = 0;
	$max = max($external_data) + 1;
	$step_size = ceil(($max - $min) / MAX_STEPS / 10) * 10;
	$min = floor($min / $step_size) * $step_size;
	$max = ceil($max / $step_size) * $step_size;

	
	$chart_parameters = array(
		'cht' => 'lc',															# line chart
		'chs' => CHART_WIDTH . 'x' . CHART_HEIGHT, 								# dimensions

		'chxt' => 'x,y',                                          				# axes
		'chxr' => implode('|', array(
			implode(',', array(
				0,                       										# axis index
				0,                             									# start
				$num_data_points,         										# end
				1 	                             								# step
			)),
			implode(',', array(
				'1',                             								# axis index
				$min,       													# start
				$max,      														# end
				$step_size                       								# step
			))
		)),
		#'chds' => implode(',', array($min, $max)), 							# data scaling

		'chco' => '3333dd',                  									# color of line chart
		'chxs' => implode('|', array(          									# axis colors
			implode(',', array( 												
				0,                                           					# axis index
				444444, 														# color
				20,                                         					# font size
				0,                                           					# alignment = center
				'lt'                                            				# line + tick mark
			)),
			implode(',', array(                          						
				1,                                           					# axis index
				444444,                                      					# color
				20,                                         					# font size
				0,                                           					# alignment = center
				'lt'                                            				# line + tick mark
			))
		)),


		'chxl' => '0:|' . implode('|', $timeline) . '|', 						#axis label

		'chd' => USE_EXTENDED_ENCODE ?											# data
						google_charts_extended_encode($data, $min, $max) :
						google_charts_text_encode($data)
		
		#'chm' => 'v,777777,0,-1,1'
	);

	$chart_query = http_build_query($chart_parameters);
	
function google_charts_text_encode($data = null) {
	return 't:' . implode(',', $data);
}

function google_charts_extended_encode($data = null, $min = 0, $max = 100) {
	$map = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.');
	$maplen = count($map);
	$scale = 4096;
	$diff = $max - $min;
	
	$encoded = array();
	foreach ($data as $ii => $item) {
		if ($item < 0) {
			$encoded[$ii] = '__';
			continue;
		}

		$value = intval(floatval($item - $min) / $diff * $scale);
		
		$quotient = floor($value / $maplen);
		$remainder = $value % $maplen;
		$encoded[$ii] = $map[$quotient] . $map[$remainder];
	}
	
	return 'e:' . implode('', $encoded);
}

?>
<?php /*
<!--
<a href="http://chart.googleapis.com/chart?<?php //print $chart_query; ?>" title="Click Me" target="_blank">Click Me!</a> (Link length: <?php //print strlen('http://chart.googleapis.com/chart?' . $chart_query); ?>)
<br/> -->
*/
?>
http://chart.googleapis.com/chart?<?php print $chart_query; ?>
<?php
/*
<!--
<img src="http://chart.googleapis.com/chart?<?php //print $chart_query; ?>" alt="Hang Seng Index" />

<br/>
<pre>
<?php //print_r($chart_parameters); ?>
<?php //print_r($data); ?>
</pre>
-->
*/
?>