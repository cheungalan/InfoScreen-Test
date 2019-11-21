<?php

	date_default_timezone_set('Asia/Hong_Kong');
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	
	$sql = "select * from weather";
	$sth = $db->prepare($sql);
	$status = $sth->execute();

	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$result['temperature'] = $row['temperature'];
		$result['pic'] = $row['pic'];
	}
	
	print json_encode($result);

?>