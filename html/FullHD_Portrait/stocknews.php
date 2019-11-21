<?php 
	$link[0] = "http://download.finance.yahoo.com/d/quotes.csv?s=0001.HK&f=snl1c1pod1t1";
	$link[1] = "http://download.finance.yahoo.com/d/quotes.csv?s=0002.HK&f=snl1c1pod1t1";
	$link[2] = "http://download.finance.yahoo.com/d/quotes.csv?s=0003.HK&f=snl1c1pod1t1";
	$link[3] = "http://download.finance.yahoo.com/d/quotes.csv?s=0004.HK&f=snl1c1pod1t1";
	$link[4] = "http://download.finance.yahoo.com/d/quotes.csv?s=0005.HK&f=snl1c1pod1t1";
	$link[5] = "http://download.finance.yahoo.com/d/quotes.csv?s=0006.HK&f=snl1c1pod1t1";
	$link[6] = "http://download.finance.yahoo.com/d/quotes.csv?s=0008.HK&f=snl1c1pod1t1";
	$link[7] = "http://download.finance.yahoo.com/d/quotes.csv?s=0011.HK&f=snl1c1pod1t1";
	$link[8] = "http://download.finance.yahoo.com/d/quotes.csv?s=0012.HK&f=snl1c1pod1t1";
	$link[9] = "http://download.finance.yahoo.com/d/quotes.csv?s=0013.HK&f=snl1c1pod1t1";
	$link[10] = "http://download.finance.yahoo.com/d/quotes.csv?s=0016.HK&f=snl1c1pod1t1";
	$link[11] = "http://download.finance.yahoo.com/d/quotes.csv?s=0017.HK&f=snl1c1pod1t1";
	$link[12] = "http://download.finance.yahoo.com/d/quotes.csv?s=0019.HK&f=snl1c1pod1t1";
	$link[13] = "http://download.finance.yahoo.com/d/quotes.csv?s=0023.HK&f=snl1c1pod1t1";
	$link[14] = "http://download.finance.yahoo.com/d/quotes.csv?s=0066.HK&f=snl1c1pod1t1";
	$link[15] = "http://download.finance.yahoo.com/d/quotes.csv?s=0083.HK&f=snl1c1pod1t1";
	$link[16] = "http://download.finance.yahoo.com/d/quotes.csv?s=0101.HK&f=snl1c1pod1t1";
	$link[17] = "http://download.finance.yahoo.com/d/quotes.csv?s=0144.HK&f=snl1c1pod1t1";
	$link[18] = "http://download.finance.yahoo.com/d/quotes.csv?s=0267.HK&f=snl1c1pod1t1";
	$link[19] = "http://download.finance.yahoo.com/d/quotes.csv?s=0291.HK&f=snl1c1pod1t1";
	$link[20] = "http://download.finance.yahoo.com/d/quotes.csv?s=0293.HK&f=snl1c1pod1t1";
	$link[21] = "http://download.finance.yahoo.com/d/quotes.csv?s=0330.HK&f=snl1c1pod1t1";
	$link[22] = "http://download.finance.yahoo.com/d/quotes.csv?s=0386.HK&f=snl1c1pod1t1";
	$link[23] = "http://download.finance.yahoo.com/d/quotes.csv?s=0388.HK&f=snl1c1pod1t1";
	$link[24] = "http://download.finance.yahoo.com/d/quotes.csv?s=0494.HK&f=snl1c1pod1t1";
	$link[25] = "http://download.finance.yahoo.com/d/quotes.csv?s=0551.HK&f=snl1c1pod1t1";
	$link[26] = "http://download.finance.yahoo.com/d/quotes.csv?s=0688.HK&f=snl1c1pod1t1";
	$link[27] = "http://download.finance.yahoo.com/d/quotes.csv?s=0762.HK&f=snl1c1pod1t1";
	$link[28] = "http://download.finance.yahoo.com/d/quotes.csv?s=0857.HK&f=snl1c1pod1t1";
	$link[29] = "http://download.finance.yahoo.com/d/quotes.csv?s=0883.HK&f=snl1c1pod1t1";
	$link[30] = "http://download.finance.yahoo.com/d/quotes.csv?s=0906.HK&f=snl1c1pod1t1";
	$link[31] = "http://download.finance.yahoo.com/d/quotes.csv?s=0939.HK&f=snl1c1pod1t1";
	$link[32] = "http://download.finance.yahoo.com/d/quotes.csv?s=0941.HK&f=snl1c1pod1t1";
	$link[33] = "http://download.finance.yahoo.com/d/quotes.csv?s=1038.HK&f=snl1c1pod1t1";
	$link[34] = "http://download.finance.yahoo.com/d/quotes.csv?s=1088.HK&f=snl1c1pod1t1";
	$link[35] = "http://download.finance.yahoo.com/d/quotes.csv?s=1199.HK&f=snl1c1pod1t1";
	$link[36] = "http://download.finance.yahoo.com/d/quotes.csv?s=1398.HK&f=snl1c1pod1t1";
	$link[37] = "http://download.finance.yahoo.com/d/quotes.csv?s=2038.HK&f=snl1c1pod1t1";
	$link[38] = "http://download.finance.yahoo.com/d/quotes.csv?s=2318.HK&f=snl1c1pod1t1";
	$link[39] = "http://download.finance.yahoo.com/d/quotes.csv?s=2388.HK&f=snl1c1pod1t1";
	$link[40] = "http://download.finance.yahoo.com/d/quotes.csv?s=2628.HK&f=snl1c1pod1t1";
	$link[41] = "http://download.finance.yahoo.com/d/quotes.csv?s=3328.HK&f=snl1c1pod1t1";
	$link[42] = "http://download.finance.yahoo.com/d/quotes.csv?s=3988.HK&f=snl1c1pod1t1";

	for($i=0;$i<=42;$i++)
	{
	$temp = split(",", file_get_contents($link[$i]));
	$temp[0] = '<font face="Arial" style="font-size: 65" color="#000000">'.str_replace('"', '', str_replace('.HK','',$temp[0])).'</font>';
	$temp[1] = '<font face="Arial" style="font-size: 65" color="#005196">'.str_replace('"', '',$temp[1]).'</font>';
	$temp[2] = '<font face="Arial" style="font-size: 65" color="#005196">'.$temp[2].'</font>';
		if($temp[3] > 0){
			$temp[3] = str_replace ('+','',$temp[3]);
			$temp[3] = '<img border="0" src="images/up.jpg"><font face="Arial" style="font-size: 65" color="#005196">'.$temp[3].'</font>';
		}else if($temp[3] < 0){
			$temp[3] = str_replace ("-","",$temp[3]);
			$temp[3] = '<img border="0" src="images/down.jpg"><font face="Arial" style="font-size: 65" color="#005196">'.$temp[3].'</font>';
		}else {
			$temp[3] = '<font face="Arial" style="font-size: 65" color="#005196"><img border="0" src="images/na.jpg"></font>';
		}

	$filename = '/var/www/wsja/html/resource/stocknews/'.str_replace("\"", "", strip_tags($temp[0])).'.txt';

	   if (!$handle = fopen($filename, 'w')) {
	         exit;
	   }
	
	   if (!fwrite($handle, $temp[0].'&nbsp;&nbsp;'.$temp[1].'&nbsp;&nbsp;&nbsp;&nbsp;'.$temp[2].'&nbsp;&nbsp;&nbsp;&nbsp;'.$temp[3].'&nbsp;&nbsp;&nbsp;&nbsp;')) {
	       exit;
	   }
	
	   fclose($handle);

	}


?>


 