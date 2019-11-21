/* external file "myvsbody.js" begins */
/*********************************************
*      http://javascripts.vbarsan.com/
*©2002-2015 Vasile Barsan-All rights reserved.
*********************************************/

/* external file "myvsparmsg.txt" begins */
// begin: Vertical Scroller's Parameters 

//PATTERN: How many messages may RESIDE within scrolling area while PAUSING: 
//0 for SINGLE, only one RESIDES within area while PAUSING;
//1 for MORE, as many as they fit RESIDE in the area while PAUSING; 
//Should one choose  below to set msgnr=1 (MORE), a blank space
//will automatically be inserted after each and every message;
//"stileret" would set the vertical size for this blank space, see STEP I above;
var msgnr=1;
if(msgnr==1){
var retclass='class="stileret"';
}

//If msgnr=0 for PATTERN SINGLE was chosen above and you want that any
//mesage smaller than area NOT to be CELL-CENTERED, set below value 0:
var celcen=1;

//1: FIRST message shows up right at top edge (or cell-centered) and pauses;
//If First message is to show up at bottom edge and starts scrolling, set below value 0:
var udopt=1;

//WIDTH of the Scroller in pixels: set to your own;
//"px" unit will automatically be set in the process, so do not write "px";
var mwidth=1278; 

//HEIGHT of the Scroller in pixels: set to your own; 
//"px" unit will automatically be set in the process, so do not write "px";
//larger Messages (exceeding height) will slide OK anyway, but
//the exceeding height won't show up on option Instant Recall if chosen!
var mheight=750; 

//BACKGROUND: either color(1) or image(2, see below) ;
//1.Background color: could be like: "#ffff00" or "yellow";
//set it "" for no background color;
var mcolor="";

//or 2.Background image: "imagename.ext";
//leave it "" for no image background;
var mbground="";

//BORDER for scrolling area: 1, ... ;
//set it 0(zero) for no border;
var mborder=0;

//SPEED in pixels: the higher the faster - set your own!
var mspeed=1; 

//PAUSE between messages in milliseconds: 1000=1s; set to your own; 
var mpause = 5000; 

//Live speed-change option: 0 (not desired) or 1 (desired);
//"stileupdn" would be the STYLE (CSS), see STEP I above;
//celcolor would set background color
var lsopt = 0;
if(lsopt==1){
var vesclass='class="stileupdn"';
var celcolor='#ccffcc';
}

//Recall Option: 
//Let it be 0 if not desired and the scroll will go on;
//set it 1 if desired: after a complete cycle the scroll stops
//and you may recall randomly any Message/Image;  
var rcopt=0;
if(rcopt==1){
var cbtxt = new Array();
//MUST BE as many TEXTs as the number of Messages/Images;
//Set your own TEXTs, like Messages Title or what you have in there: 
//cbtxt = ["1-TITLE", "2-Features", "3-Recall Option", "4-Other Possibilities", "5-Check"];
cbtxt=[];
}
//end Parameters 
//===
// begin: Vertical Scroller's Messages/Images - 

//Messages: as many as you'd like: set to your own; 
//Every message MUST be set as a continuous string within '...';
//you may split it by using '+ at ends and then ' at continuations;
//Inside any message you MUST use \' in lieu of ' if need be!
//Use of "<br />" or "<br>" for row control inside any message is recommended;
//Images stand alone or used within a message - preload is recommended:
//preloadname = new Image();
//preloadname.src = "imagename.ext";
//slmg[..]='< ... ><img height="..." ... src='+preloadname.src+' /><...>';
//height parameter above is a MUST for every image - may be different;

var slmg=new Array();

