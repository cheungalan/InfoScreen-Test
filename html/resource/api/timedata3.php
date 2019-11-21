<?php

	date_default_timezone_set('Asia/Hong_Kong');
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	
	$sql = "select indexvalue from hsi_indices order by lastupdate";
	$sth = $db->prepare($sql);
	$status = $sth->execute();

	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$indices = filter_var($row['indexvalue'],FILTER_SANITIZE_STRING);
		print $indices.",";
	}
	

?>