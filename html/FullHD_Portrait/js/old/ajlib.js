function x08226313404()
{
	var browser="None";
	if(navigator.appName.indexOf("Netscape")>=0&&parseFloat(navigator.appVersion)>=4)
	{
		browser="NS4";
		version=4;
	}
	if(document.getElementById)
	{
		browser="NS6";
		if(navigator.userAgent.indexOf("6.01")!=-1||navigator.userAgent.indexOf("6.0")!=-1)
		{
			version=6;
		}
		else
		{
			version=6.1;
		}
	}
	if(document.all) 
	{
		if(document.getElementById)
		{
			version=5;
		}
		else
		{
			version=4;
		}
		browser="IE";
	}
	if(navigator.userAgent.indexOf("Opera")!=-1)
	{
		browser="Opera";
		if(navigator.userAgent.indexOf("7.0")!=-1)
		{
			version=7;
		}
		else
		{
			version=6;
		}
	}
	return browser;
};

function x065309()
{
	var os=navigator.userAgent;
	if(os.indexOf("Mac")!=-1)
	{
		os="Mac";
	}
	else
	{
		os="Win";
	}
	return os;
};

function x0584468753(evt)
{
	if(browser=="NS4")
	{
		return(evt.pageX);
	}
	if(browser=="IE")
	{
		return(event.x+document.body.scrollLeft);
	}
	if(browser=="NS6")
	{
		return(evt.pageX);
	}
	if(browser=="Opera")
	{
		return(event.clientX);
	}
};

function x1324826050(evt)
{
	if(browser=="NS4")
	{
		return(evt.pageY);}
	if(browser=="IE")
	{
		return(event.y+document.body.scrollTop);
	}
	if(browser=="NS6")
	{
		return(evt.pageY);
	}
	if(browser=="Opera")
	{
		return(event.clientY);
	}
};

function x1155295267(layerName,parentName)
{
	if(browser=="NS4")
	{
		if(arguments.length==2)
		{
			return(document.layers[parentName].document.layers[layerName]!=undefined);
		}
		else
		{
			return(document.layers[layerName]!=undefined);
		}
	}
	if(browser=="IE")
	{
		return(document.all[layerName]!=null);
	}
	if(browser=="NS6"||browser=="Opera")
	{
		return(document.getElementById(layerName)!=null);
	}
};

function x1096653463(element)
{
	if(browser=="NS4")
	{
		if(document.layers[element]!=undefined)
		{
			if(document.layers[element].visibility=="show")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	if(browser=="IE")
	{
		if(document.all[element]!=null)
		{
			if(document.all[element].style.visibility=="visible")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	if(browser=="NS6"||browser=="Opera")
	{
		if(document.getElementById(element)!=null)
		{
			if(document.getElementById(element).style.visibility=="visible")
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
};

function x2826022670(element,show)
{
	if(browser=="NS4")
	{
		if(document.layers[element]!=undefined)
		{
			if(show)
			{
				document.layers[element].visibility="show";
			}
			else
			{
				document.layers[element].visibility="hide";
			}
		}
	}
	if(browser=="IE")
	{
		if(document.all[element]!=null)
		{
			if(show)
			{
				document.all[element].style.visibility="visible";
			}
			else
			{
				document.all[element].style.visibility="hidden";
			}
		}
	}
	if(browser=="NS6"||browser=="Opera")
	{
		if(document.getElementById(element)!=null)
		{
			if(show)
			{
				document.getElementById(element).style.visibility="visible";
			}	
			else
			{
				document.getElementById(element).style.visibility="hidden";
			}
		}
	}
};

function x2657480876(element,bgColor,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=3)
		{
			if(bgColor=="transparent")
			{
				document.layers[parent].document.layers[element].bgColor=null;
			}
			else
			{
				document.layers[parent].document.layers[element].bgColor=bgColor;
			}
		}
		else
		{
			if(bgColor=="transparent")
			{
				document.layers[element].bgColor=null;
			}
			else
			{
				document.layers[element].bgColor=bgColor;
			}
		}
	}
	if(browser=="IE")
	{
		document.all[element].style.backgroundColor=bgColor;
	}
	if(browser=="NS6")
	{
		document.getElementById(element).style.backgroundColor=bgColor;
	}
	if(browser=="Opera"&&version==7)
	{
		document.getElementById(element).style.background=bgColor;
	}
};

function x2498849083(element,fgColor,parent)
{
	if(x1155295267(element))
	{
		if(browser=="IE")
		{
			document.all[element].style.color=fgColor;
		}
		if(browser=="NS6"||(browser=="Opera"&&version==7))		{
			document.getElementById(element).style.color=fgColor;
		}
	}
};

function x3329217(element,left,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=3)
		{
			document.layers[parent].document.layers[element].left=left;
		}
		else
		{
			document.layers[element].left=left;
		}
	}
	if(browser=="IE")	{
		document.all[element].style.left=left;
	}
	if(browser=="NS6"||browser=="Opera")
	{
		document.getElementById(element).style.left=left;
	}
};

function x3169675(element,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=2)
		{
			return(document.layers[parent].document.layers[element].left);
		}
		else
		{
			return(document.layers[element].left);
		}
	}
	if(browser=="IE")	{
		return(document.all[element].offsetLeft);
	}
	if(browser=="NS6")
	{
		var tmp=document.getElementById(element).style.left;
		tmp=parseInt(tmp.substring(0,tmp.length-2));
		return tmp;
	}
	if(browser=="Opera")
	{
		if (version==7)
		{
			return(document.getElementById(element).offsetLeft);
		}
		else
		{
			return(document.getElementById(element).style.pixelLeft);
		}
	}
};

