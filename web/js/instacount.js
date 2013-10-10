$(document).ready(function(){	
	var clientID = "8e9859334c044b19aaa2ee526a57fa64";
	$('#append').hide();
	$('#form_data').hide();
	$('form label').hide();
	if(typeof tags != 'undefined') {
		for (var i = 0; i < tags.length; i++) {
			var tagname = tags[i];
			var url = "https://api.instagram.com/v1/tags/" + tagname + "?client_id=" + clientID;
			$.ajax({
			    type: "GET",
			    dataType: "jsonp",
			    cache: false,
			    url: url,
			    success: function (res) { 			    	
			    	$('#append').append('{"tag":"' + res.data.name + '","count":' +  res.data.media_count + '},' );
			    	
			    	// Ajax för att skicka alla counts till controller, kan inte tas emot
			    	/*$.ajax({  
						type: "POST",  
		 				url: save_url,  
		 				data: ,
		 				success: function(response) {
	    				}
					});	*/	    	
				}
			}); 	
		}	
		$('.save').click(function() {			
			var json = $('#append').text().slice(0,-1);
			$('#append').text(json);
			var data = $('#append').append(']').text();
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
});