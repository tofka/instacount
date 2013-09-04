$(document).ready(function(){		
// TO-DO: Ta fram tag istf name i select. 		
	var clientID = "8e9859334c044b19aaa2ee526a57fa64";
	$('#instacount_instacountbundle_counter_count').parent().parent().hide();
	$('.start label').hide();
	$('#instacount_instacountbundle_counter_timestamp').parent().hide();
	$('#instacount_instacountbundle_counter_campaign option:first-child').attr('selected', 'selected').text('Välj en kampanj i listan');
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