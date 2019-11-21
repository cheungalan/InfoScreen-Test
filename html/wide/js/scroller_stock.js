var content = new Array();
var heightarr1 = new Array();
var heightarr2 = new Array();
var psy1 = new Array();
var psy2 = new Array();
var toplay1=0;
var toplay2=0;
var innertxt="";

//document.write("<div id=scroller style='position:absolute;background:#FFFFFF;width:1160; height:208;left:0; top:0;margin:0px;overflow:hidden;padding:0px;border-style:solid; border-width:0px; border-color:#5C5C5C;'></div>");
//document.write("<div id='spageie' style='position:absolute; width:1160; height:208; left:0; top:0; border-width:0px; overflow:hidden;clip:rect(4 2255 203 0);'></div></div>");
var host_scroller = document.getElementById('scroller');
var parent_scroller = document.createElement('div');
parent_scroller.id = "parent_scroller";
host_scroller.appendChild(parent_scroller);
parent_scroller.innerHTML="<div id=sub1 style='position:absolute;border-width:0px;'></div><div id=sub2 style='position:absolute;border-width:0px;'></div><div id=sub3 style='position:absolute;border-width:0px;'></div><div id=sub4 style='position:absolute;border-width:0px;'></div><div id=sub5 style='position:absolute;border-width:0px;'></div>";

function creatediv()
{
	var host_sub1 = document.getElementById('sub1');
	var parent_sub1 = document.createElement('div');
	parent_sub1.id = "parent_sub1";
	host_sub1.appendChild(parent_sub1);

	var host_sub2 = document.getElementById('sub2');
	var parent_sub2 = document.createElement('div');
	parent_sub2.id = "parent_sub2";
	host_sub2.appendChild(parent_sub2);

	var host_sub3 = document.getElementById('sub3');
	var parent_sub3 = document.createElement('div');
	parent_sub3.id = "parent_sub3";
	host_sub3.appendChild(parent_sub3);

	var host_sub4 = document.getElementById('sub4');
	var parent_sub4 = document.createElement('div');
	parent_sub4.id = "parent_sub4";
	host_sub4.appendChild(parent_sub4);

	var host_sub5 = document.getElementById('sub5');
	var parent_sub5 = document.createElement('div');
	parent_sub5.id = "parent_sub5";
	host_sub5.appendChild(parent_sub5);


}


