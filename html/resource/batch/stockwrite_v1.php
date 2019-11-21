<?php
	date_default_timezone_set('Asia/Hong_Kong');
	include "/var/www/wsja/html/resource/include/holiday.php";
	
	// Check Whether it's holiday today or stop to process
	if (isHoliday())
	{
		exit(1);
	}
	
	
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	
	include "../../mdc-api/mdc_func.php";

	$link = array();
//	$link[] = "HK:HSI";		// 'Hang Seng Index'
	$link[] = "HK:0001";
	$link[] = "HK:0002";
	$link[] = "HK:0003";
	$link[] = "HK:0004";
	$link[] = "HK:0005";
	$link[] = "HK:0006";
	$link[] = "HK:0011";
	$link[] = "HK:0012";
	$link[] = "HK:0016";
	$link[] = "HK:0017";
	$link[] = "HK:0019";
	$link[] = "HK:0023";
	$link[] = "HK:0027";	
	$link[] = "HK:0066";
	$link[] = "HK:0083";
	$link[] = "HK:0101";
	$link[] = "HK:0144";
	$link[] = "HK:0151";
	$link[] = "HK:0175"; // New added on 20180126
	$link[] = "HK:0267";
	$link[] = "HK:0288"; // New added on 20180126
	$link[] = "HK:0386";
	$link[] = "HK:0388";
	$link[] = "HK:0688";
	$link[] = "HK:0700";
	$link[] = "HK:0762";
	$link[] = "HK:0823";
	$link[] = "HK:0836";
	$link[] = "HK:0857";
	$link[] = "HK:0883";
	$link[] = "HK:0939";
	$link[] = "HK:0941";
	$link[] = "HK:0992";
	$link[] = "HK:1038"; // New added on 20180126
	$link[] = "HK:1044";
	$link[] = "HK:1088";
	$link[] = "HK:1109";
	$link[] = "HK:1113";
	$link[] = "HK:1299";
	$link[] = "HK:1398";
	$link[] = "HK:1928";
	$link[] = "HK:1997"; // New added on 20180126
	$link[] = "HK:2007"; // New added on 20180126
	$link[] = "HK:2018"; // New added on 20180126
	$link[] = "HK:2318";
	$link[] = "HK:2319";
	$link[] = "HK:2382"; // New added on 20180126
	$link[] = "HK:2388";
	$link[] = "HK:2628";
	$link[] = "HK:3328";
//	$link[] = "0135"; // remove on 20180126	
//	$link[] = "0291"; // remove on 20180126
//	$link[] = "0293"; // remove on 20180126
//	$link[] = "0322"; // remove on 20180126
//	$link[] = "0494"; // remove on 20180126
//	$link[] = "1880"; // remove on 20180126
//	$link[] = "3988"; // remove on 20180126	

	foreach ($link as $symbol)
	{
		print $symbol." : ";
		// Get Indices name description
		$name_json = json_decode(mdc_autocomplete($symbol),true);
		$indices['InstrumentId'] 	= $name_json['Results'][0]['InstrumentId'];
		$indices['Name'] 			= $name_json['Results'][0]['Name'];		
		
		
		// Get Indices quote info
		$quote_json = json_decode(get_quote($symbol),true);

		$indices['Last'] 		= str_replace(",","",$quote_json['Last']);
		$indices['Change'] 		= $quote_json['Change'];
		$indices['PrevClose'] 	= str_replace(",","",$quote_json['PreviousClose']);
		$indices['Open'] 		= str_replace(",","",$quote_json['Open']);
		$indices['TradeDate'] 	= $quote_json['TradeDate'];
		$indices['TradeTime'] 	= $quote_json['TradeTime'];
		
		$stmt = $db->prepare('SELECT * FROM indices WHERE symbol=?');
		$stmt->bindParam(1, $symbol, PDO::PARAM_INT);
		$stmt->execute();

		if( $stmt->fetchColumn() )
		{
			// Record found, update it
			print "Record found, update it\r\n";
			$sql  = "update indices set ";
			$sql .= "InstrumentId = :InstrumentId, ";
			$sql .= "Name = :Name, ";
			$sql .= "indexvalue = :Last, ";
			$sql .= "indexchange = :Change, ";
			$sql .= "PrevClose = :PrevClose, ";
			$sql .= "Open = :Open, ";
			$sql .= "tradetime = :tradetime, ";
			$sql .= "lastupdate = :lastupdate ";
			$sql .= "where symbol = :symbol";
			
			$sth = $db->prepare($sql);
			$sth->bindValue(':InstrumentId', $indices['InstrumentId']);
			$sth->bindValue(':Name', $indices['Name']);
			$sth->bindValue(':Last', $indices['Last']);
			$sth->bindValue(':Change', $indices['Change']);
			$sth->bindValue(':PrevClose', $indices['PrevClose']);
			$sth->bindValue(':Open', $indices['Open']);
			$sth->bindValue(':tradetime', $indices['TradeDate']." ".$indices['TradeTime']);
			$sth->bindValue(':lastupdate', date("Y-m-d H:i:s"));
			$sth->bindValue(':symbol', $symbol);
			$status = $sth->execute();
		}
		else
		{
			// Record not found, insert a new record
			print "Record not found, insert a new record\r\n";
			$sql = "insert into indices set ";
			$sql .= "symbol = :symbol, ";
			$sql .= "InstrumentId = :InstrumentId, ";
			$sql .= "Name = :Name, ";
			$sql .= "indexvalue = :Last, ";
			$sql .= "indexchange = :Change, ";
			$sql .= "PrevClose = :PrevClose, ";
			$sql .= "Open = :Open, ";
			$sql .= "tradetime = :tradetime, ";
			$sql .= "lastupdate = :lastupdate ";
			
			$sth = $db->prepare($sql);
			$sth->bindValue(':InstrumentId', $indices['InstrumentId']);
			$sth->bindValue(':Name', $indices['Name']);
			$sth->bindValue(':Last', $indices['Last']);
			$sth->bindValue(':Change', $indices['Change']);
			$sth->bindValue(':PrevClose', $indices['PrevClose']);
			$sth->bindValue(':Open', $indices['Open']);
			$sth->bindValue(':tradetime', $indices['TradeDate']." ".$indices['TradeTime']);
			$sth->bindValue(':lastupdate', date("Y-m-d H:i:s"));
			$sth->bindValue(':symbol', $symbol);
			$status = $sth->execute();
		}
		
	}
   
?>

