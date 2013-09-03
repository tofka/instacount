$(document).ready(function(){		
// TO-DO: Ta fram tag istf name i select. Hidea count-fältet		
	var clientID = "8e9859334c044b19aaa2ee526a57fa64";
	$('.instagram').focus(function(){
		$('.tag').text('');
		$('#instacount_instacountbundle_counter_count').val('');
	});
	$('#instacount_instacountbundle_counter_campaign option').click(function() {
		var tagname = $(this).text();		
		console.log(tagname);
		var url = "https://api.instagram.com/v1/tags/" + tagname + "?client_id=" + clientID;
	 	$.ajax({
	    	type: "GET",
	    	dataType: "jsonp",
	     	cache: false,
	     	url: url,
	     	success: function (res) {
	     		console.log(res.data.media_count);				     			
        		$('#instacount_instacountbundle_counter_count').val(res.data.media_count);			      		
	      	}
		});				
	});
});