function action()
{
	innertxt="";

	for(i=0;i<9;i++)
	{
		innertxt=innertxt+"<div id=d"+i+" style='width:903;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
	}

	var host_sub1 = document.getElementById('sub1');
	var parent_sub1 = document.getElementById('parent_sub1');
	host_sub1.removeChild(parent_sub1);
	var parent_sub1 = document.createElement('div');
	parent_sub1.id = "parent_sub1";
	host_sub1.appendChild(parent_sub1);	
	document.getElementById("parent_sub1").innerHTML=innertxt;
	//alert(document.getElementById('sub1').innerHTML);

	innertxt="";

	for(i=9;i<18;i++)
	{
		innertxt=innertxt+"<div id=d"+i+" style='width:903;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
	}

	var host_sub2 = document.getElementById('sub2');
	var parent_sub2 = document.getElementById('parent_sub2');
	host_sub2.removeChild(parent_sub2);
	var parent_sub2 = document.createElement('div');
	parent_sub2.id = "parent_sub2";
	host_sub2.appendChild(parent_sub2);		
	document.getElementById("parent_sub2").innerHTML=innertxt;


	innertxt="";

	for(i=18;i<27;i++)
	{
		innertxt=innertxt+"<div id=d"+i+" style='width:903;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
	}

	var host_sub3 = document.getElementById('sub3');
	var parent_sub3 = document.getElementById('parent_sub3');
	host_sub3.removeChild(parent_sub3);
	var parent_sub3 = document.createElement('div');
	parent_sub3.id = "parent_sub3";
	host_sub3.appendChild(parent_sub3);		
	document.getElementById("parent_sub3").innerHTML=innertxt;



	innertxt="";

	for(i=27;i<36;i++)
	{
		innertxt=innertxt+"<div id=d"+i+" style='width:903;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
	}

	var host_sub4 = document.getElementById('sub4');
	var parent_sub4 = document.getElementById('parent_sub4');
	host_sub4.removeChild(parent_sub4);
	var parent_sub4 = document.createElement('div');
	parent_sub4.id = "parent_sub4";
	host_sub4.appendChild(parent_sub4);		
	document.getElementById("parent_sub4").innerHTML=innertxt;


	innertxt="";

	for(i=36;i<43;i++)
	{
		innertxt=innertxt+"<div id=d"+i+" style='width:903;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+content[i]+"</div>";
	}

	var host_sub5 = document.getElementById('sub5');
	var parent_sub5 = document.getElementById('parent_sub5');
	host_sub5.removeChild(parent_sub5);
	var parent_sub5 = document.createElement('div');
	parent_sub5.id = "parent_sub5";
	host_sub5.appendChild(parent_sub5);
	document.getElementById("parent_sub5").innerHTML=innertxt;

		toplay1 = 0;
		heightarr1 = new Array();
		
		for(i=0;i<9;i++)
		{	
			heightarr1[i]=parseInt(document.getElementById('d'+i).offsetHeight);
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.pixelTop=toplay1;
			toplay1=toplay1+heightarr1[i]+2;
		}

		document.getElementById('sub1').style.left=8+"px";
		document.getElementById('sub1').style.height=toplay1+"px";

		toplay1 = 0;
		heightarr1 = new Array();

		for(i=9;i<18;i++)
		{	

			heightarr1[i]=parseInt(document.getElementById('d'+i).offsetHeight);
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.pixelTop=toplay1;
			toplay1=toplay1+heightarr1[i]+2;
		}

		document.getElementById('sub2').style.left=8+"px";
		document.getElementById('sub2').style.height=toplay1+"px";

		toplay1 = 0;
		heightarr1 = new Array();

		for(i=18;i<27;i++)
		{	

			heightarr1[i]=parseInt(document.getElementById('d'+i).offsetHeight);
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.pixelTop=toplay1;
			toplay1=toplay1+heightarr1[i]+2;
		}

		document.getElementById('sub3').style.left=8+"px";
		document.getElementById('sub3').style.height=toplay1+"px";

		toplay1 = 0;
		heightarr1 = new Array();

		for(i=27;i<36;i++)
		{	

			heightarr1[i]=parseInt(document.getElementById('d'+i).offsetHeight);
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.pixelTop=toplay1;
			toplay1=toplay1+heightarr1[i]+2;
		}

		document.getElementById('sub4').style.left=8+"px";
		document.getElementById('sub4').style.height=toplay1+"px";

		toplay1 = 0;
		heightarr1 = new Array();

		for(i=36;i<43;i++)
		{	

			heightarr1[i]=parseInt(document.getElementById('d'+i).offsetHeight);
			document.getElementById('d'+i).style.visibility="visible";
			document.getElementById('d'+i).style.pixelTop=toplay1;
			toplay1=toplay1+heightarr1[i]+2;
		}

		document.getElementById('sub5').style.left=8+"px";
		document.getElementById('sub5').style.height=toplay1+"px";


	document.getElementById('sub1').style.pixelTop=4;
	document.getElementById('sub2').style.pixelTop=document.getElementById('sub1').offsetHeight+4;
	document.getElementById('sub3').style.pixelTop=document.getElementById('sub1').offsetHeight+document.getElementById('sub2').offsetHeight+4;
	document.getElementById('sub4').style.pixelTop=document.getElementById('sub1').offsetHeight+document.getElementById('sub2').offsetHeight+document.getElementById('sub3').offsetHeight+4;
	document.getElementById('sub5').style.pixelTop=document.getElementById('sub1').offsetHeight+document.getElementById('sub2').offsetHeight+document.getElementById('sub3').offsetHeight+document.getElementById('sub4').offsetHeight+4;
	document.getElementById('sub1').style.width=903+"px";
	document.getElementById('sub2').style.width=903+"px";
	document.getElementById('sub3').style.width=903+"px";
	document.getElementById('sub4').style.width=903+"px";
	document.getElementById('sub5').style.width=903+"px";

docElement=null;

	doloop();
	//abc();

}

function doloop()
{

	if (document.getElementById('sub5').style.pixelTop!=0){
		if(document.getElementById('sub1').style.pixelTop==0 || document.getElementById('sub2').style.pixelTop==0 || document.getElementById('sub3').style.pixelTop==0 || document.getElementById('sub4').style.pixelTop==0)
		{
		        setTimeout('doloop()',16000);
	
		}
	
		else
	
		{
		        setTimeout('doloop()',1);
		}
	
		document.getElementById('sub1').style.pixelTop-=4;
		document.getElementById('sub2').style.pixelTop-=4;
		document.getElementById('sub3').style.pixelTop-=4;
		document.getElementById('sub4').style.pixelTop-=4;
		document.getElementById('sub5').style.pixelTop-=4;

	}
}