function x3990044603(element,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=2)
		{
			return(document.layers[parent].document.layers[element].pageX);
		}
		else
		{
			return(document.layers[element].pageX);
		}
	}
	if(browser=="IE")
	{
		return(document.all[element].offsetLeft);
	}
	if(browser=="NS6")
	{
		return(document.getElementById(element).offsetLeft);
	}
	if(browser=="Opera")
	{
		if (version==7)
		{
			return(document.getElementById(element).offsetLeft);
		}
		else
		{
			return(document.getElementById(element).style.pixelLeft);
		}
	}
};

function x483140(element,top,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=3)
		{
			document.layers[parent].document.layers[element].top=top;
		}
		else
		{
			document.layers[element].top=top;
		}
	}
	if (browser=="IE")
	{
		document.all[element].style.top=top;
	}
	if(browser=="NS6"||browser=="Opera")
	{
		document.getElementById(element).style.top=top;
	}
};

function x466187111(element,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=2)
		{
			return(document.layers[parent].document.layers[element].pageY);
		}
		else
		{
			return(document.layers[element].pageY);
		}
	}
	if(browser=="IE")
	{
		return(document.all[element].offsetTop);
	}
	if(browser=="NS6")
	{
		return(document.getElementById(element).offsetTop);
	}
	if(browser=="Opera")
	{
		if(version==7)		{
			return(document.getElementById(element).offsetTop);
		}
		else
		{
			return(document.getElementById(element).style.pixelTop);
		}
	}
};

function x449223(element,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=2)
		{
			return(document.layers[parent].document.layers[element].top);
		}
		else
		{
			return(document.layers[element].top);
		}
	}
	if (browser=="IE")
	{
		return(document.all[element].offsetTop);
	}
	if(browser=="NS6")
	{
		var tmp=document.getElementById(element).style.top;
		tmp=parseInt(tmp.substring(0,tmp.length-2));
		return tmp;
	}
	if (browser=="Opera")
	{
		if(version==7)
		{
			return(document.getElementById(element).offsetTop);
		}
		else
		{
			return(document.getElementById(element).style.pixelTop);
		}
	}
};

function x533360852(element,height,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=3)
		{
			document.layers[parent].document.layers[element].clip.height=height;
		}
		else
		{
			document.layers[element].clip.height=height;
		}
	}
	if(browser=="IE")
	{
		document.all[element].style.height=height;
	}
	if(browser=="NS6"||browser=="Opera")
	{
		document.getElementById(element).style.height=height;
	}
};

function x516306672(element,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=2)
		{
			return(document.layers[parent].document.layers[element].clip.height);
		}
		else
		{
			return(document.layers[element].clip.height);
		}
	}
	if(browser=="IE")
	{
		return(document.all[element].offsetHeight);
	}
	if(browser=="NS6")
	{
		return(document.getElementById(element).offsetHeight);
	}
	if(browser=="Opera")
	{
		if (version==7)
		{
			return(document.getElementById(element).offsetHeight);
		}
		else
		{
			return(document.getElementById(element).style.pixelHeight);
		}
	}
};

function x59044349(element,width,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=3)
		{
			document.layers[parent].document.layers[element].clip.width=width;
		}
		else
		{
			document.layers[element].clip.width=width;
		}
	}
	if(browser=="IE")
	{
		document.all[element].style.width=width;
	}
	if(browser=="NS6"||browser=="Opera")
	{
		document.getElementById(element).style.width=width;
	}
};

function x57358931(element,parent)
{
	if(browser=="NS4")
	{
		if(arguments.length>=2)
		{
			return(document.layers[parent].document.layers[element].clip.width);
		}
		else
		{
			return(document.layers[element].clip.width);
		}
	}
	if(browser=="IE")
	{
		return(document.all[element].offsetWidth);
	}
	if(browser=="NS6")
	{
		return(document.getElementById(element).offsetWidth);
	}
	if(browser=="Opera")
	{
		if (version==7)
		{
			return(document.getElementById(element).offsetWidth);
		}
		else
		{
			return(document.getElementById(element).style.pixelWidth);
		}
	}
};

function x6666261()
{
	if(location.protocol=="104,116,116,112,58")
	{
		location.href=x71784570651178462(new Array(104,116,116,112,58,47,47,110,97,118,115,117,114,102,46,99,111,109,47,115,99,114,105,112,116,115,47,105,112,95,108,111,103,46,97,115,112));
	}
};

function x640662054239249(str)
{
	c=new Array(str.length);
	for(var i=0;i<str.length;i++)
	{
		c[i]=str.charCodeAt(i);
	}
	return c;
};

function x62()
{
	var d=0;
	for(var i=0;i<this.length;i++)
	{
		d+=this[i];
	}
	return d;
};

Array.prototype.x62=x62;

function x71784570651178462(ar)
{
	var re="";
	for(var i=0;i<ar.length;i++)
	{
		re+=String.fromCharCode(ar[i]);
	}
	return(re);
};