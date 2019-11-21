<?php

	date_default_timezone_set('Asia/Hong_Kong');
	include_once "/var/www/wsja/admin/db_info.php";

	$iCal_url = "http://www.1823.gov.hk/common/ical/gc/en.ics";
	
// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	
	$iCal = file_get_contents($iCal_url);

	preg_match_all('/DTSTART;VALUE=DATE:(.*)/', $iCal, $DateArrays);

	preg_match_all('/SUMMARY:(.*)/', $iCal, $DescArrays);

	$holiday = array();
	$i=0;
	foreach ($DateArrays[1] as $DateArray)
	{
		$DateElement = date("Y-m-d",strtotime($DateArray));
		
		$stmt = $db->prepare('SELECT * FROM holiday WHERE datekey=?');
		$stmt->bindParam(1, $DateElement, PDO::PARAM_INT);
		$stmt->execute();		
		
		if( !$stmt->fetchColumn() )
		{
			// Record not found, insert a new record
			$sql = "insert into holiday set ";
			$sql .= "datekey = :datekey, ";
			$sql .= "description = :description, ";
			$sql .= "lastupdate = :lastupdate ";
			
			$sth = $db->prepare($sql);
			$sth->bindValue(':datekey', $DateElement);
			$sth->bindValue(':description', str_replace("’", "'",trim($DescArrays[1][$i])));
			$sth->bindValue(':lastupdate', date("Y-m-d H:i:s"));			
			$status = $sth->execute();
		}
		
		$holiday_arr[$DateElement] = $DescArrays[1][$i];
		$i++;
	}	
	
// Remove record that was 3 years old
	$sql = "delete from holiday where datekey < DATE_SUB(NOW(), INTERVAL 3 YEAR)";
	$stmt = $db->query($sql);
	
	print "complete\r\n";
?>