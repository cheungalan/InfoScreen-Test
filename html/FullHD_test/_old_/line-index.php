<?php 

  // server side function call
   
function calc() {
	$link = "/var/www/wsja/html/resource/include/stock.txt";
	$contents = "";  
	$contents = file_get_contents($link);
	return $contents;
}

  include_once("../resource/agent.php");
  $agent->init(); 
  
?>
<script TYPE="text/javascript" language="JavaScript1.2" src="js/common.js"></script>
<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript"> 
	norightclick() ;
//	autoreload("1:00");
</SCRIPT> 
<script>

  function runcalc() {
    agent.call('','calc','callback');
    timer();
  }
  
  function callback(str) {
    string=str.split("##");
	index1=string[2].split(",");
	index2=string[3].split(",");
	index3=string[4].split(",");
	index4=string[5].split(",");
	index5=string[6].split(",");
	index6=string[7].split(",");
	index7=string[8].split(",");
	index8=string[9].split(",");
	index9=string[10].split(",");
	index10=string[11].split(",");

    document.getElementById('n0').innerHTML = "Symbol";
    document.getElementById('n1').innerHTML = "Name";
    document.getElementById('n2').innerHTML = "Index Value:";
    document.getElementById('n3').innerHTML = "Change:";
    document.getElementById('n4').innerHTML = "Prev Close:";
    document.getElementById('n5').innerHTML = "Open:";

    document.getElementById('i1_0').innerHTML = index1[0];
    document.getElementById('i1_1').innerHTML = index1[1];
    document.getElementById('i1_2').innerHTML = index1[2];
    document.getElementById('i1_3').innerHTML = index1[3];
    document.getElementById('i1_4').innerHTML = index1[4];
    document.getElementById('i1_5').innerHTML = index1[5];   

    document.getElementById('i2_0').innerHTML = index2[0];
    document.getElementById('i2_1').innerHTML = index2[1];
    document.getElementById('i2_2').innerHTML = index2[2];
    document.getElementById('i2_3').innerHTML = index2[3];
    document.getElementById('i2_4').innerHTML = index2[4];
    document.getElementById('i2_5').innerHTML = index2[5];   

    document.getElementById('i3_0').innerHTML = index3[0];
    document.getElementById('i3_1').innerHTML = index3[1];
    document.getElementById('i3_2').innerHTML = index3[2];
    document.getElementById('i3_3').innerHTML = index3[3];
    document.getElementById('i3_4').innerHTML = index3[4];
    document.getElementById('i3_5').innerHTML = index3[5];   

    document.getElementById('i4_0').innerHTML = index4[0];
    document.getElementById('i4_1').innerHTML = index4[1];
    document.getElementById('i4_2').innerHTML = index4[2];
    document.getElementById('i4_3').innerHTML = index4[3];
    document.getElementById('i4_4').innerHTML = index4[4];
    document.getElementById('i4_5').innerHTML = index4[5];   

    document.getElementById('i5_0').innerHTML = index5[0];
    document.getElementById('i5_1').innerHTML = index5[1];
    document.getElementById('i5_2').innerHTML = index5[2];
    document.getElementById('i5_3').innerHTML = index5[3];
    document.getElementById('i5_4').innerHTML = index5[4];
    document.getElementById('i5_5').innerHTML = index5[5];   

    document.getElementById('i6_0').innerHTML = index6[0];
    document.getElementById('i6_1').innerHTML = index6[1];
    document.getElementById('i6_2').innerHTML = index6[2];
    document.getElementById('i6_3').innerHTML = index6[3];
    document.getElementById('i6_4').innerHTML = index6[4];
    document.getElementById('i6_5').innerHTML = index6[5];   

    document.getElementById('i7_0').innerHTML = index7[0];
    document.getElementById('i7_1').innerHTML = index7[1];
    document.getElementById('i7_2').innerHTML = index7[2];
    document.getElementById('i7_3').innerHTML = index7[3];
    document.getElementById('i7_4').innerHTML = index7[4];
    document.getElementById('i7_5').innerHTML = index7[5];   

    document.getElementById('i8_0').innerHTML = index8[0];
    document.getElementById('i8_1').innerHTML = index8[1];
    document.getElementById('i8_2').innerHTML = index8[2];
    document.getElementById('i8_3').innerHTML = index8[3];
    document.getElementById('i8_4').innerHTML = index8[4];
    document.getElementById('i8_5').innerHTML = index8[5];   

    document.getElementById('i9_0').innerHTML = index9[0];
    document.getElementById('i9_1').innerHTML = index9[1];
    document.getElementById('i9_2').innerHTML = index9[2];
    document.getElementById('i9_3').innerHTML = index9[3];
    document.getElementById('i9_4').innerHTML = index9[4];
    document.getElementById('i9_5').innerHTML = index9[5];   

  } 

  function timer() {
    setTimeout("runcalc()", 60000);
  }

