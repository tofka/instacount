
google.load('visualization', '1', {'packages':['corechart']});
google.setOnLoadCallback(drawChart);
function drawChart() {   	
	var jsonData = $.ajax({
		url: url,
		dataType:"json",
		async: false
	}).responseText;
	var data = new google.visualization.DataTable(jsonData);
	var options = {		
		lineWidth: 10,
		pointSize: 50,
		vAxis: {
			baselineColor: '#eeee00', gridlines: {
				color: 'purple', count: 4}
			},
		hAxis: {
			baselineColor: '#eeee00', format:'dd MMM', gridlines: {
				color: 'purple', count: -1}
			},
		backgroundColor: {
			strokeWidth: 10, 
			fill: '#ccc', 
			stroke: '#000'
		},
		curveType: 'function',
		fontName: 'monospace',
		colors: ['#e0440e'],	
		titleTextStyle: { 
			color: '#00ff00',
  			fontName: 'Arial',
  			fontSize: 30,
  			bold: true,
  			italic: true 
  		},	
		title: "Antal tags för #" + tag +" under perioden " + startDate + " - " + now
	};
	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}

