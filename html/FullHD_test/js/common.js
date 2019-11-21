//Disable right click script 
//visit http://www.rainbow.arch.scriptmania.com/scripts/ 

function clickIE() 
{
	if (document.all) {(message);return false;}
} 
function clickNS(e) 
{
	if (document.layers||(document.getElementById&&!document.all)) 
	{ 
		if (e.which==2||e.which==3) 
		{
			(message);
			return false;
		}
	}
} 
function norightclick()
{

	if (document.layers) 
	{
		document.captureEvents(Event.MOUSEDOWN);
		document.onmousedown=clickNS;
	} 
	else
	{
		document.onmouseup=clickNS;
		document.oncontextmenu=clickIE;
	} 

	document.oncontextmenu=new Function("return false") 

}


// Auto Reload current Page
//
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
//var limit=ntime;

function autoreload(limit)
{
	if (document.images)
	{
		var parselimit=limit.split(":")
		parselimit2=parselimit[0]*60+parselimit[1]*1
	}
	
	setTimeout("beginrefresh(parselimit2)",1000)

}

function beginrefresh(parselimit)
{
	if (!document.images)
		return
	if (parselimit==1)
	{
		var xmlhttp=false;
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

		if (!xmlhttp && typeof XMLHttpRequest!='undefined') 
		{
			try 
			{
				xmlhttp = new XMLHttpRequest();
			} 
			catch (e) 
			{
				xmlhttp=false;
			}
		}
		if (!xmlhttp && window.createRequest) 
		{
			try 
			{
				xmlhttp = window.createRequest();
			} 
			catch (e) 
			{
				xmlhttp=false;
			}
		}

		url = "../check.html";
		xmlhttp.open("HEAD", url,true);
		xmlhttp.onreadystatechange=function() 
		{
			if (xmlhttp.readyState==4) 
			{
				if (xmlhttp.status==200) 
				{
					window.location.reload()			
				}
				else 
				{
					parselimit2 = 60
					setTimeout("beginrefresh(parselimit2)",1000)
				}
			}
		}
		xmlhttp.send(null)
	}
	else
	{ 
		parselimit-=1
		curmin=Math.floor(parselimit/60)
		cursec=parselimit%60
		if (curmin!=0)
		{
			curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
		}
		else
		{
			curtime=cursec+" seconds left until page refresh!"
		}
		window.status=curtime
		parselimit2 = parselimit
		setTimeout("beginrefresh(parselimit2)",1000)
	}
}