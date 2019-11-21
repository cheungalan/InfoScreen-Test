<?php
	date_default_timezone_set('Asia/Hong_Kong');
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	

function isHoliday()
{
	global $db;
	
	$curdate = date("Y-m-d");
	$DateOfWeek = date("w");
	
	$sql = "select * from holiday where datekey=:curdate";
	
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':curdate', $curdate);
	$stmt->execute();		
	
	if( $stmt->fetchColumn() || $DateOfWeek==0 || $DateOfWeek==6)
	{
		// Today is Holiday
		return true;
	}
	else
	{
		return false;
	}
}	
	
?>
