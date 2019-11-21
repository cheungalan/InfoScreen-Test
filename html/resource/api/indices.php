<?php

	date_default_timezone_set('Asia/Hong_Kong');

	$allows = array("DJI","HK:HSI","NASDAQ","CN:SHCOMP");

	$indices = filter_var($_GET['indices'],FILTER_SANITIZE_STRING);

	if (!in_array($indices, $allows))
	{
		print "not allow!!";
		exit(1);
	}
	
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	
	$sql = "select * from globalindices where symbol=:indices";
	$sth = $db->prepare($sql);
	$sth->bindValue(':indices', $indices);
	$status = $sth->execute();

	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$hsi['id'] = $row['symbol'];
		$hsi['last'] = $row['indexvalue'];
		$hsi['change'] = $row['indexchange'];
		$hsi['prevclose'] = $row['PrevClose'];
		$hsi['open'] = $row['Open'];
		$hsi['lastupdate'] = $row['tradetime'];
	}
	
	$json = json_encode($hsi);
	print $json;

?>