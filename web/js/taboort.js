$(document).ready(function(){	
	
	if(typeof facebook_urls != 'undefined') {
		for (var i = 0; i < facebook_urls.length; i++) {
			var url = facebook_urls[i];
			$.ajax({
			    type: "GET",
			    dataType: "jsonp",
			    cache: false,
			    url: url,
			    success: function (res) { 
			    	console.log(res.data);
			    }   					
			}); 	
		}
	}
});

		