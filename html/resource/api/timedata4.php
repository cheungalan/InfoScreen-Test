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
	
	$sql = "select indexvalue from hsi_indices order by lastupdate";
	$sth = $db->prepare($sql);
	$status = $sth->execute();

	$i=0;
	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$indices = filter_var($row['indexvalue'],FILTER_SANITIZE_STRING);

		print "[".$i.", ".$indices."]";
		$i++;
		if ($i < $sth->rowCount())
		{
			print ","."\r\n";
		}
		else
		{
			print "\r\n";
		}
	}
	

?>