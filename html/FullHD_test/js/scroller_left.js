var content = new Array();
var heightarr1 = new Array();
var heightarr2 = new Array();
var psy1 = new Array();
var psy2 = new Array();
var toplay1=0;
var toplay2=0;
var innertxt="";

document.write("<div id=scroller style='position:absolute;background:#FFFFFF;width:1278; height:65;left:0; top:0;margin:0px;overflow:hidden;nowrap;padding:0px;border-style:solid; border-width:0px; border-color:#5C5C5C;'></div>");
var host_scroller = document.getElementById('scroller');
var parent_scroller = document.createElement('div');
parent_scroller.id = "parent_scroller";
host_scroller.appendChild(parent_scroller);
document.getElementById('parent_scroller').innerHTML="<div id=sub1 nowrap style='height:65;position:absolute;margin:0px;top:0;border-width:0px;'></div><div id=sub2 nowrap style='height:65;position:absolute;margin:0px;top:0;border-width:0px;'></div>";

function action()
{
	document.getElementById('sub1').style.width="100000px";
	document.getElementById('sub2').style.width="100000px";
	for(i=0;i<content.length;i++)
	{
		innertxt=innertxt+"<div id=d"+i+" style=' nowrap;height:65;position:absolute;margin:0px;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
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
		innertxt=innertxt+"<div id=dz"+i+" style='nowrap;height:65;position:absolute;margin:0px;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
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


		toplay1 = 4;
		psy1 = new Array();

		for(i=0;i<content.length;i++)
		{	
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.left=toplay1+"px";
			heightarr1[i]=document.getElementById('d'+i).offsetWidth;			
			psy1[toplay1]=3;
			toplay1=parseInt(toplay1)+parseInt(heightarr1[i])+160;
		}

		//document.getElementById('sub1').style.Top=8+"px";
		document.getElementById('sub1').style.width=toplay1+"px";

		toplay2 = 4;
		psy2 = new Array();
		for(i=0;i<content.length;i++)
		{
			document.getElementById('dz'+i).innerHTML=content[i];
		}

		for(i=0;i<content.length;i++)
		{	
			heightarr2[i]=parseInt(document.getElementById('dz'+i).offsetWidth);
			document.getElementById('dz'+i).style.visibility="visible";
			document.getElementById('dz'+i).style.left=toplay2+"px";
			psy2[toplay2]=3;
			toplay2=toplay2+heightarr2[i]+160;
		}
	
		//document.getElementById('sub2').style.top=8+"px";
		document.getElementById('sub2').style.width=toplay2+"px";

//************************************************************************************


	document.getElementById('sub1').style.left=0+"px";
	document.getElementById('sub2').style.left=document.getElementById('sub1').offsetWidth+"px";


	document.getElementById('sub1').style.height=1278+"px";
	document.getElementById('sub2').style.height=1278+"px";

	doloop();
	//abc();

}

function doloop()
{
	
//*******************************************************************************************************************

	if (parseInt(document.getElementById('sub1').style.left)<(-1*toplay1))
	{
		document.getElementById('sub1').style.left=parseInt(document.getElementById('sub2').style.left)+toplay2+"px";

	}

//*******************************************************************************************************************

	if (parseInt(document.getElementById('sub1').style.left)==1278)
	{
		toplay1 = 4;
		psy1 = new Array();

		innertxt="";

		for(i=0;i<content.length;i++)
		{
			innertxt=innertxt+"<div id=d"+i+" style='nowrap;Height:65;position:absolute;margin:0px;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
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
			document.getElementById('d'+i).innerHTML=content[0];
		}
*/

		for(i=0;i<content.length;i++)
		{	
			heightarr1[i]=parseInt(document.getElementById('d'+i).offsetWidth);
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.left=toplay1+"px";
			psy1[toplay1]=3;
			toplay1=toplay1+heightarr1[i]+160;
		}
	
		//document.getElementById('sub1').style.Top=8+"px";
		document.getElementById('sub1').style.width=toplay1+"px";

	}

//*******************************************************************************************************************

	if (parseInt(document.getElementById('sub2').style.left)<(-1*toplay2))
	{
		document.getElementById('sub2').style.left=parseInt(document.getElementById('sub1').style.left)+toplay1+"px";
	}

//*******************************************************************************************************************

	if (parseInt(document.getElementById('sub2').style.left)==1278)
	{
		toplay2 = 4;
		psy2 = new Array();

		innertxt="";
		for(i=0;i<content.length;i++)
		{
			innertxt=innertxt+"<div id=dz"+i+" style='nowrap;height:65;position:absolute;margin:0px;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
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
			document.getElementById('dz'+i).innerHTML=content[0];
		}

*/
		for(i=0;i<content.length;i++)
		{	
			heightarr2[i]=parseInt(document.getElementById('dz'+i).offsetWidth);
			document.getElementById('dz'+i).style.visibility="visible";
			document.getElementById('dz'+i).style.left=toplay2+"px";
			psy2[toplay2]=3;
			toplay2=toplay2+heightarr2[i]+160;
		}
	
		//document.getElementById('sub2').style.Top=8+"px";
		document.getElementById('sub2').style.width=toplay2+"px";
	}

//*******************************************************************************************************************

	if(psy1[(parseInt(document.getElementById('sub1').style.left)*(-1))]==3 || psy2[(parseInt(document.getElementById('sub2').style.left)*(-1))]==3)
	{
	        setTimeout('doloop()',2000);
	}

	else

	{
	        setTimeout('doloop()',10);
	}

	document.getElementById('sub1').style.left = parseInt(document.getElementById('sub1').style.left) - 1 + "px";
	document.getElementById('sub2').style.left = parseInt(document.getElementById('sub2').style.left) - 1 + "px";



}
