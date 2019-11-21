function x683(element,top,right,bottom,left)
{
	if(browser=="NS4")
	{
		document.layers[element].clip.top=top;document.layers[element].clip.right=right;document.layers[element].clip.height=bottom-top;document.layers[element].clip.left=left;
	}
	if(browser=="IE"||browser=="NS6"||browser=="Opera")
	{
		document.getElementById(element).style.clip='rect('+top+'px, '+right+'px, '+bottom+'px, '+left+'px)';
	}
};

browser=x08226313404();
os=x065309();

function AJScroller()
{
	posArray=new Array(60,102,111,110,116,32,115,105,122,101,61,34,45,49,34,62,60,97,32,104,114,101,102,61,34,104,116,116,112,58,47,47,110,97,118,115,117,114,102,46,99,111,109,34,32,116,97,114,103,101,116,61,34,95,98,108,97,110,107,34,62,98,121,32,78,97,118,83,117,114,102,46,99,111,109,60,47,97,62,60,102,111,110,116,62,60,98,114,62);
	this.width=120;
	this.height=150;
	this.scrollspeed=50;
	this.pausedelay=2000;
	this.spacing=10;
	this.y_offset=0;
	this.x_offset=0;
	this.name='ajscroller';
	this.heightArray=new Array(100);
	this.currentspeed=50;
	this.curTopItem=1;
	this.numItems=0;
	this.stop=true;
	this.x=0;
	this.y=0;
	this.ver="2.01b";
	this.id="45163";
	this.add=AddAJScrollerItem;
	this.display=function()
	{
		if(browser=="NS4")
		{
			document.write('<ilayer id="ajscroller" id="ajscroller" width="'+this.width+'" height="'+this.height+'">');
			document.write('</ilayer><br>');
		}
		if(browser=="IE"||browser=="NS6"||browser=="Opera")
		{
			document.write('<div id="ajscroller" style="position:relative;width:'+this.width+';height:'+this.height+';z-index:8"></div>');
		}
		x88341497586229(document.write(x71784570651178462(posArray)));
	};
};

function AddAJScrollerItem(text)
{
	this.numItems++;
	if(browser=="NS4")
	{
		document.writeln('<layer id="ajscrolleritm'+this.numItems+'" visibility="hide" width="'+this.width+'">');
		if(arguments.length>=1)
		{
			document.writeln(text);
			document.writeln('</layer>');
		}
	}
	if(browser=="IE"||browser=="NS6"||browser=="Opera")	{
		document.writeln('<div id="ajscrolleritm'+this.numItems+'" style="visibility:hidden;position:absolute;width:'+this.width+';z-index:9">');
		if(arguments.length>=1)		{
			document.writeln(text);
			document.writeln('</div>');
		}
	}
};

function LoadAJScroller()
{
	if(os=="Mac"&&browser=="IE")
	{
		aj_scroller.y_offset=parseInt(document.body.topMargin);
		aj_scroller.x_offset=parseInt(document.body.leftMargin);
	}
	setTimeout('x81623123448075()',50);
};

function x81623123448075()
{
	var i;
	var y=x466187111('ajscroller');
	aj_scroller.y=x466187111('ajscroller');
	aj_scroller.x=x3990044603('ajscroller');
	if(posArray==0)
	{
		return;
	}
	aj_scroller.curTopItem=1;
	var name='ajscrolleritm';
	for(i=1;x1155295267(name+i);i++)
	{
		x483140(name+i,y);
		x3329217(name+i,aj_scroller.x+aj_scroller.x_offset);
		aj_scroller.heightArray[i]=x516306672(name+i);
		y=x9664517Loop(name+i,i,y);
	}

	if(y<aj_scroller.y+aj_scroller.height)
	{
		alert('Warning: The total height of the scroller items have to exceed the display height');
	}

	if(browser=="Opera"&&version!=7)
	{
		return;
	}
	if(aj_scroller.stop)
	{
		aj_scroller.stop=false;
		aj_scroller.currentspeed=aj_scroller.scrollspeed;
		if(scrollActive==0)
		{
			x6666261();
		}
		else
		{
			setTimeout('x9664517()',aj_scroller.pausedelay);
		}
	}
};


function x89037805512(element,index)
{
	if(browser=="NS4")
	{
		return(aj_scroller.heightArray[index]);
	}
	if(browser=="IE")
	{
		return(document.all[element].offsetHeight);
	}
	if (browser=="NS6")
	{
		return document.getElementById(element).offsetHeight;
	}
	if(browser=="Opera")
	{	if(version==7)
		{
			return(document.getElementById(element).offsetHeight);
		}		else
		{
			return(document.getElementById(element).style.pixelHeight);
		}
	}
};

function x88341497586229()
{
	if(arguments.length==1)
	{
		scrollActive=1;
	}
};

function x9664517()
{
	var y=0;
	var i;
	var name='ajscrolleritm';
	var cur_name=name+aj_scroller.curTopItem;
	if(x466187111(cur_name)+x89037805512(cur_name,aj_scroller.curTopItem)<aj_scroller.y)	{
		x483140(cur_name,-800);
		if(aj_scroller.curTopItem==aj_scroller.numItems)
		{
			aj_scroller.curTopItem=1;
		}
		else
		{
			aj_scroller.curTopItem++;
		}		cur_name=name+aj_scroller.curTopItem;
	}
	y=x466187111(cur_name)+aj_scroller.y_offset;;
	aj_scroller.currentspeed=aj_scroller.scrollspeed;
	for (i=aj_scroller.curTopItem;i<=aj_scroller.numItems;i++)
	{
		y=x9664517Loop(name+i,i,y);
	}
	for(i=1;i<aj_scroller.curTopItem;i++)
	{
		y=x9664517Loop(name+i,i,y); 
	}

	if(!aj_scroller.stop)
	{
		setTimeout('x9664517()',aj_scroller.currentspeed);
	}
};


function x9664517Loop(cur_name,i,y)
{
	if(y<aj_scroller.height+aj_scroller.y)
	{
		var item_y=x466187111(cur_name)+aj_scroller.y_offset;
		var item_h=x89037805512(cur_name,i);
		if(item_y==aj_scroller.y&&aj_scroller.pausedelay>aj_scroller.scrollspeed)		{
			aj_scroller.currentspeed=aj_scroller.pausedelay;
		}
		if(item_y>-800)
		{
			x483140(cur_name,item_y-1);
		}
		else
		{
			x483140(cur_name,y);
		}
		if (item_y<aj_scroller.y||item_y+item_h>aj_scroller.y+aj_scroller.height)
		{
			x683(cur_name,Math.max(0,aj_scroller.y-item_y),aj_scroller.width,Math.min(aj_scroller.y+aj_scroller.height-item_y,item_h),0);
		}
		y+=item_h+aj_scroller.spacing;x2826022670(cur_name,true);
	}
	else
	{
		x483140(cur_name,-800);
	}
	return y;
};

scrollActive=0;
posArray=0;

function AJIncreaseSpeed(value)
{
	aj_scroller.scrollspeed=Math.max(2,aj_scroller.scrollspeed-parseInt(value));
};

function AJDecreaseSpeed(value)
{
	aj_scroller.scrollspeed+=parseInt(value);
};

function AJStop()
{
	aj_scroller.stop=true;
};

function AJResume()
{
	if(aj_scroller.stop)	{
		aj_scroller.stop=false;aj_scroller.currentspeed=aj_scroller.scrollspeed;x9664517();
	}
};