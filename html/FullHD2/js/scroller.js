var content = new Array();
var heightarr1 = new Array();
var heightarr2 = new Array();
var psy1 = new Array();
var psy2 = new Array();
var toplay1=0;
var toplay2=0;
var innertxt="";

document.write("<div id=scroller style='position:absolute;background:#FFFFFF;width:1278; height:750;left:0; top:0;margin:0px;overflow:hidden;padding:0px;border-style:solid; border-width:0px; border-color:#5C5C5C;'></div>");
var host_scroller = document.getElementById('scroller');
var parent_scroller = document.createElement('div');
parent_scroller.id = "parent_scroller";
host_scroller.appendChild(parent_scroller);
document.getElementById('scroller').innerHTML="<div id=sub1 style='position:absolute;border-width:0px;'></div><div id=sub2 style='position:absolute;border-width:0px;'></div>";

function action()
{

	for(i=0;i<content.length;i++)
	{
		innertxt=innertxt+"<div id=d"+i+" style='width:1278;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
	}
	

	var host_sub1 = document.getElementById('sub1');
	if(document.getElementById('parent_sub1'))
	{
		var parent_sub1 = document.getElementById('parent_sub1');
		host_sub1.removeChild(parent_sub1);
	}
	var parent_sub1 = document.createElement('div');
	parent_sub1.id = "parent_sub1";
	host_sub1.appendChild(parent_sub1);	
	document.getElementById("parent_sub1").innerHTML=innertxt;	

	innertxt="";

	for(i=0;i<content.length;i++)
	{
		innertxt=innertxt+"<div id=dz"+i+" style='width:1278;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
	}
		
	var host_sub2 = document.getElementById('sub2');
	if(document.getElementById('parent_sub2'))
	{
		var parent_sub2 = document.getElementById('parent_sub2');
		host_sub2.removeChild(parent_sub2);
	}
	var parent_sub2 = document.createElement('div');
	parent_sub2.id = "parent_sub2";
	host_sub2.appendChild(parent_sub2);	
	document.getElementById("parent_sub2").innerHTML=innertxt;	

//******************************************************************************

		toplay1 = 4;
		psy1 = new Array();

		for(i=0;i<content.length;i++)
		{	
			heightarr1[i]=parseInt(document.getElementById('d'+i).offsetHeight);
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.top=toplay1+"px";
			psy1[toplay1]=3;
			toplay1=toplay1+heightarr1[i]+22;
		}

		document.getElementById('sub1').style.left=8+"px";
		document.getElementById('sub1').style.height=toplay1+"px";

		toplay2 = 4;
		psy2 = new Array();
		for(i=0;i<content.length;i++)
		{
			document.getElementById('dz'+i).innerHTML=content[i];
		}

		for(i=0;i<content.length;i++)
		{	
			heightarr2[i]=parseInt(document.getElementById('dz'+i).offsetHeight);
			document.getElementById('dz'+i).style.visibility="visible";
			document.getElementById('dz'+i).style.top=toplay2+"px";
			psy2[toplay2]=3;
			toplay2=toplay2+heightarr2[i]+22;
		}
	
		document.getElementById('sub2').style.left=8+"px";
		document.getElementById('sub2').style.height=toplay2+"px";

//************************************************************************************


	document.getElementById('sub1').style.top=0+"px";
	document.getElementById('sub2').style.top=document.getElementById('sub1').offsetHeight+"px";


	document.getElementById('sub1').style.width=1278+"px";
	document.getElementById('sub2').style.width=1278+"px";

docElement=null;

	doloop();
	//abc();

}

