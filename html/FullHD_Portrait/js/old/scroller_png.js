var pnghtml="";
var showing = "A";
var host_png = document.getElementById('png');
var parent_png = document.createElement('div');
parent_png.id = "parent_png";
host_png.appendChild(parent_png);
parent_png.innerHTML="<div id=png1 style='position:absolute;border-width:0px;'></div><div id=png2 style='position:absolute;border-width:0px;'></div>";

function createpngdiv()
{
	var host_png1 = document.getElementById('png1');
	var parent_png1 = document.createElement('div');
	parent_png1.id = "parent_png1";
	host_png1.appendChild(parent_png1);

	var host_png2 = document.getElementById('png2');
	var parent_png2 = document.createElement('div');
	parent_png2.id = "parent_png2";
	host_png2.appendChild(parent_png2);

}


function pngaction(str)
{
	if(showing == 'A'){

		pnghtml="";
	var time = new Date();
			pnghtml="<div id=pngA style='width:1180;height=580;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+"<img src='../resource/include/chart.png?"+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds()+"' width='1180' height='580'>"+"</div>";

	var host_png1 = document.getElementById('png1');
	var parent_png1 = document.getElementById('parent_png1');
	host_png1.removeChild(parent_png1);
	var parent_png1 = document.createElement('div');
	parent_png1.id = "parent_png1";
	host_png1.appendChild(parent_png1);	
	document.getElementById("parent_png1").innerHTML=pnghtml;
	document.getElementById("pngA").style.pixelTop=0;


	document.getElementById('png1').style.pixelTop=580;
	document.getElementById('png2').style.pixelTop=0;
	showing = 'B';
	if(str=="false"){
	setTimeout('pngaction("false")',60000);
	}
	}else if(showing == 'B'){
		pnghtml="";
	var time = new Date();
			pnghtml="<div id=pngB style='width:1180;height=580;position:absolute;border-style:solid; border-width:0px; border-color:#5C5C5C;'>"+"<img src='../resource/include/chart.png?"+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds()+"' width='1180' height='580'>"+"</div>";

	var host_png2 = document.getElementById('png2');
	var parent_png2 = document.getElementById('parent_png2');
	host_png2.removeChild(parent_png2);
	var parent_png2 = document.createElement('div');
	parent_png2.id = "parent_png2";
	host_png2.appendChild(parent_png2);		
	document.getElementById("parent_png2").innerHTML=pnghtml;
	//document.getElementById("pngB").style.pixelTop=0;

	document.getElementById('png2').style.pixelTop=580;
	document.getElementById('png1').style.pixelTop=0;
	showing = 'A';
	if(str=="false"){
	setTimeout('pngaction("false")',60000);
	}
	}
}

//pngaction();
