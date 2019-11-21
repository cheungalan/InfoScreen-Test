<?php

$uid = filter_var($_GET["uid"],FILTER_SANITIZE_STRING);
$numofstory=filter_var($_GET['numofstory'],FILTER_SANITIZE_STRING);
$lang=filter_var($_GET['lang'],FILTER_SANITIZE_STRING);

include_once "/var/www/wsja/admin/db_info.php";
$db = new PDO("mysql:host=$dbserver;dbname=infoscreen;",$dbuser,$dbpass);		
$sql = "select * from userinfo where name=:uid";
$sth = $db->prepare($sql);
$sth->bindValue(':uid', $uid);
$sqlstatus = $sth->execute();

if ($sth->rowCount() <= 0 )
{
	print "Access Denied!";
	exit(1);
}
else
{
	$rows = $sth->fetch(PDO::FETCH_ASSOC);
}
?>

<span id="pendule2" style="font-family:Arial; font-size:35px; color:#ffffff; position:absolute;left:1000;top:20;width:221;text-align:center"></span>
<span id="pendule1" style="font-family:Arial; font-size:35px; color:#ffffff; position:absolute;left:1248;top:20;width:489;text-align:center"></span>

<SCRIPT LANGUAGE="JavaScript">

setTimeout("clock()", 1000);

function clock() 
{
	//if (!document.layers && !document.all) return;

//	var digital = new Date();
	var unixtime = new Date().getTime() + ((new Date().getTimezoneOffset()) + 480) * 1000 * 60;
	var digital = new Date(unixtime);
	

	// Get Date
	var theDay=digital.getDay();
	var theMonth=digital.getMonth();
	var dtext=new Array(30);
	dtext[0]="Sun";
	dtext[1]="Mon"; 
	dtext[2]="Tue";
	dtext[3]="Wed";
	dtext[4]="Thu";
	dtext[5]="Fri";
	dtext[6]="Sat";
	var mtext=new Array(30);
	mtext[0]="January";
	mtext[1]="February";
	mtext[2]="March";
	mtext[3]="April";
	mtext[4]="May";
	mtext[5]="June";
	mtext[6]="July";
	mtext[7]="August";
	mtext[8]="September";
	mtext[9]="October";
	mtext[10]="November";
	mtext[11]="December";
	dispDate = dtext[theDay] + ", " + mtext[theMonth] + " " + digital.getDate() + ", " + digital.getFullYear();

// Get Time
	var hours = digital.getHours();
	var minutes = digital.getMinutes();
	var seconds = digital.getSeconds();
	var amOrPm = "AM";
	if (hours > 11) amOrPm = "PM";
//	if (hours > 12) hours = hours - 12;
//	if (hours == 0) hours = 12;
	if (hours <= 9) hours = "0" + hours;
	if (minutes <= 9) minutes = "0" + minutes;
	if (seconds <= 9) seconds = "0" + seconds;
	dispTime = hours + ":" + minutes + ":" + seconds;

//	if (document.layers) 
//	{
//		document.layers.pendule1.document.write(dispDate);
//		document.layers.pendule1.document.close();
//		document.layers.pendule2.document.write(dispTime);
//		document.layers.pendule2.document.close();
//	}
//	else if (document.all)
//	{
		pendule1.innerHTML = dispDate;
		pendule2.innerHTML = dispTime;
//	}

	setTimeout("clock()", 1000);
}
</script>

