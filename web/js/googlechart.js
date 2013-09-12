var url = "{{ path('InstacountInstacountBundle_counter_json', {'campaign_id': campaign_id }) }}";
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
		title: "Antal #tags för {{ campaign.tag }} under perioden {{ campaign.startDate|date('Y-m-d') }} - {{ 'now'|date('Y-m-d') }}"
	};
	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}