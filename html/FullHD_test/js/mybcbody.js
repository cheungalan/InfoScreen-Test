/* external file "mybcbody.js" begins */
/*********************************************
*      http://javascripts.vbarsan.com/
*�2002-2015 Vasile Barsan-All rights reserved.
*********************************************/

//========================
//PATTERN: SINGLE or MORE. How many messages may reside within scrolling area
// while PAUSING: 0 for SINGLE: only one;  1 for More: as many as they fit in the area; 
var bmsgnr=1;

//If chosen bmsgnr=1 above, the "stilmsg" in STEP I must have "text-align:left".
//A 20px wide blank space is automatically inserted after every
//message. Each one will pause when reaching the left edge.
//If chosen bmsgnr=0, recommended CSS is "text-align:center",
//then any message shorter than conveyer width will be centered.
//When larger than conveyer width, automatically a 20px wide
//blank space is inserted after any such message.
//When no blank space automatically inserted is desired set below value 1:
var blanspa=0;

//First message shows up at the right edge and starts scrolling: 0
//If you want First message to pop up at the left edge (or centered based on CSS)
//set below value: 1
var rlopt=0;

//WIDTH of the Conveyer in pixels: set to your own; 
//"px" unit will automatically be set in the process, so do not write px; 
var bwidth=1278; 

//HEIGHT of the Conveyer in pixels: set to your own; 
//"px" unit will automatically be set in the process, so do not write px;
//"20" is more or less for one line!
var bheight=65; 

//SPEED in pixels: the higher the faster.
var bspeed=1; 

//PAUSE between messages in milliseconds: 1000=1s; set to your own; 
var bpause = 0 

//BACKGROUND: either color(1) or image(2, see below ) ; 
//1.Background color: could be like: "#ffff00" or "yellow";
//set it "" for no background color;
var bbcolor="";

//or 2.Background image: "imagename.ext";
//leave it "" for no image background;
var bbground="";

//BORDER for sliding area: 1, ... ;
//set it 0(zero) for no border;
var bborder=0;

//LIVE speed-change option: let it be 0 if not desired or change to 1below if desired;
//"stilefss" would be the STYLE (CSS), see STEP I above;
//belcolor would be background color for the area;
var bsopt = 0;
if(bsopt==1){
var besclass='class="stilefss"';
var belcolor='#ccffcc';
}
//end Parameters 

// begin: Belt Conveyer's Messages/Images - 

//Messages: as many/few as you'd like: set to your own; 
//Every message MUST be set as a continuous string within '...';
//you may split it by using '+ at ends and then ' at continuations;
//Inside any message you MUST use \' in lieu of ' if need be!
//You may use as many "&+n+b+s+p;" as you'd need to space 
//within messages - quotes and plus signs don't belong there! 
//Any message may have inside tags like <b>, <font>, ..., but no
//line breakers such as <br>, <div>, <table>, if it's one row scroll.
//Images stand alone or used within a message - preload is recommended:
//preloadname = new Image();
//preloadname.src = "imagename.ext";
//sglm[..]='< ... ><img width="..." ... src='+preloadname.src+' /><...>';
//width parameter above is a MUST for every image - may be different;

var sglm=new Array();
/*
sglm[0]='1) bmsgnr:0 => Singles ~ - ~ bmsgnr:1 => More ~ - ~ <font color="red"><em>Messages herein pause Singles</em></font>';
sglm[1]='2) nr.2 to nr.7 <font color="red"><em>shorter & centered</em></font>';
sglm[2]='3) Another short!';
sglm[3]='4) One more!';
sglm[4]='5) <em>Hyperlink:</em> <a  href="#" OnClick=\'javascript:void(secwin=window.open("http://vbarsan.com/","a_new","toolbar=no,menubar=no,scrollbars=yes,status=no,fullscreen=no,resizable=yes,width=800,height=600,top=0,left=0,screenX=0,screenY=0"));secwin.self.focus();\'>'+
'Site Map</a>';
sglm[5]='6) nr.1 & nr.8: <font color="red"><em>longer than width</em></font>';
sglm[6]='7) <font color="red"><em>20px wide</em></font> between nr.8 & nr.1';
sglm[7]='8) Pauses every message either centered or at left edge - while mouse is placed over also';
*/
//    ...
//sglm[...]='...';
//end Messages 
/* end of external_remote file "mybcparmsg.txt" */


