$(document).ready(function(){	
	var clientID = "8e9859334c044b19aaa2ee526a57fa64";
	// KOLLA!
	$('form.start>div.ui-input-text>input.search').click(function() {
		$(this).val('');
	})
	$('#append').hide();
	$('#position').hide();
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
				}   					
			}); 	
		}
// Kör funktionen storePositions() för varje tag:
		for (var i = 0; i < tags.length; i++) {
			storePositions(i);
		}
// Stäng json vid submit och skicka till val():
		$('.save').click(function() {			
			var json = $('#append').text().slice(0,-1);
			$('#append').text(json);
			var data = $('#append').append(']').text();			
			var position = $('#position').text();
			$('#form_position').val(position);
			$('#form_data').val(data);
		});
	}	

// Fritext-sök:
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
// Hämta positions:
	function storePositions(i){
		var tag = tags[i];
		var url_recent = "https://api.instagram.com/v1/tags/" + tag + "/media/recent?client_id=8e9859334c044b19aaa2ee526a57fa64&count=50"
	   	$('#position').append('<span class="slice ' + tag + '">|---' + tag + '</span>');		   
	   	    $.ajax({
		    type: "GET",
		    dataType: "jsonp",
		    cache: false,
		    url: url_recent,
		    success: function (r) { 
		    	append(tag, r.data);			   		
		    }
		});
	}
});
// Lägg positions i div
function append(tag, photo) {	
	for (var i = 0; i < photo.length; i++){
	   	if (photo[i].location == null){
  			$('#position .'+tag).append('---null,null');
   		}
   		else {
  			$('#position .'+tag).append('---' + photo[i].location.latitude + ',' + photo[i].location.longitude);
  		}
    }
}

