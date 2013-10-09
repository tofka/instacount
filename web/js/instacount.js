$(document).ready(function(){	
	var clientID = "8e9859334c044b19aaa2ee526a57fa64";
	$('#append').hide();
	$('#form_data').hide();
	$('form label').hide();
	if(typeof tags != 'undefined') {
		for (var i = 0; i < tags.length; i++) {
			var tagname = tags[i];
			var url = "https://api.instagram.com/v1/tags/" + tagname + "?client_id=" + clientID;
			//var data = '[';
			$.ajax({
			    type: "GET",
			    dataType: "jsonp",
			    cache: false,
			    url: url,
			    success: function (res) { 
			    	//data += '{"name":"' + res.data.name + '","count":"' + res.data.media_count + '}",';
			    	//$('#form_data').val(data);
			    	$('#append').append('{"tag":"' + res.data.name + '","count":' +  res.data.media_count + '},' );
			    	
			    	// Ajax för att skicka alla counts till controller, kan inte tas emot
			    	/*$.ajax({  
						type: "POST",  
		 				url: save_url,  
		 				data: data.counts,
		 				success: function(response) {
		 					console.log(data.counts);
		 					// I konsollen får jag ut:
		 					// [Object { name="Hej", count="150"}] 
	    				}
					});	*/	    	
				}
			}); 	
		}	
		$('.save').click(function() {
			
			var json = $('#append').text().slice(0,-1);
			$('#append').text(json);
			var data = $('#append').append(']').text();
			
			console.log(json);
			$('#form_data').val(data);
		});

		$('.submit').click(function(e) {
		var search = $('.search').val();
		var select = $('#instacount_instacountbundle_counter_campaign').val();	
		if ( (!select) & (!search) ) {
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
					$('.count p').text('');
					$('.tag').text('');
					$.mobile.changePage('#search-result');	
					$('.tag').append('#' + res.data.name);
					var length = String(res.data.media_count).length;
					if (length > 3) {
						$('.count p').css('font-size','5em').append(res.data.media_count);
					}
					else {						
						$('.count p').append(res.data.media_count);
					}
					$('.search').val('');
					search_tagname = '';
				}
			});
		}
	});
	}
	/*
	$('#instacount_instacountbundle_counter_count').parent().parent().hide();
	$('.start label').hide();
	$('#instacount_instacountbundle_counter_timestamp').parent().hide();
	$('.submit').click(function(e) {
		var search = $('.search').val();
		var select = $('#instacount_instacountbundle_counter_campaign').val();	
		if ( (!select) & (!search) ) {
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
					$('.count p').text('');
					$('.tag').text('');
					$.mobile.changePage('#search-result');	
					$('.tag').append('#' + res.data.name);
					var length = String(res.data.media_count).length;
					if (length > 3) {
						$('.count p').css('font-size','5em').append(res.data.media_count);
					}
					else {						
						$('.count p').append(res.data.media_count);
					}
					$('.search').val('');
					search_tagname = '';
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
		
	});*/

		
	
});