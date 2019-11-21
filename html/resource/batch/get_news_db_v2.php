<?php
//	if ( !getenv('REMOTE_ADDR') == "")  
//	{
//		print "Sorry, This file can only be executed locally." ;	
//		exit(1);
//	}

date_default_timezone_set("Asia/Hong_Kong");

include_once "../config.inc.php";
include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);
	$timezone = date_default_timezone_get();
	$db->exec("SET time_zone = '{$timezone}'");

	$query = "select * from newsfeed";
	$sth = $db->prepare($query);
	$status = $sth->execute();

	while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
		$id = filter_var($row['id'],FILTER_SANITIZE_STRING);
		$feedname = filter_var($row['feedname'],FILTER_SANITIZE_STRING);
		$title = filter_var($row['Title'],FILTER_SANITIZE_STRING);
		$charset = filter_var($row['Language'],FILTER_SANITIZE_STRING); 		
		
		$sql = "select * from newsfeedurl where feedname=:feedname";
		$sth2 = $db->prepare($sql);
		$sth2->bindValue(':feedname', $feedname);
		$status = $sth2->execute();
		$urls = array();
		while ($row2 = $sth2->fetch(PDO::FETCH_ASSOC))
		{
			$feedurl = $row2['URL'];
			get_newsfeed($feedname, $feedurl, $charset);
			
			$query = "update newsfeed set lastupdate=now() where id=:news_id";
			$stmt = $db->prepare($query);
			$stmt->bindValue(':news_id', $id);
			$status = $stmt->execute();
		}		
		
	}
	
	
	

function get_newsfeed($feedname, $feedurl, $charset) 	
{
	global $dbserver,$dbuser,$dbpass;
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);
	$timezone = date_default_timezone_get();
	$db->exec("SET time_zone = '{$timezone}'");
	
	// Get News feed;
	$content = file_get_contents($feedurl);
	
	switch ($charset) {
		case "gb2312":
		case "big5" :
			$content = mb_convert_encoding( $content, "UTF-8", $charset);
			$content = str_replace('encoding="'.$charset.'"','encoding="utf-8"',$content);		
			break;
		default:
			break;
	}

	$xml = simplexml_load_string($content);
	
	switch ($charset) {
		case "gb2312":
		case "big5" :
			$xml_items = $xml;
			break;
		default:
			$xml_items = $xml->channel;
			break;
	}

	foreach ($xml_items->item as $item)
	{
		$title 			= str_replace(array("&gt;", "&lt;"), array(">", "<"), htmlspecialchars($item->title,ENT_NOQUOTES));
		$hlink 			= $item->link;
		$description 	= str_replace(array("&gt;", "&lt;"), array(">", "<"), htmlspecialchars($item->description,ENT_NOQUOTES));
		$pubdate 		= strtotime($item->pubDate);
		
		if ($charset == "gb2312" || $charset == "big5")
		{
			$guid = basename(parse_url($item->link,PHP_URL_PATH));
		}
		else
		{
			$guid = $item->guid;
		}

		$stmt = $db->prepare('SELECT * FROM newscontent WHERE feedname=? and guid=?');
		$stmt->bindParam(1, $feedname, PDO::PARAM_INT);
		$stmt->bindParam(2, $guid, PDO::PARAM_INT);
		$stmt->execute();

		if( $stmt->fetchColumn() )
		{
			// Record found, update it		
			print "Record found, update it : $title : ".date("Y-m-d H:i:s", $pubdate)."\r\n";
			$sql = "update newscontent set ";
			$sql .= "title = :title, ";
			$sql .= "description = :desc, ";
			$sql .= "url = :hlink, ";
			$sql .= "pubdate = :pubdate, ";
			$sql .= "lastupdate = now()";
			$sql .= "where feedname = :feedname and guid= :guid";
		
			$sth = $db->prepare($sql);
			$sth->bindValue(':feedname', $feedname);
			$sth->bindValue(':guid', $guid);
			$sth->bindValue(':title', $title);
			$sth->bindValue(':desc', $description);
			$sth->bindValue(':hlink', $hlink);
			$sth->bindValue(':pubdate', date("Y-m-d H:i:s", $pubdate));
			$status = $sth->execute();
			
		}
		else
		{
			// Record not found, insert a new record
			print "Record not found, insert a new record : $title : ".date("Y-m-d H:i:s", $pubdate)."\r\n";
			$sql = "insert into newscontent set ";
			$sql .= "feedname = :feedname, ";
			$sql .= "guid = :guid, ";
			$sql .= "title = :title, ";
			$sql .= "description = :desc, ";
			$sql .= "url = :hlink, ";
			$sql .= "pubdate = :pubdate, ";
			$sql .= "lastupdate = now()";
		
			$sth = $db->prepare($sql);
			$sth->bindValue(':feedname', $feedname);
			$sth->bindValue(':guid', $guid);
			$sth->bindValue(':title', $title);
			$sth->bindValue(':desc', $description);
			$sth->bindValue(':hlink', $hlink);
			$sth->bindValue(':pubdate', date("Y-m-d H:i:s", $pubdate));
			$status = $sth->execute();			
		}
	} 		
}

?>
