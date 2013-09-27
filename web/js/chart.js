$(document).ready(function(){   
   
//$.mobile.loadPage(count_url );

    $('.chart').click(function() {
        
        alert(chart_url);
        $.mobile.changePage('#chart' );

    });
});