</script>

<style>
  p { font-size: 12px; font-family: Verdana, Arial; }; 
</style>
 <style>
<!--
BODY{
CURSOR: url(test.cur);
}
-->
</style>
<body onload="runcalc()">

<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; color:#336AA2" bordercolor="#111111" width="100%" height="195">
  <tr>
    <td><div id="n0"></td>
    <td><div id="n1"></td>
    <td><div id="n2"></td>
    <td><div id="n3"></td>
    <td><div id="n4"></td>
    <td><div id="n5"></td>
  </tr>
  <tr>
    <td><div id="i1_0"></td>
    <td><div id="i1_1"></td>
    <td><div id="i1_2"></td>
    <td><div id="i1_3"></td>
    <td><div id="i1_4"></td>
    <td><div id="i1_5"></td>
  </tr>
  <tr>
    <td><div id="i2_0"></td>
    <td><div id="i2_1"></td>
    <td><div id="i2_2"></td>
    <td><div id="i2_3"></td>
    <td><div id="i2_4"></td>
    <td><div id="i2_5"></td>
  </tr>
  <tr>
    <td><div id="i3_0"></td>
    <td><div id="i3_1"></td>
    <td><div id="i3_2"></td>
    <td><div id="i3_3"></td>
    <td><div id="i3_4"></td>
    <td><div id="i3_5"></td>
  </tr>
  <tr>
    <td><div id="i4_0"></td>
    <td><div id="i4_1"></td>
    <td><div id="i4_2"></td>
    <td><div id="i4_3"></td>
    <td><div id="i4_4"></td>
    <td><div id="i4_5"></td>
  </tr>
  <tr>
    <td><div id="i5_0"></td>
    <td><div id="i5_1"></td>
    <td><div id="i5_2"></td>
    <td><div id="i5_3"></td>
    <td><div id="i5_4"></td>
    <td><div id="i5_5"></td>
  </tr>
  <tr>
    <td><div id="i6_0"></td>
    <td><div id="i6_1"></td>
    <td><div id="i6_2"></td>
    <td><div id="i6_3"></td>
    <td><div id="i6_4"></td>
    <td><div id="i6_5"></td>
  </tr>
  <tr>
    <td><div id="i7_0"></td>
    <td><div id="i7_1"></td>
    <td><div id="i7_2"></td>
    <td><div id="i7_3"></td>
    <td><div id="i7_4"></td>
    <td><div id="i7_5"></td>
  </tr>
  <tr>
    <td><div id="i8_0"></td>
    <td><div id="i8_1"></td>
    <td><div id="i8_2"></td>
    <td><div id="i8_3"></td>
    <td><div id="i8_4"></td>
    <td><div id="i8_5"></td>
  </tr>
  <tr>
    <td><div id="i9_0"></td>
    <td><div id="i9_1"></td>
    <td><div id="i9_2"></td>
    <td><div id="i9_3"></td>
    <td><div id="i9_4"></td>
    <td><div id="i9_5"></td>
  </tr>
</table>

</body>
 