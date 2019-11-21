<?php 
date_default_timezone_set("Asia/Hong_Kong");

include "/var/www/wsja/html/resource/include/holiday.php";
include_once "/var/www/wsja/admin/db_info.php";

	// Check Whether it's holiday today or stop to process
	if (isHoliday())
	{
		exit(1);
	}

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	

	$stmt = $db->prepare('truncate indices');
	$stmt->execute();

	$stmt = $db->prepare('truncate hsi_indices');
	$stmt->execute();
	
	$stmt = $db->prepare('delete from newscontent where pubdatedate<subdate(curdate(),1)');
	$stmt->execute();

	
	
/*	
$filename = '/var/www/wsja/html/resource/timedata.csv';

 if (!$handle = fopen($filename, 'w')) {
         exit;
   }

	fwrite($handle, "");

   fclose($handle);

$filename = '/var/www/wsja/html/resource/timedata3.csv';
 if (!$handle = fopen($filename, 'w')) {
         exit;
   }

   fwrite($handle, "");

   fclose($handle);
*/
    
?>

