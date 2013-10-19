google.load("visualization", "1", {packages:["map"]});
google.setOnLoadCallback(drawMap);
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