var ikj=0;var jkk=1;var resumemspeed=mspeed;for(ppjh=0;ppjh<slmg.length;ppjh++)slmg[ppjh]='<div class="tabmsg">'+slmg[ppjh]+'</div>';var sumsize=0;var divmsg=0;var msgsize=new Array();var wmsgs='';var wmsg='';var remspeed=mspeed;sizeup=0;if(rcopt==1){if(cbtxt.length==0||slmg.length==0||cbtxt.length!=slmg.length)rcopt=0;}if(rcopt==1){var varoptm="";for(jkj=0;jkj<cbtxt.length-1;jkj++)varoptm=varoptm+'<option>' +cbtxt[jkj]+ '</option>';varoptm=varoptm+'<option selected>' +cbtxt[cbtxt.length-1]+ '</option>';}function speedup(){if(mspeed==0)mspeed=remspeed;else if(mspeed<9){mspeed*=2;remspeed=mspeed;}}function slowst(){mspeed=0;}function slowdn(){if(mspeed==0)mspeed=resumemspeed;else if(mspeed>resumemspeed){mspeed/=2;remspeed=mspeed;}}function iescroll1(){if(iedv0.style.pixelTop+sizeup<=mspeed){if(ikj==slmg.length-1&&rcopt==1){iedv.style.visibility="hidden";iedv0.style.pixelTop=0;iedv0.innerHTML=slmg[ikj];callbackm.style.visibility="visible";return;}else if(sizeup==sumsize)sizeup=0;iedv0.style.pixelTop=-sizeup;sizeup+=msgsize[ikj];if(ikj==slmg.length-1)ikj=0;else ikj++;setTimeout("iescroll1()",mpause);return;}else{iedv0.style.pixelTop-=mspeed;setTimeout("iescroll1()",20);}}function iescroll(){if(jkk==0&&iedv.style.pixelTop<=mspeed||jkk==1&&iedv0.style.pixelTop<=mspeed){ if(ikj==slmg.length-1&&rcopt==1){if(jkk==0){iedv0.style.visibility="hidden";iedv.style.pixelTop=0;}else{iedv.style.visibility="hidden";iedv0.style.pixelTop=0;}callbackm.style.visibility="visible";return;}else if(ikj==slmg.length-1&&rcopt==0)ikj=0;else if(ikj<slmg.length-1)ikj++;if(jkk==0)jkk=1;else jkk=0;if(jkk==0){iedv0.style.pixelTop=0;sizeup=iedv0.offsetHeight-mheight;if(sizeup>5&&mheight>20)sizeup+=10;iedv.style.pixelTop=mheight;iedv.innerHTML=slmg[ikj];}else{iedv.style.pixelTop=0;sizeup=iedv.offsetHeight-mheight;if(sizeup>5&&mheight>20)sizeup+=10;iedv0.style.pixelTop=mheight;iedv0.innerHTML=slmg[ikj];}setTimeout("iescroll()",mpause);return;}else if(sizeup>0){if(jkk==0){iedv0.style.pixelTop-=mspeed;sizeup-=mspeed;setTimeout("iescroll()",20);}else{iedv.style.pixelTop-=mspeed;sizeup-=mspeed;setTimeout("iescroll()",20);}}else{iedv0.style.pixelTop-=mspeed;iedv.style.pixelTop-=mspeed;setTimeout("iescroll()",20);}}function ns4scroll1(){if(ns4lr0.top+sizeup<=mspeed){if(ikj==slmg.length-1&&rcopt==1){ns4lr.visibility="hide";ns4lr0.top=0;ns4lr0.document.write(slmg[ikj]);ns4lr0.document.close();document.callbm.document.cbackm.visibility="show";return;}else if(sizeup==sumsize)sizeup=0;ns4lr0.top=-sizeup;sizeup+=msgsize[ikj];if(ikj==slmg.length-1)ikj=0;else ikj++;setTimeout("ns4scroll1()",mpause);return;}else{ns4lr0.top-=mspeed;setTimeout("ns4scroll1()",20);}}function ns4scroll(){if(jkk==0&&ns4lr.top<=mspeed||jkk==1&&ns4lr0.top<=mspeed){if(ikj==slmg.length-1&&rcopt==1){if(jkk==0){ns4lr0.visibility="hide";ns4lr.top=0;}else{ns4lr.visibility="hide";ns4lr0.top=0;}document.callbm.document.cbackm.visibility="show";return;}else if(ikj==slmg.length-1&&rcopt==0)ikj=0;else if(ikj<slmg.length-1)ikj++;if(jkk==0)jkk=1;else jkk=0;if(jkk==0){ns4lr0.top=0;sizeup=ns4lr0.document.height-mheight;if(sizeup>5&&mheight>20)sizeup+=10;ns4lr.top=mheight;ns4lr.document.write(slmg[ikj]);ns4lr.document.close();}else{ns4lr.top=0;sizeup=ns4lr.document.height-mheight;if(sizeup>5&&mheight>20)sizeup+=10;ns4lr0.top=mheight;ns4lr0.document.write(slmg[ikj]);ns4lr0.document.close();}setTimeout("ns4scroll()",mpause);return;}else if(sizeup>0){if(jkk==0){ns4lr0.top-=mspeed;sizeup-=mspeed;setTimeout("ns4scroll()",20);}else{ns4lr.top-=mspeed;sizeup-=mspeed;setTimeout("ns4scroll()",20);}}else{ns4lr0.top-=mspeed;ns4lr.top-=mspeed;setTimeout("ns4scroll()",20);}}function domscroll1(){if(parseInt(domdv0.style.top)+sizeup<=mspeed){if(ikj==slmg.length-1&&rcopt==1){domdv.style.visibility="hidden";domdv0.style.top=0;domdv0.innerHTML=slmg[ikj];document.getElementById('callbackm').style.visibility="visible";document.getElementById('callbackm').innerHTML='<form name="boxxm" method="post">'+'<select name="listm" onFocus onChange="upcallm(this.form);">'+varoptm+'</select></form>';return;}else if(sizeup==sumsize)sizeup=0;domdv0.style.top=-sizeup+"px";sizeup+=msgsize[ikj];if(ikj==slmg.length-1)ikj=0;else ikj++;setTimeout("domscroll1()",mpause);return;}else{domdv0.style.top=parseInt(domdv0.style.top)-mspeed+"px";setTimeout("domscroll1()",20);}}function domscroll(){if(jkk==0&&parseInt(domdv.style.top)<=mspeed||jkk==1&&parseInt(domdv0.style.top)<=mspeed){if(ikj==slmg.length-1&&rcopt==1){if(jkk==0){domdv0.style.visibility="hidden";domdv.style.top=0;}else{domdv.style.visibility="hidden";domdv0.style.top=0;}document.getElementById('callbackm').style.visibility="visible";document.getElementById('callbackm').innerHTML='<form name="boxxm" method="post">'+'<select name="listm" onFocus onChange="upcallm(this.form);">'+varoptm+'</select></form>';return;}else if(ikj==slmg.length-1&&rcopt==0)ikj=0;else if(ikj<slmg.length-1)ikj++;if(jkk==0)jkk=1;else jkk=0;if(jkk==0){domdv0.style.top=0;sizeup=domdv0.offsetHeight-mheight;if(sizeup>5&&mheight>20)sizeup+=10;domdv.style.top=mheight+"px";domdv.innerHTML=slmg[ikj];}else{domdv.style.top=0;sizeup=domdv.offsetHeight-mheight;if(sizeup>5&&mheight>20)sizeup+=10;domdv0.style.top=mheight+"px";domdv0.innerHTML=slmg[ikj];}setTimeout("domscroll()",mpause);return;}else if(sizeup>0){if(jkk==0){domdv0.style.top=parseInt(domdv0.style.top)-mspeed+"px";sizeup-=mspeed;setTimeout("domscroll()",20);}else{domdv.style.top=parseInt(domdv.style.top)-mspeed+"px";sizeup-=mspeed;setTimeout("domscroll()",20);}}else{domdv0.style.top=parseInt(domdv0.style.top)-mspeed+"px";domdv.style.top=parseInt(domdv.style.top)-mspeed+"px";setTimeout("domscroll()",20);}}function upcallm(form){ikj=form.listm.selectedIndex;if(document.getElementById){domdv0.style.visibility="hidden";domdv.style.visibility="visible";domdv.style.top=0;domdv.innerHTML=slmg[ikj];}else if(document.all){iedv0.style.visibility="hidden";iedv.style.visibility="visible";iedv.style.pixelTop=0;iedv.innerHTML=slmg[ikj];}else if(document.layers){ns4lr0.visibility="hide";ns4lr.visibility="show";ns4lr.top=0;ns4lr.document.write(slmg[ikj]);ns4lr.document.close();}return;}function vsscrollstart(){if(document.getElementById){domdv0=document.getElementById('scrolldiv');domdv=document.getElementById('scrolldivs');if(msgnr==0&&celcen==1){for(pp=0;pp<slmg.length;pp++){document.getElementById('hidslider').innerHTML=slmg[pp];msgsize[pp]=document.getElementById('hidslider').offsetHeight;if(msgsize[pp]<mheight){wmsg='<table cellspacing="0" cellpadding="0" align="center"><tr><td height="'+mheight+'px" valign="center">'+slmg[pp]+'</td></tr></table>';slmg[pp]=wmsg;document.getElementById('scrolldiv').innerHTML=slmg[0];}}}if(msgnr==1){for(pp=0;pp<slmg.length;pp++){document.getElementById('hidslider').innerHTML=slmg[pp]+'<div '+retclass+'>&nbsp;</div>';wmsg+=document.getElementById('hidslider').innerHTML;msgsize[pp]=document.getElementById('hidslider').offsetHeight;sumsize+=msgsize[pp];}divmsg=Math.round(mheight/sumsize);}
if(udopt==0){domdv0.style.top=mheight+"px";if(msgnr==0){domdv0.innerHTML=slmg[0];domdv.style.top=mheight+"px";}else {for(pp=0;pp<=2*divmsg;pp++)domdv0.innerHTML+=wmsg;if(divmsg==0)domdv0.innerHTML+=wmsg;}}else {if(msgnr==0){domdv0.style.top=0;domdv.style.top=0;}else {domdv0.style.top=0;for(pp=0;pp<=2*divmsg;pp++)domdv0.innerHTML+=wmsg;if(divmsg==0)domdv0.innerHTML+=wmsg;}}if(msgnr==0)domscroll();else domscroll1();}else if(document.all){if(msgnr==0&&celcen==1){for(pp=0;pp<slmg.length;pp++){hidslider.innerHTML=slmg[pp];msgsize[pp]=hidslider.offsetHeight;if(msgsize[pp]<mheight){wmsg='<table cellspacing="0" cellpadding="0" align="center"><tr><td height="'+mheight+'px" valign="center">'+slmg[pp]+'</td></tr></table>';slmg[pp]=wmsg;scrolldiv.innerHTML=slmg[0];}}}if(msgnr==1){for(pp=0;pp<slmg.length;pp++){hidslider.innerHTML=slmg[pp]+'<div '+retclass+'>&nbsp;</div>';wmsg+=hidslider.innerHTML;msgsize[pp]=hidslider.offsetHeight;sumsize+=msgsize[pp];}divmsg=Math.round(mheight/sumsize);}iedv0=scrolldiv;iedv=scrolldivs;if(udopt==0){iedv0.style.pixelTop=mheight;if(msgnr==0){iedv0.innerHTML=slmg[0];iedv.style.pixelTop=mheight;}else {for(pp=0;pp<=2*divmsg;pp++)iedv0.innerHTML+=wmsg;if(divmsg==0)iedv0.innerHTML+=wmsg;}}else {if(msgnr==0){iedv0.style.pixelTop=0;iedv.style.pixelTop=0;}else {iedv0.style.pixelTop=0;for(pp=0;pp<=2*divmsg;pp++)iedv0.innerHTML+=wmsg;if(divmsg==0)iedv0.innerHTML+=wmsg;}}if(msgnr==0)iescroll();else iescroll1();}else 
if(document.layers){ns4lr0=document.ns4s.document.ns4s0;if(msgnr==0&&celcen==1){ns4lr0.visibility="hide";for(pp=0;pp<slmg.length;pp++){ns4lr0.document.write(slmg[pp]);ns4lr0.document.close();msgsize[pp]=ns4lr0.document.height;if(msgsize[pp]<mheight){wmsg='<table cellspacing="0" cellpadding="0" align="center"><tr><td height="'+mheight+'px" valign="center">'+slmg[pp]+'</td></tr></table>';slmg[pp]=wmsg;}}}if(msgnr==1){ns4lr0.visibility="hide";for(pp=0;pp<slmg.length;pp++){ns4lr0.document.write(slmg[pp]+'<div '+retclass+'>&nbsp;</div>');ns4lr0.document.close();wmsg+=slmg[pp]+'<div '+retclass+'>&nbsp;</div>';msgsize[pp]=ns4lr0.document.height;sumsize+=msgsize[pp];}divmsg=Math.round(mheight/sumsize);}ns4lr=document.ns4s.document.ns4s1;if(udopt==0)ns4lr0.top=mheight;else if(udopt==1)ns4lr0.top=0;ns4lr0.visibility="show";if(msgnr==0){ns4lr0.document.write(slmg[0]);ns4lr0.document.close();}if(msgnr==1){for(pp=0;pp<=2*divmsg;pp++)wmsgs+=wmsg;if(divmsg==0)wmsgs+=wmsg;ns4lr0.document.write(wmsgs);ns4lr0.document.close();}if(udopt==0)ns4lr.top=mheight;else if(udopt==1)ns4lr.top=0;if(msgnr==0)ns4scroll();else ns4scroll1();}}
document.write('<table border="'+mborder+'" cellspacing="0" cellpadding="0" background="'+mbground+'"><tr><td valign="top" height="'+mheight+'px" width="'+mwidth+'px">');if(document.layers){document.write('<ilayer id="ns4s" width="'+mwidth+'" height="'+mheight+'" bgcolor="'+mcolor+'"><layer id="ns4s0" width="'+mwidth+'" onMouseover="mspeed=remspeed" onMouseout="mspeed=remspeed"></layer><layer id="ns4s1" width="'+mwidth+'" onMouseover="mspeed=remspeed" onMouseout="mspeed=remspeed"></layer></ilayer>')}if(document.all||document.getElementById){document.write('<span style="height:'+mheight+'px;"><div style="position:relative;overflow:hidden;width:'+mwidth+'px;height:'+mheight+'px;clip:rect(0 '+mwidth+'px '+mheight+'px 0);background-color:'+mcolor+';" onMouseover="mspeed=remspeed;" onMouseout="mspeed=remspeed"><div id="scrolldiv" style="position:absolute;overflow:hidden;width:'+mwidth+'px;">');if(udopt==1&&msgnr==0&&celcen==0)document.write(slmg[0]);document.write(wmsg);if(udopt==1&&msgnr==1)document.write(wmsg);document.write('</div><div id="scrolldivs" style="position:relative;overflow:hidden;width:'+mwidth+'px;"></div></div><div id="hidslider" style="position:absolute;visibility:hidden;width:'+mwidth+'px;"></div></span>');}document.write('</td>');if(lsopt==1)document.write('<td bgcolor='+celcolor+'><div '+vesclass+'><b><a href="#" onMouseover="speedup();">Fast</a><br /><br /><a href="#" onMouseover="slowst();">Stop</a><br /><br /><a href="#" onMouseover="slowdn();">Slow</a></b></div></td>');document.write('</tr></table>');if (rcopt==1){document.write('<table border="0" cellspacing="0" cellpadding="0"><tr><td>');if(!document.layers)document.write('<span id="callbackm" style="visibility:hidden;">');document.write('<ilayer id="callbm"><layer id="cbackm" visibility="hide"><form name="boxm" method="post"><select name="listm" onFocus onChange="upcallm(this.form);">'+varoptm+'</select></form></layer></ilayer>');if(!document.layers)document.write('</span>');document.write('</td></tr></table>');}
/* end of external file "myvsbody.js" */