<HTML>
<HEAD>
<TITLE>1920x1080</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=big5">
</HEAD>
<BODY BGCOLOR=#FFFFFF MARGINWIDTH=0 MARGINHEIGHT=0 topmargin="0" leftmargin="0">
<!-- ImageReady Slices (1920x1080.jpg) -->
<TABLE WIDTH=1920 BORDER=0 CELLPADDING=0 CELLSPACING=0 style="border-collapse: collapse" bordercolor="#111111" height="1080" background="images/1920x1080.jpg">
	<TR>
		<TD width="28" height="21"></TD>
		<TD width="970" height="21"></TD>
		<TD width="221" height="21"></TD>
		<TD width="27" height="21"></TD>
		<TD width="60" height="21"></TD>
		<TD width="33" height="21"></TD>
		<TD width="396" height="21"></TD>
		<TD width="26" height="21"></TD>
		<TD width="135" height="21"></TD>
		<TD width="24" height="21"></TD>
	</TR>
	<TR>
		<TD width="28" height="37"></TD>
		<TD width="970" height="37"></TD>
		<TD width="221" height="37"></TD>
		<TD width="27" height="37"></TD>
		<TD width="489" height="37" colspan="3"></TD>
		<TD width="26" height="37"></TD>
		<TD width="135" height="37"><iframe 
			src="weather.php" 
			scrolling="no" 
			frameborder="0"
			marginwidth="0" marginheight="0" width="135" height="37" name="I5"></iframe></TD>
		<TD width="24" height="37"></TD>
	</TR>
	<TR>
		<TD width="28" height="89"></TD>
		<TD width="970" height="89"></TD>
		<TD width="221" height="89"></TD>
		<TD width="27" height="89"></TD>
		<TD width="60" height="89"></TD>
		<TD width="33" height="89"></TD>
		<TD width="396" height="89"></TD>
		<TD width="26" height="89"></TD>
		<TD width="135" height="89"></TD>
		<TD width="24" height="89"></TD>
	</TR>
	<TR>
		<TD width="28" height="71"></TD>
		<TD width="970" height="71"></TD>
		<TD width="221" height="71"></TD>
		<TD width="27" height="71"></TD>
		<TD width="60" height="71"></TD>
		<TD width="33" height="71"></TD>
		<TD width="557" height="224" colspan="3" rowspan="2">
		<iframe 
				src="stock.php?uid=<?php echo $uid; ?>" 
				scrolling="no" 
				frameborder="0"
				marginwidth="0" marginheight="0" name="I4" width="557" height="224">
		</iframe>
</TD>
		<TD width="24" height="71"></TD>
	</TR>
	<TR>
		<TD width="28" height="153"></TD>
		<TD width="1278" height="750" colspan="4" rowspan="3"><iframe 
				<?php
					print 'src="news.php?uid='.$uid.'&lang='.$lang.'&numofstory='.$numofstory.'"'; 
				?>
        width="1278" height="750" 
				scrolling="no" 
				frameborder="0"
				marginwidth="0" marginheight="0" name="I3"></iframe></TD>
		<TD width="33" height="153"></TD>
		<TD width="24" height="153"></TD>
	</TR>
	<TR>
		<TD width="28" height="22"></TD>
		<TD width="33" height="22"></TD>
		<TD width="396" height="22"></TD>
		<TD width="26" height="22"></TD>
		<TD width="135" height="22"></TD>
		<TD width="24" height="22"></TD>
	</TR>
	<TR>
		<TD width="28" height="575"></TD>
		<TD width="33" height="575"></TD>
		<TD width="557" height="662" colspan="3" rowspan="3"  align="center"><iframe 
				<?php
					print 'src="media.php?uid='.$uid.'"'; 
				?>
        width="557" height="662" 
				scrolling="no" 
				frameborder="0"
				marginwidth="0" marginheight="0" name="I4"></iframe></TD>
		<TD width="24" height="575"></TD>
	</TR>
	<TR>
		<TD width="28" height="22"></TD>
		<TD width="970" height="22"></TD>
		<TD width="221" height="22"></TD>
		<TD width="27" height="22"></TD>
		<TD width="60" height="22"></TD>
		<TD width="33" height="22"></TD>
		<TD width="24" height="22"></TD>
	</TR>
	<TR>
		<TD width="28" height="65"></TD>
		<TD width="1278" height="65" colspan="4"><iframe 
				src="djnews.php" 
				width="1278" height="65" 
				scrolling="no" 
				frameborder="0"
				marginwidth="0" marginheight="0" name="I6"></iframe>
</TD>
		<TD width="33" height="65"></TD>
		<TD width="24" height="65"></TD>
	</TR>
	<TR>
		<TD width="28" height="25"></TD>
		<TD width="970" height="25"></TD>
		<TD width="221" height="25"></TD>
		<TD width="27" height="25"></TD>
		<TD width="60" height="25"></TD>
		<TD width="33" height="25"></TD>
		<TD width="396" height="25"></TD>
		<TD width="26" height="25"></TD>
		<TD width="135" height="25"></TD>
		<TD width="24" height="25"></TD>
	</TR>
</TABLE>
<!-- End ImageReady Slices -->
</BODY>
</HTML>
