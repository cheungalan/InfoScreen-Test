<?php

function calc(){

   include_once "config.inc.php";

   $curdir=FILEPATH."/stocknews/";
   $dir = scandir($curdir);

   $content = "";
   foreach ($dir as $file)
   {
			$content .= addslashes(file_get_contents($curdir.$file));
			$content .= "##";
	}
return $content;
}

  include_once("../resource/agent.php");
  $agent->init(); 
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<style type="text/css">
 .tab { font-weight:bold;font-size:12px; text-align:center; font-family: "Arial", "Helvetica";}
 .tabb { font-weight:bold; font-size:14px; font-family: "Arial", "Helvetica"; text-align:center;}
 .tabbb { font-weight:bold; font-size:10px; font-family: "Arial", "Helvetica"; text-align:center;}
</style>

<style type="text/css">

/* external file "mybcstyle.css" begins */
A { text-decoration:none;}
A:link { color: blue }
A:visited { color: blue }
A:hover { color: red }
 .stilmsg { font-weight:bold; font-size:12px; text-align:left; font-family: "Arial", "Helvetica", sans-serif; color:navy;}
 .stilefss {font-weight:bold; font-size:8px; font-family: "Arial", "Helvetica, sans-serif"; text-align:center; color:blue;}
/* end of external file "mybcstyle.css" */

</style>

</head>
<body>
<script language="javascript" src="js/mybcbody.js"></script>

<script>
	var started = false;

	function runcalc() {
		agent.call('','calc','callback');
		Timer();
	}
	  
	function callback(str) 
	{
		var ddate = new Date();
		var djnews = Array();
		djnews = str.split("##");
		for(i=0;i<djnews.length - 1;i++){
			sglm[i] = djnews[i + 1] + ddate.toString();
		}

		if (started == false){
			startbcscroll();
			started = true;
		}
	}

	function Timer()
	{
		setTimeout("runcalc()", 60000);
	}

	runcalc();
</script>

</body>
</html>