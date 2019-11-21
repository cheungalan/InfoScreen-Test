<?php
	date_default_timezone_set('Asia/Hong_Kong');
	
	include "/var/www/wsja/html/resource/include/holiday.php";
	include_once "/var/www/wsja/admin/db_info.php";

// connect database
	$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);	
	
	include "../../mdc-api/mdc_func.php";

	$link = array(
		'NYSE MKT Composite Index' 		=> 'XAX',
		'All Ordinaries'				=> 'AORD',
		'S&P/ASX 200'					=> 'XJO',
		'S&P/TSX Composite index'		=> 'GSPTSE',
//		'Shanghai 50 Index'				=> 'SSE50',
		'Shenzhen Composite Index'		=> 'SZSC',
		'Dow Jones Industrial Average'	=> 'DJI',
		'Dow Jones Americas Index USD'	=> 'A1DOW',
		'Dow Jones AP Total Stock Market Index' => 'DWAP',
		'SPDR S&P International Dividend ETF' => 'DWX',
		'Dow Jones Transportation Average' => 'DJT',
		'Dow Jones Utility Average Index' => 'DJU',
		'Dynamic Building & Construction Intellidex Index' => 'DWC',
		'Global Dow'					=> 'GDOW',
		'Hang Seng Index'				=> 'HK:HSI',
		'S&P/CNX Nifty Index'			=> 'NSEI',
		'JSX Composite Index'			=> 'JKSE',
		'Nikkei 225'					=> 'JP:NIK',
		'Nikkei 300'					=> 'N300.NK',
		'PHLX/KBW Bank Index'			=> 'BKX',
		'FTSE Bursa Malaysia KLCI'		=> 'KLSE',
		'NASDAQ Composite'				=> 'NASDAQ',
		'NASDAQ 100 Index'				=> 'NDX',
		'NZX 50 Gross Index'			=> 'NZ50',
		'NYSE Composite Index'			=> 'NYA',
		'PHLX Gold/Silver Index'		=> 'XAU',
		'PHLX Housing Index'			=> 'HGX',
		'PHLX Oil Service Index'		=> 'OSX',
		'S&P 100 Index'					=> 'OEX',
		'S&P 400 Mid Cap Index'			=> 'MID',
		'S&P Small Cap 600 Index'		=> 'SML',
		'KOSPI Composite Index'			=> 'KS11',
		'Dow Jones Singapore Total Stock Market Index SGD' => 'DWSP',
//		'FTSE Straits Times Index'		=> 'FTSTI',
		'EURO STOXX 50'					=> 'STOXX50E',
		'Taiwan Weighted Index'			=> 'TWII',
		'FTSE 100'						=> 'UK:UKX',
		'Stoxx Europe 600'				=> 'XX:SXXP',
		'CAC 40'						=> 'FR:PX1',
		'IBOVESPA'						=> 'BVSP',
		'Shanghai Composite'			=> 'CN:SHCOMP',
		'Germany DAX'					=> 'DX:DAX',
		'S&P 500'						=> 'US:SPX',
	##	'DJCBN600'		=> '486631',		##
	##	'SOXX'			=> '367277',		##
	#	'RUX'			=> '343354',					// Incorrect ID
	#	'SPX'			=> '343307',					// Incorrect ID
	);

	foreach ($link as $name => $symbol)
	{
		print $symbol." : ";
		$indices['InstrumentId'] 	= $symbol;
		$indices['Name'] 			= $name;		
		
		
		// Get Indices quote info
		$quote_json = json_decode(get_quote($symbol),true);

		$indices['Last'] 		= str_replace(",","",$quote_json['Last']);
		$indices['Change'] 		= $quote_json['Change'];
		$indices['PrevClose'] 	= str_replace(",","",$quote_json['PreviousClose']);
		$indices['Open'] 		= str_replace(",","",$quote_json['Open']);
		$indices['TradeDate'] 	= $quote_json['TradeDate'];
		$indices['TradeTime'] 	= $quote_json['TradeTime'];
		
		$stmt = $db->prepare('SELECT * FROM globalindices WHERE symbol=?');
		$stmt->bindParam(1, $symbol, PDO::PARAM_INT);
		$stmt->execute();

		if( $stmt->fetchColumn() )
		{
			// Record found, update it
			print "Record found, update it\r\n";
			$sql  = "update globalindices set ";
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
			$sql = "insert into globalindices set ";
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
		
		# Accumulate write Hang Seng Index data
		if ($symbol == "HK:HSI" && (date("Gi") > "0915" && date("Gi") < "1630") && !isHoliday())
		{
			if ($indices['Last'] != 0) 
			{
				print "write HSI\r\n";
				$sql = "insert into hsi_indices set ";
				$sql .= "indexvalue = :Last, ";
				$sql .= "indexchange = :Change, ";
				$sql .= "tradetime = :tradetime, ";
				$sql .= "lastupdate = :lastupdate ";
				
				$sth = $db->prepare($sql);
				$sth->bindValue(':Last', $indices['Last']);
				$sth->bindValue(':Change', $indices['Change']);
				$sth->bindValue(':tradetime', $indices['TradeDate']." ".$indices['TradeTime']);
				$sth->bindValue(':lastupdate', date("Y-m-d H:i:s"));
				$status = $sth->execute();
			}
		}
	}
   
?>