function doloop()
{
	
//*******************************************************************************************************************

	if (parseInt(document.getElementById('sub1').style.top)<(-1*toplay1))
	{
		document.getElementById('sub1').style.top=parseInt(document.getElementById('sub2').style.top)+toplay2+"px";

	}

//*******************************************************************************************************************

	if (parseInt(document.getElementById('sub1').style.top)==750)
	{
		toplay1 = 4;
		psy1 = new Array();

		innertxt="";

		for(i=0;i<content.length;i++)
		{
			innertxt=innertxt+"<div id=d"+i+" style='width:1278;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
		}

		var host_sub1 = document.getElementById('sub1');
		if(document.getElementById('parent_sub1'))
		{
			var parent_sub1 = document.getElementById('parent_sub1');
			host_sub1.removeChild(parent_sub1);
		}
		var parent_sub1 = document.createElement('div');
		parent_sub1.id = "parent_sub1";
		host_sub1.appendChild(parent_sub1);	
		document.getElementById("parent_sub1").innerHTML=innertxt;

/*
		for(i=0;i<content.length;i++)
		{
			document.getElementById('d'+i).innerHTML=content[i];
		}
*/

		for(i=0;i<content.length;i++)
		{	
			heightarr1[i]=parseInt(document.getElementById('d'+i).offsetHeight);
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.top=toplay1+"px";
			psy1[toplay1]=3;
			toplay1=toplay1+heightarr1[i]+22;
		}
	
		document.getElementById('sub1').style.left=8+"px";
		document.getElementById('sub1').style.height=toplay1+"px";
		//document.getElementById('sub1').style.top=document.getElementById('sub2').style.top+toplay2;
		//document.getElementById('sub1').style.top=750+"px";

	}

//*******************************************************************************************************************

	if (parseInt(document.getElementById('sub2').style.top)<(-1*toplay2))
	{
		document.getElementById('sub2').style.top=parseInt(document.getElementById('sub1').style.top)+toplay1+"px";
	}

//*******************************************************************************************************************

	if (parseInt(document.getElementById('sub2').style.top)==750)
	{
		toplay2 = 4;
		psy2 = new Array();

		innertxt="";
		for(i=0;i<content.length;i++)
		{
			innertxt=innertxt+"<div id=dz"+i+" style='width:1278;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
		}
			
		var host_sub2 = document.getElementById('sub2');
		if(document.getElementById('parent_sub2'))
		{
			var parent_sub2 = document.getElementById('parent_sub2');
			host_sub2.removeChild(parent_sub2);
		}
		var parent_sub2 = document.createElement('div');
		parent_sub2.id = "parent_sub2";
		host_sub2.appendChild(parent_sub2);	
		document.getElementById("parent_sub2").innerHTML=innertxt;	

/*
		for(i=0;i<content.length;i++)
		{
			document.getElementById('dz'+i).innerHTML=content[i];
		}

*/
		for(i=0;i<content.length;i++)
		{	
			heightarr2[i]=parseInt(document.getElementById('dz'+i).offsetHeight);
			document.getElementById('dz'+i).style.visibility="visible";
			document.getElementById('dz'+i).style.top=toplay2+"px";
			psy2[toplay2]=3;
			toplay2=toplay2+heightarr2[i]+22;
		}
	
		document.getElementById('sub2').style.left=8+"px";
		document.getElementById('sub2').style.height=toplay2+"px";
		//document.getElementById('sub2').style.top=document.getElementById('sub1').style.top+toplay1;
		//document.getElementById('sub2').style.top=750+"px";
	}

//*******************************************************************************************************************

	if(psy1[(parseInt(document.getElementById('sub1').style.top)*(-1))]==3 || psy2[(parseInt(document.getElementById('sub2').style.top)*(-1))]==3)
	{
	        setTimeout('doloop()',5000);
	}

	else

	{
	        setTimeout('doloop()',35);
	}

	document.getElementById('sub1').style.top = parseInt(document.getElementById('sub1').style.top) - 1 + "px";
	document.getElementById('sub2').style.top = parseInt(document.getElementById('sub2').style.top) - 1 + "px";

//	document.getElementById('sub1').style.top--;
//	document.getElementById('sub2').style.top--;

}
