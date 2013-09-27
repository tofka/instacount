$(document).ready(function(){				
	var clientID = "8e9859334c044b19aaa2ee526a57fa64";
	$('#instacount_instacountbundle_counter_count').parent().parent().hide();
	$('.start label').hide();
	$('#instacount_instacountbundle_counter_timestamp').parent().hide();
	
	//$('#instacount_instacountbundle_counter_campaign').val('Välj en kampanj i listan');
	$('.submit').click(function(e) {
		var search = $('.search').val();
		var select = $('#instacount_instacountbundle_counter_campaign').val();		
		if (  (!select) & (!search)  ) {
			alert('Välj en kampanj i listan eller skriv in valfri tag!');
			e.preventDefault();
		}
		
		else if (search) {
			e.preventDefault();
			var search_tagname = $('.search').val(); 
			console.log(search_tagname);
			var url = "https://api.instagram.com/v1/tags/" + search_tagname + "?client_id=" + clientID;
			$.ajax({
			    type: "GET",
			    dataType: "jsonp",
			    cache: false,
			    url: url,
			    success: function (res) { 	    	
					$.mobile.changePage('#search-result');	
			        $('.tag').append('#' + res.data.name);                            
			        $('.count').append(res.data.media_count);                    
				}
			}); 			      
		}
	}) 

	$('#instacount_instacountbundle_counter_campaign option').click(function() {
		var search = $('.search').val();
		if ( !search) {
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
		}
	});
});