<?php

	$version = filter_var($_GET['ver'],FILTER_SANITIZE_STRING);

	if (!in_array($version, array("1","2")))
	{
		print "Access Denied";
		exit(1);
	}
	
	date_default_timezone_set('Asia/Hong_Kong');
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	
	$sql = "select * from indices where symbol<>'HK:HSI' order by symbol";
	$sth = $db->prepare($sql);
	$status = $sth->execute();

	switch ($version) {
		case 1:
			$i=0;
			while ($row = $sth->fetch(PDO::FETCH_ASSOC))
			{
				$stock[$i]['index'] = $i+1;
				$stock[$i]['id'] = str_replace("HK:","",$row['symbol']);
				$stock[$i]['name'] = substr($row['name'], 0, 18);
				$stock[$i]['last'] = $row['indexvalue'];
				$stock[$i]['change'] = $row['indexchange'];
				$stock[$i]['prevclose'] = $row['PrevClose'];
				$stock[$i]['open'] = $row['Open'];
				$stock[$i]['lastupdate'] = $row['tradetime'];
				$i++;
			}
			
			$json = json_encode($stock);
			print $json;
			break;
		case 2:
			$content = "";
			while ($row = $sth->fetch(PDO::FETCH_ASSOC))
			{
				$id = str_replace("HK:","",filter_var($row['symbol'],FILTER_SANITIZE_STRING));
				$name = substr(filter_var($row['name'],FILTER_SANITIZE_STRING), 0, 18);
				$last = filter_var($row['indexvalue'],FILTER_SANITIZE_STRING);
				$change = filter_var($row['indexchange'],FILTER_SANITIZE_STRING);
			
				$content .= '<font face="Arial" style="font-size: 65" color="#000000">'.$id.'</font>';
				$content .= "&nbsp;&nbsp;";
				$content .= '<font face="Arial" style="font-size: 65" color="#005196">'.$name.'</font>';
				$content .= "&nbsp;&nbsp;&nbsp;&nbsp;";
				$content .= '<font face="Arial" style="font-size: 65" color="#005196">'.$last.'</font>';
				$content .= "&nbsp;&nbsp;&nbsp;&nbsp;";
				if ($change > 0)
				{
					$content .= '<img border="0" src="images/up.jpg">';
					$content .= '<font face="Arial" style="font-size: 65" color="#005196">'.str_replace ('+','',$change).'</font>';
				}
				else if($change < 0)
				{
					$content .= '<img border="0" src="images/down.jpg">';
					$content .= '<font face="Arial" style="font-size: 65" color="#005196">'.str_replace ('-','',$change).'</font>';
				}
				else
				{
					$content .= '<font face="Arial" style="font-size: 65" color="#005196"><img border="0" src="images/na.jpg"></font>';
				}
				$content .= "&nbsp;&nbsp;&nbsp;&nbsp;";
				$content .= "##";
			}
			
			print addslashes($content);
			break;

	}
	
?>