$(document).ready(function() {
	$('.toggle.hide').hide();
	$('.change').click(function() {
		$('.toggle').toggle();
	})
})

google.load('visualization', '1', {'packages':['corechart']});
google.setOnLoadCallback(drawChart);
function drawChart() { 
for (i = 0; i < count.length; i++){
	var url = count[i];
	var jsonData = $.ajax({
		url: url,
		dataType:"json",
		async: false
	}).responseText;
	var data = new google.visualization.DataTable(jsonData);
	var options = {		
		lineWidth: 6,		
		vAxis: {
			baselineColor: '#666', gridlines: {
				color: '#666', count: 6},
				textStyle: {
					fontName: 'Berthold City Medium',
  					fontSize: 12
  				}
			},
		hAxis: {
			baselineColor: '#666', format:'dd MMM', gridlines: {
				color: '#666', count: 10},
				textStyle: {
					fontName: 'Berthold City Medium',
  					fontSize: 12
  				}
			},
		interpolateNulls: true,
		backgroundColor: {
			strokeWidth: 10, 
			fill: '#000', 
			stroke: '#000'
		},
		legend: {
			position: 'none'
		},		
		colors: ['#f6ac1d'],	
		titleTextStyle: { 
			color: '#666',
  			fontName: 'berthold city',
  			fontSize: 20,  			
  		}
	};

    var id = count[i];
   
	var chart = new google.visualization.LineChart(document.getElementById(id));
	//$(window).resize(function () {
   
   chart.draw(data, options);
//});
	
}
}
       
