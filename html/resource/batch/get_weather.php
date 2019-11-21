<?php 
	date_default_timezone_set('Asia/Hong_Kong');

	$link = "http://rss.weather.gov.hk/rss/CurrentWeather.xml";
	$contents = file_get_contents($link); 	
	
	$xml = simplexml_load_string($contents,null,LIBXML_NOCDATA);
	$desc = $xml->channel->item->description;
	
	//Temperature
	$result = preg_match("/(AIR TEMPERATURE : )(.*)( DEGREES CELSIUS)/i", $desc, $items);
	$temperature = $items[2];

	//pic
	$result = preg_match("/(\/img\/pic)(.*)(.png)/i", $desc, $item);
	$pic = trim($item[2]);

	//return $temperature."***".$pic;

	include_once "/var/www/wsja/admin/db_info.php";

	// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	$timezone = date_default_timezone_get();
	$db->exec("SET time_zone = '{$timezone}'");
	
	$sql = "update weather set temperature=:temp, pic=:pic, lastupdate=now() where id=1";
	$sth = $db->prepare($sql);
	$sth->bindValue(':temp', $temperature);
	$sth->bindValue(':pic', $pic);
	$status = $sth->execute();

	print "Download Weather completed\r\n";
?>
