<?php
	date_default_timezone_set('Asia/Hong_Kong');
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	

function isHoliday()
{
	global $db;
	
	$curdate = date("Y-m-d");
	$sql = "select * from holiday where datekey=:curdate";
	
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':curdate', $curdate);
	$stmt->execute();		
	
	if( $stmt->fetchColumn() )
	{
		// Record not found, insert a new record
		return true;
	}
	else
	{
		return false;
	}
}	
	
?>
