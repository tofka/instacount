
console.log(url);     	
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
		width: 320, height: 480,
		title: "Antal tags för #" + tag +" under perioden " + startDate + " - " + now
	};
	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}