var ikjh=0;var ikjj=0;var jkkh=0;var resumebspeed=bspeed; var rebspeed=bspeed;var sizeleft=0;var bsumsize=0;var bdivmsg=0;var bmsgsize=new Array();var bwmsgs='';var bwmsg='';var bmsgtsize=0;var msgclass='class="stilmsg"';if(blanspa==0)var betspa=20;else var betspa=0;var geckff=0;if(navigator.product&&navigator.product=="Gecko"){var agt = navigator.userAgent.toLowerCase();var rvStart = agt.indexOf('rv:');var rvEnd = agt.indexOf(')', rvStart);var checkff = agt.substring(rvStart+3, rvEnd);if(parseFloat(checkff)>=1.8)geckff=1;else geckff=2;if(rvStart==-1)geckff=1;}var broper=navigator.userAgent.toLowerCase().indexOf('opera');if(broper==-1&&geckff==0)broper=navigator.appVersion.indexOf("Mac");function speeduper(){if(bspeed==0)bspeed=rebspeed;else if(bspeed<9){bspeed*=2;rebspeed=bspeed;}}
function slowdown(){if(bspeed==0)bspeed=resumebspeed;else 
if(bspeed>resumebspeed){bspeed/=2;rebspeed=bspeed;}}function slowstp(){bspeed=0;}function biescroll1(){if(iedvh.style.pixelLeft+sizeleft<=bspeed){if(sizeleft==bsumsize)sizeleft=0;iedvh.style.pixelLeft=-sizeleft;sizeleft+=bmsgsize[ikjh];if(ikjh==sglm.length-1)ikjh=0;
else ikjh++;setTimeout("biescroll1()",bpause);return;}else{iedvh.style.pixelLeft-=bspeed;setTimeout("biescroll1()",20);}}function biescroll(){if(jkkh==0 && iedvh.style.pixelLeft<=bspeed||jkkh==1 && iedv0h.style.pixelLeft<=bspeed){ikjj=ikjh;if(ikjh==sglm.length-1) ikjh=0;else if(ikjh<sglm.length-1) ikjh++;if(jkkh==0) jkkh=1;else jkkh=0;if(jkkh==0){iedv0h.style.pixelLeft=0;iedvh.style.pixelLeft=0;iedvh.innerHTML='<nobr>'+sglm[ikjj]+'</nobr>';sizeleft=iedvh.offsetWidth-bwidth;if(sizeleft>0){sizeleft+=betspa;jkkh=1;iedv0h.style.pixelLeft=bwidth;iedv0h.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}else{iedvh.style.pixelLeft=bwidth;iedvh.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}}else{iedvh.style.pixelLeft=0;sizeleft=iedvh.offsetWidth-bwidth;if(sizeleft>0)sizeleft+=betspa;iedv0h.style.pixelLeft=bwidth;iedv0h.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}setTimeout("biescroll()",bpause);return;}else if(sizeleft>0){if(jkkh==0){iedv0h.style.pixelLeft-=bspeed;sizeleft-=bspeed;setTimeout("biescroll()",20);}else{iedvh.style.pixelLeft-=bspeed;sizeleft-=bspeed;setTimeout("biescroll()",20);}}else{iedv0h.style.pixelLeft-=bspeed;iedvh.style.pixelLeft-=bspeed;setTimeout("biescroll()",20);}}function bns4scroll1(){if(ns4lrh.left+sizeleft<=bspeed){if(sizeleft==bsumsize)sizeleft=0;ns4lrh.left=-sizeleft;sizeleft+=bmsgsize[ikjh];if(ikjh==sglm.length-1)ikjh=0;else ikjh++;setTimeout("bns4scroll1()",bpause);return;}else{ns4lrh.left-=bspeed;setTimeout("bns4scroll1()",20);}}function bns4scroll(){if(jkkh==0 && ns4lrh.left<=bspeed||jkkh==1 && ns4lr0h.left<=bspeed){if(ikjh==sglm.length-1) ikjh=0;else if(ikjh<sglm.length-1) ikjh++;if(jkkh==0) jkkh=1;else jkkh=0;if (jkkh==0){ns4lr0h.left=0;sizeleft=ns4lr0h.document.width-bwidth;if(sizeleft>0)sizeleft+=betspa;ns4lrh.left=bwidth;ns4lrh.document.write('<nobr '+msgclass+'>'+sglm[ikjh]+'</nobr>');ns4lrh.document.close();}else{ns4lrh.left=0;sizeleft=ns4lrh.document.width-bwidth;if(sizeleft>0)sizeleft+=betspa;ns4lr0h.left=bwidth;ns4lr0h.document.write('<nobr '+msgclass+'>'+sglm[ikjh]+'</nobr>');ns4lr0h.document.close();}setTimeout("bns4scroll()",bpause);return;}else if(sizeleft>0){if(jkkh==0){ns4lr0h.left-=bspeed;sizeleft-=bspeed;setTimeout("bns4scroll()",20);}else{ns4lrh.left-=bspeed;sizeleft-=bspeed;setTimeout("bns4scroll()",20);}}else{ns4lr0h.left-=bspeed;ns4lrh.left-=bspeed;setTimeout("bns4scroll()",20);}}function bdomscroll1(){if(parseInt(domdvh.style.left)+sizeleft<=bspeed){if(sizeleft==bsumsize)sizeleft=0;domdvh.style.left=-sizeleft+"px";sizeleft+=bmsgsize[ikjh];if(ikjh==sglm.length-1)ikjh=0;else 
ikjh++;setTimeout("bdomscroll1()",bpause);return;}else{domdvh.style.left=parseInt(domdvh.style.left)-bspeed+"px";setTimeout("bdomscroll1()",20);}}function bdomscroll(){if(jkkh==0 && parseInt(domdvh.style.left)<=bspeed||jkkh==1 && parseInt(domdv0h.style.left)<=bspeed){ikjj=ikjh;if(ikjh==sglm.length-1) ikjh=0;else if(ikjh<sglm.length-1) ikjh++;if(jkkh==0) jkkh=1;else jkkh=0;if(jkkh==0){domdv0h.style.left=0;domdvh.style.left=0;domdvh.innerHTML='<nobr>'+sglm[ikjj]+'</nobr>';sizeleft=domdvh.offsetWidth-bwidth;if(sizeleft==0&&geckff==1){document.getElementById('bhidslider1').innerHTML='<nobr>'+sglm[ikjj]+'</nobr>';sizeleft=document.getElementById('bhidslider1').offsetWidth-bwidth;}if(sizeleft>0){sizeleft+=betspa;jkkh=1;domdv0h.style.left=bwidth+"px";domdv0h.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}else{domdvh.style.left=bwidth+"px";domdvh.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}}else{domdvh.style.left=0;sizeleft=domdvh.offsetWidth-bwidth;if(sizeleft==0&&geckff==1){document.getElementById('bhidslider1').innerHTML='<nobr>'+sglm[ikjj]+'</nobr>';sizeleft=document.getElementById('bhidslider1').offsetWidth-bwidth;}if(sizeleft>0)sizeleft+=betspa;domdv0h.style.left=bwidth+"px";domdv0h.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}setTimeout("bdomscroll()",bpause);return;}else if(sizeleft>0){if(jkkh==0){domdv0h.style.left=parseInt(domdv0h.style.left)-bspeed+"px";sizeleft-=bspeed;setTimeout("bdomscroll()",20);}else{domdvh.style.left=parseInt(domdvh.style.left)-bspeed+"px";sizeleft-=bspeed;setTimeout("bdomscroll()",20);}}else{domdv0h.style.left=parseInt(domdv0h.style.left)-bspeed+"px";domdvh.style.left=parseInt(domdvh.style.left)-bspeed+"px";setTimeout("bdomscroll()",20);}}
function oper7scroll1(){if(parseInt(domdv0h.style.left)+sizeleft<=bspeed){if(sizeleft==bsumsize)sizeleft=0;domdv0h.style.left=-sizeleft+"px";sizeleft+=bmsgsize[ikjh];if(ikjh==sglm.length-1)ikjh=0;else ikjh++;setTimeout("oper7scroll1()",bpause);return;}else{domdv0h.style.left=parseInt(domdv0h.style.left)-bspeed+"px";setTimeout("oper7scroll1()",20);}};
function oper7scroll(){if(jkkh==0 && parseInt(domdvh.style.left)<=bspeed||jkkh==1 && parseInt(domdv0h.style.left)<=bspeed){ikjj=ikjh;if(ikjh==sglm.length-1) ikjh=0;else if(ikjh<sglm.length-1) ikjh++;if(jkkh==0) jkkh=1;else jkkh=0;if(jkkh==1){domdvh.style.left=0;domdv0h.style.left=0;domdv0h.innerHTML='<nobr>'+sglm[ikjj]+'</nobr>';sizeleft=domdv0h.offsetWidth-bwidth;if(sizeleft==0){document.getElementById('bhidslider1').innerHTML='<nobr>'+sglm[ikjj]+'</nobr>';sizeleft=document.getElementById('bhidslider1').offsetWidth-bwidth;}
if(sizeleft>0){sizeleft+=betspa;jkkh=0;domdvh.style.left=bwidth+"px";domdvh.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}else{domdv0h.style.left=bwidth+"px";domdv0h.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}}else{domdv0h.style.left=0;sizeleft=domdv0h.offsetWidth-bwidth;if(sizeleft==0){document.getElementById('bhidslider1').innerHTML='<nobr>'+sglm[ikjj]+'</nobr>';sizeleft=document.getElementById('bhidslider1').offsetWidth-bwidth;}
if(sizeleft>0)sizeleft+=betspa;domdvh.style.left=bwidth+"px";domdvh.innerHTML='<nobr>'+sglm[ikjh]+'</nobr>';}setTimeout("oper7scroll()",bpause);return;}else if(sizeleft>0){if(jkkh==1){domdvh.style.left=parseInt(domdvh.style.left)-bspeed+"px";sizeleft-=bspeed;setTimeout("oper7scroll()",20);}else{domdv0h.style.left=parseInt(domdv0h.style.left)-bspeed+"px";sizeleft-=bspeed;setTimeout("oper7scroll()",20);}}else{domdv0h.style.left=parseInt(domdv0h.style.left)-bspeed+"px";domdvh.style.left=parseInt(domdvh.style.left)-bspeed+"px";setTimeout("oper7scroll()",20);}}function startbcscroll(){if(blanspa==0)var qmsg="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";else var qmsg="";if(document.getElementById){domdv0h=document.getElementById('scrolldivh');domdvh=document.getElementById('scrolldivsh');if(bmsgnr==1){for(ppq=0;ppq<sglm.length;ppq++){document.getElementById('bhidslider1').innerHTML='<nobr>'+sglm[ppq]+qmsg+'</nobr>';bmsgtsize=document.getElementById('bhidslider1').offsetWidth;if(bmsgtsize==bwidth){document.getElementById('bhidslider').innerHTML='<nobr>'+sglm[ppq]+qmsg+'</nobr>';bmsgtsize=document.getElementById('bhidslider').offsetWidth;}bmsgsize[ppq]=bmsgtsize;bsumsize+=bmsgtsize;bwmsg+=sglm[ppq]+qmsg;}bdivmsg=Math.round(bwidth/bsumsize);}if(rlopt==0&&bmsgnr==0){domdv0h.style.left=bwidth+"px";domdvh.style.left=bwidth+"px";}else if(rlopt==1&&bmsgnr==0){domdv0h.style.left=0;domdvh.style.left=0;}if(bmsgnr==0){domdvh.innerHTML='<nobr>'+sglm[0]+'</nobr>';if(broper==-1)bdomscroll();else oper7scroll();}else {for(ppq=0;ppq<=2*bdivmsg;ppq++)bwmsg+=bwmsg;if(bdivmsg==0)bwmsg+=bwmsg;if(broper==-1)domdvh.innerHTML='<nobr>'+bwmsg+'</nobr>';else domdv0h.innerHTML='<nobr>'+bwmsg+'</nobr>';
if(rlopt==0&&broper==-1)domdvh.style.left=bwidth+"px";else if(rlopt==1&&broper==-1)domdvh.style.left=0;else if(rlopt==0&&broper!=-1)domdv0h.style.left=bwidth+"px";else if(rlopt==1&&broper!=-1)domdv0h.style.left=0;if(broper==-1)bdomscroll1();else oper7scroll1();}}else if(document.all){if(bmsgnr==1){for(ppq=0;ppq<sglm.length;ppq++){bhidslider1.innerHTML='<nobr>'+sglm[ppq]+qmsg+'</nobr>';bmsgtsize=bhidslider1.offsetWidth;if(bmsgtsize==bwidth){bhidslider.innerHTML='<nobr>'+sglm[ppq]+qmsg+'</nobr>';bmsgtsize=bhidslider.offsetWidth;}bmsgsize[ppq]=bmsgtsize;bsumsize+=bmsgtsize;bwmsg+=sglm[ppq]+qmsg;}bdivmsg=Math.round(bwidth/bsumsize);}iedv0h=scrolldivh;iedvh=scrolldivsh;if(rlopt==0&&bmsgnr==0){iedv0h.style.pixelLeft=bwidth;iedvh.style.pixelLeft=bwidth;}else if(rlopt==1&&bmsgnr==0){iedv0h.style.pixelLeft=0;iedvh.style.pixelLeft=0;}if(bmsgnr==0)iedvh.innerHTML='<nobr>'+sglm[0]+'</nobr>';else {for(ppq=0;ppq<=2*bdivmsg;ppq++)bwmsg+=bwmsg;if(bdivmsg==0)bwmsg+=bwmsg;iedvh.innerHTML='<nobr>'+bwmsg+'</nobr>';if(rlopt==0)iedvh.style.pixelLeft=bwidth;else iedvh.style.pixelLeft=0;}if(bmsgnr==0)biescroll();else biescroll1();}else if(document.layers){if(bmsgnr==1){ns4lrhid=document.ns4sh.document.ns4hid;for(ppq=0;ppq<sglm.length;ppq++){ns4lrhid.document.write('<nobr '+msgclass+'>'+sglm[ppq]+qmsg+'</nobr>');ns4lrhid.document.close();bmsgsize[ppq]=ns4lrhid.document.width;bsumsize+=bmsgsize[ppq];bwmsg+=sglm[ppq]+qmsg;}bdivmsg=Math.round(bwidth/bsumsize);}ns4lr0h=document.ns4sh.document.ns4s0h;ns4lrh=document.ns4sh.document.ns4s1h;if(rlopt==0&&bmsgnr==0){ns4lr0h.left=bwidth;ns4lrh.left=bwidth;}else if(rlopt==1&&bmsgnr==0){ns4lr0h.left=0;ns4lrh.left=0;}if(bmsgnr==0){ns4lrh.document.write('<nobr '+msgclass+'>'+sglm[0]+'</nobr>');ns4lrh.document.close();bns4scroll();}else {for(ppq=0;ppq<=2*bdivmsg;ppq++)bwmsg+=bwmsg;if(bdivmsg==0)bwmsg+=bwmsg;ns4lrh.document.write('<nobr '+msgclass+'>'+bwmsg+'</nobr>');ns4lrh.document.close();if(rlopt==0)ns4lrh.left=bwidth;else ns4lrh.left==0;bns4scroll1();}}}document.write('<table border="'+bborder+'" cellspacing="0" cellpadding="0" background="'+bbground+'"><tr>');if(bsopt==1)document.write('<td bgcolor="'+belcolor+'"><div '+besclass+'><a href="#" onmouseover="speeduper();" onMouseout="speeduper();">Fast</a>&nbsp;<font color="olive"><></font>&nbsp;<a href="#" onmouseover="slowdown();" onMouseout="slowdown();">Slow</a></div></td>');document.write('<td width="'+bwidth+'px" height="'+bheight+'px">');if(document.all||document.getElementById){document.write('<span style="width:'+bwidth+'px;height:'+bheight+'px;"><div '+msgclass+' style="position:relative;overflow:hidden;width:'+bwidth+'px;height:'+bheight+'px;clip:rect(0 '+bwidth+'px '+bheight+'px 0);background-color:'+bbcolor+';" onMouseover="bspeed=rebspeed;" onMouseout="bspeed=rebspeed">');if(broper==-1){document.write('<div id="scrolldivh" '+msgclass+' style="position:absolute;overflow:hidden;width:'+bwidth+'px;height:'+bheight+'px;"></div><div id="scrolldivsh" '+msgclass+' style="position:relative;height:'+bheight+'px;"></div>');document.write('<div id="bhidslider" '+msgclass+' style="position:relative;visibility:hidden;height:'+bheight+'px;"></div><div id="bhidslider1" '+msgclass+' style="position:absolute;visibility:hidden;height:'+bheight+'px;"></div></div></span>');}else{document.write('<div id="scrolldivh" '+msgclass+' style="position:absolute;width:'+bwidth+'px;height:'+bheight+'px;"></div><div id="scrolldivsh" '+msgclass+' style="position:relative;overflow:hidden;width:'+bwidth+'px;height:'+bheight+'px;"></div><div id="bhidslider1" '+msgclass+' style="position:absolute;visibility:hidden;height:'+bheight+'px;"></div><div id="bhidslider" '+msgclass+' style="position:relative;visibility:hidden;width:'+bwidth+'px;height:'+bheight+'px;"></div></div></span>');}}if(document.layers){document.write('<ilayer id="ns4sh" width="'+bwidth+'" height="'+bheight+'" bgcolor="'+bbcolor+'"><layer id="ns4s0h" height="'+bheight+'" width="'+bwidth+'" onMouseover="bspeed=rebspeed" onMouseout="bspeed=rebspeed"></layer><layer id="ns4s1h" width="'+bwidth+'" height="'+bheight+'" onMouseover="bspeed=rebspeed" onMouseout="bspeed=rebspeed"></layer><layer id="ns4hid" width="'+bwidth+'" height="'+bheight+'" visibility="hide"></layer></ilayer>')}document.write('</td>');if(bsopt==1)document.write('<td bgcolor="'+belcolor+'"><div '+besclass+'><a href="#" onmouseover="slowstp();" onMouseout="slowstp();">Stop</a></div></td>');document.write('</tr></table>');
/* end of external file "mybcbody.js" */