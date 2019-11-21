<?php

	include "/var/www/wsja/html/resource/include/holiday.php";
	date_default_timezone_set('Asia/Hong_Kong');
	
	if ( (date("H:i:s") > "09:15" && date("H:i:s")< "12:15" || date("H:i:s") > "13:15" && date("H:i:s")< "16:15" ) && !isHoliday() )
	{
		$contents = "<font face='Arial' color='#FF0000' size='5'><b>15 minutes delayed</b></font>";
	}
	else
	{
		$contents = "<font face='Arial' color='#FF0000' size='5'><b>Market Closed</b></font>";
	}

	print $contents;
?>