$(document).ready(function(){	
				localStorage.tagname;
			
				var clientID = "83f10e850f1742e68d3c355d11c8ec24";
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
			        		$('.tag').append("<p>" + res.data.name + "</p>");
			        		$('.instagram').append("<p>taggar på Instagram</p><p><span class='count'>" + res.data.media_count + "</span></p>");			        		
				      		$('.ui-btn-left').click(function(){
								$('#tag_form').val('Välj företag');		
													
							});
				      	}
					});						 
				});
				
		  	});