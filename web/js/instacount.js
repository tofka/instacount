$(document).ready(function(){	
				localStorage.tagname;
			
				var clientID = "8e9859334c044b19aaa2ee526a57fa64";
				$('#tag_form').focus(function(){
					$('.tag').text('');
					$('.instagram').text('');
					$('#tag_form').val('');
				});
				$('.submit').click(function(){
					var tagname = $('#tag_form').val();
					console.log(tagname);
					localStorage.tagname += tagname + ' ';
						
					
					
					var url = "https://api.instagram.com/v1/tags/" + tagname + "?client_id=" + clientID;
				 	$.ajax({
				    	type: "GET",
				    	dataType: "jsonp",
				     	cache: false,
				     	url: url,
				     	success: function (res) {
				     		console.log(res.data.media_count);				     			
			        		$('.tag').append("<p style='color: red; font-weight: bold;'>" + res.data.name + "</p>");
			        		$('.instagram').append("<p>har taggats " + res.data.media_count + " gånger på Instagram.</p>");			        		
				      		$('.ui-btn-left').click(function(){
								$('#tag_form').val('Välj företag');		
													
							});
				      	}
					});						 
				});
				
		  	});