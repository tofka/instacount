$(document).ready(function(){  
	if(window.orientation == 0) {
	    $('.toggle.landscape').hide();			
	}
	else {
		$('.toggle.portrait').hide();	
	}	
	$( window ).on( "orientationchange", function( event ) {
		
		$('#chart_div').show();
		$('.toggle').toggle();		
	});
		$('#chart_div').click(function(){
			$(this).hide();
			displayMap();
			
		});
	
});     
function displayMap() {
                    document.getElementById('map_div').style.display="block";
                    drawMap();
                }
google.load("visualization", "1", {packages:["map"]});
google.setOnLoadCallback(drawMap);
google.load('visualization', '1', {'packages':['corechart']});
google.setOnLoadCallback(drawChart);
function drawChart() { 
	if (typeof url_chart != 'undefined'){
		console.log(url_map);
		var jsonData = $.ajax({
			url: url_chart,
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
		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		
   			chart.draw(data, options);
	
	}
}

    
function drawMap() {
  if (typeof url_map != 'undefined'){
    var jsonData = $.ajax({
	    url: url_map,
	    dataType:"json",
	    async: false
    }).responseText;
    var data = new google.visualization.DataTable(jsonData);
    var options = { 
      mapType: 'normal',
      showTip: true
    }
    var map = new google.visualization.Map(document.getElementById('map_div'));
    $(window).resize(function () {
		  map.draw(data, options);
		});
  }
}  
