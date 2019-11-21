<style type="text/css">
#scroller {
	height: 238px;
	width: 1880px;
}

#scroller_backup {
	border: 0 solid #5C5C5C;
	height: 208px;
	margin: 0;
	overflow: hidden;
	padding: 0;
	position: absolute;
	width: 1253px;
}


.stock-data {
	border: 0 solid #5C5C5C;
	/*position: absolute;*/
	visibility: visible;
	width: 1762px;
}
.stock-data table {
	border: 0;
	border-collapse: collapse;
	border-spacing: 0;
	padding: 0;
	width: 1873px;
}
.stock-data .spacer {
	width: 21px;
}
.stock-data .spacer-20 {
	width: 20px;
}
.stock-data .stock-default-style {
	color: #005196;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 40pt;
	font-weight: bold;
	text-align: right;
	text-transform: uppercase;
	whitespace: nowrap;
	width: 176px;
}
.stock-data .stock-number {
	text-align: left;
}
.stock-data .stock-name {
	text-align: left;
	width: 526px;
}
.stock-data .stock-price {
	width: 166px;
}
.stock-data .stock-delta {
	width: 226px;
}
.stock-data .stock-delta span {
	display: block;
	float: right;
}
.stock-data .stock-delta .arrow {
	display: none;
	margin-top: -2pt;
}
.stock-data .stock-delta-up { color: green; }
.stock-data .stock-delta-up .arrow { display: block; }
.stock-data .stock-delta-down { color: red; }
.stock-data .stock-delta-down .arrow { display: block; }
.stock-data .stock-previous {
	width: 206px;
}
.stock-data .stock-open {
	width: 162px;
}

.sub_layer {
position: absolute;
}
</style>
<?php
//<script src="js/jquery-1.5.js"></script>
?>
<script src="/resource/js/jquery-3.3.1.min.js"></script>
<script>

	var scoller;

	function get_stock(data){
		$stock = data;
		//&#8595;down
		//&#8593;up 
		//arrow class stock-delta-up / stock-delta-down
		
		var $layer = jQuery("div[name=layer-A]");
		//$layerA.addClass("sub_layer");
		var $stock_body = '<div class="stock-data" name="indexes" number="##number##">' +
							'<table>' +
							'<tbody>' +
							'<tr>' +
							'<td class="spacer"></td>' +
							'<td class="stock-default-style stock-number">##id##</td>' +
							'<td class="spacer spacer-20"></td>' +
							'<td class="stock-default-style stock-name">##name##</td>' +
							'<td class="stock-default-style stock-price">##last##</td>' +
							'<td class="stock-default-style stock-delta ##arrowclass##"><span class="delta">##change##</span><span class="arrow">##arrow##</span></td>' +
							'<td class="stock-default-style stock-previous">##prevclose##</td>' +
							'<td class="stock-default-style stock-open">##open##</td>' +
							'</tr>' +
							'</tbody>' +
							'</table>' +
							'</div>';

			var $temp_stock_body = "";							
		jQuery.each(data, function(index, value){

			var $temp_change = "", $temp_arrowclass = "", $temp_arrow = "";
			
			if(value['change'] > 0){
				$temp_change = 	parseFloat(value['change']).toFixed(2);
				$temp_arrowclass = "stock-delta-up";
				$temp_arrow = "&#8593;";
			}else if(value['change'] < 0){
				$temp_change = 	parseFloat(value['change']).toFixed(2).replace("-", "");
				$temp_arrowclass = "stock-delta-down";
				$temp_arrow = "&#8595;";
			}else{
				$temp_change = 	parseFloat(value['change']).toFixed(2);
			}

			$temp_stock_body = $temp_stock_body + $stock_body	.replace("##id##", value['id'])
																.replace("##name##", value['name'])
																.replace("##last##", parseFloat(value['last']).toFixed(2))
																.replace("##change##", $temp_change)
																.replace("##arrowclass##", $temp_arrowclass)
																.replace("##arrow##", $temp_arrow)																																
																.replace("##prevclose##", parseFloat(value['prevclose']).toFixed(2))
																.replace("##open##", parseFloat(value['open']).toFixed(2))
																.replace("##number##", index);
			var temp_height = $layer.height();
			$layer.empty().html('').append($temp_stock_body);

		});



	}
	

	function checkposition(){
		if(jQuery("div[name=layer-A]").position().top > 0){
			jQuery.getJSON("/resource/api/stock.php?ver=1", {}, get_stock);
		}
	}
	jQuery(document).ready(function(){
		jQuery.getJSON("/resource/api/stock.php?ver=1", {}, get_stock)
			 .complete(function(){
				var $checkposition = window.setInterval(checkposition, 5000);
			 });
		
		
	});
	
	
</script>

<marquee behavior="scroll" direction="up" scrollamount="2" id="scroller"><div name="layer-A">&nbsp;</div></marquee>