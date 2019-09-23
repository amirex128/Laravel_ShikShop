/*Dashboard2 Init*/
"use strict"; 

/*****Ready function start*****/
$(document).ready(function(){
	if( $('#pie_chart_4').length > 0 ){
		$('#pie_chart_4').easyPieChart({
			barColor : '#0092ee',
			lineWidth: 10,
			animate: 3000,
			size:	165,
			lineCap: 'square',
			trackColor: '#f4f4f4',
			scaleColor: false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
	}
	
	if( $('#datable_1').length > 0 )
		$('#datable_1').DataTable({
			"bFilter": false,
			"bLengthChange": false,
			"bPaginate": false,
			"bInfo": false,
		});
	
	if($('#chart_1').length > 0) {
		var lineChart = Morris.Area({
			element: 'chart_1',
			data: data,
			xkey: 'period',
			ykeys: ['iphone'],
			labels: ['فروش '],
			pointSize: 4,
			lineWidth: 2,
			pointStrokeColors:['#ffffff'],
			pointFillColors:['#0092ee'],
			behaveLikeLine: true,
			gridLineColor: 'rgba(33,33,33,0.1)',
			smooth: false,
			hideHover: 'auto',
			lineColors: ['#0092ee'],
			resize: true,
			gridTextColor:'#878787',
			gridTextFamily:"Roboto",
			parseTime: false,
			fillOpacity:.1
		});	
	}
});
/*****Ready function end*****/

/*****Load function start*****/
// $(window).on("load",function(){
// 	window.setTimeout(function(){
// 		$.toast({
// 			heading: 'به پنل فروشگاه خوش آمدید',
// 			text: 'Use the predefined ones, or specify a custom position object.',
// 			position: 'bottom-right',
// 			loaderBg:'#e8af48',
// 			icon: 'success',
// 			hideAfter: 3500, 
// 			stack: 6
// 		});
// 	}, 3000);
// });
/*****Load function* end*****/

/*****E-Charts function start*****/
var echartsConfig = function() { 
	if( $('#e_chart_3').length > 0 ){
		var eChart_3 = echarts.init(document.getElementById('e_chart_3'));
		var data = [{
			value: 5713,
			name: ''
		}, {
			value: 9938,
			name: ''
		}, {
			value: 17623,
			name: ''
		}];
		var option3 = {
			tooltip: {
				show: true,
				trigger: 'item',
				backgroundColor: 'rgba(33,33,33,1)',
				borderRadius:0,
				padding:10,
				formatter: "{b}: {c} ({d}%)",
				textStyle: {
					color: '#fff',
					fontStyle: 'normal',
					fontWeight: 'normal',
					fontFamily: "'Roboto', sans-serif",
					fontSize: 12
				}	
			},
			series: [{
				type: 'pie',
				selectedMode: 'single',
				radius: ['80%', '30%'],
				color: ['#22af47', '#0092ee', '#f83f37'],
				labelLine: {
					normal: {
						show: false
					}
				},
				data: data
			}]
		};
		eChart_3.setOption(option3);
		eChart_3.resize();
	}
}
/*****E-Charts function end*****/

/*****Resize function start*****/
var sparkResize,echartResize;
$(window).on("resize", function () {
	/*E-Chart Resize*/
	clearTimeout(echartResize);
	echartResize = setTimeout(echartsConfig, 200);
}).resize(); 
/*****Resize function end*****/

/*****Function Call start*****/
echartsConfig();
/*****Function Call end*****/