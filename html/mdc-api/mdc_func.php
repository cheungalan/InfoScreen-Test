<?php

function mdc_autocomplete($q)
{
	$Results = array();

	$url = "http://services.dowjones.com/autocomplete/data?q=$q&cc=hk|cn|us&count=20";

	$json = json_decode(file_get_contents($url),true);

	foreach($json["symbols"] as $symbol)
	{

			$djsymb = explode(".",$symbol["djnSymbol"]);
			$arr = array();
			$arr = array(
							"Name" => $symbol["company"],
							"Symbol" => $djsymb[0],
							"CountryCode" => $symbol["country"],
							"Volume" => "",
							"Exchange" => $symbol["exchangeIsoCode"],
							"SymbolType" => "",
							"ExchangeId" => "",
							"InstrumentId" => $symbol["ticker"],
							"SourceId" => ""
			);

			$temp[] = $arr;
	}

	$results = array("Results"=>$temp);
	return json_encode($results);
	
}

function get_quote($q)
{
//	$prefix="HK:";
//	$q = $prefix.$q;
	
	if (strpos($q,":"))
	{
			$pieces = explode(":",$q);
			$country = $pieces[0];
			$ticker = $pieces[1];
	}
	else
	{
			$country = "";
			$ticker = $q;
	}

	$url = "http://services.dowjones.com/instrumentrest.svc/quotes/v1/comp/quote?id=$ticker|$country|||&MaxInstrumentMatches=1&ckey=f5aa0ce5fc";
	$request_headers[] = 'Dylan2010.EntitlementToken: f5aa0ce5fcd5490abedb3bf6e7767621';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);

	$xml = new SimpleXMLElement($output);
	$xml = json_decode(json_encode($xml),1);

	$Trading = $xml["GetInstrumentResponse"]["InstrumentResponses"]["InstrumentResponse"]["Matches"]["InstrumentMatch"]["Trading"];
	$Financials = $xml["GetInstrumentResponse"]["InstrumentResponses"]["InstrumentResponse"]["Matches"]["InstrumentMatch"]["Financials"];
	$TradingStatistics = $xml["GetInstrumentResponse"]["InstrumentResponses"]["InstrumentResponse"]["Matches"]["InstrumentMatch"]["TradingStatistics"];

	$TradeDateTime = explode("T",$Trading["Last"]["Time"]);
	$PreviousCloseDateTime = explode("T",$Financials["Previous"]["Time"]);

	$arr = array(
				"Key" => array(
								"InstrumentId" => $ticker,
								"ExchangeId" => $country
							),
				"Last" => number_format($Trading["Last"]["Price"]["Value"],2),
				"Open" => number_format($Trading["Open"]["Value"],2),
				"High" => number_format($Trading["High"]["Value"],2),
				"Low" => number_format($Trading["Low"]["Value"],2),
				"TradeDate" =>  $TradeDateTime[0],
				"TradeTime" =>  $TradeDateTime[1],
				"Bid" => "",
				"Ask" => "",
				"Currency" => $Trading["Last"]["Price"]["Iso"],
				"Volume" => $Trading["Volume"],
				"Change" => number_format($Trading["NetChange"]["Value"],2),
				"BidSize" => "",
				"AskSize" => "",
				"Symbol" => $ticker,
				"FiftyTwoWeekHigh" => number_format($TradingStatistics["PriceStatistics"]["CurrencyStatistic"][2]["Maximum"]["Value"],2),
				"FiftyTwoWeekLow" =>  number_format($TradingStatistics["PriceStatistics"]["CurrencyStatistic"][2]["Minimum"]["Value"],2),
				"FiftyTwoWeekHighDate" => $TradingStatistics["PriceStatistics"]["CurrencyStatistic"][2]["MaximumDateTime"],
				"FiftyTwoWeekLowDate" => $TradingStatistics["PriceStatistics"]["CurrencyStatistic"][2]["MinimumDateTime"],
				"BaseQuotePreviousClose" => $Financials["Previous"]["Price"]["Value"],
				"BaseQuotePreviousCloseDate" => $PreviousCloseDateTime[0],
				"PreviousClose" => $Financials["Previous"]["Price"]["Value"],
				"PreviousCloseDate" => $PreviousCloseDateTime[0],
				"PreviousVolume" => $Financials["PreviousVolume"]
				);

	return json_encode($arr);	
}

?>