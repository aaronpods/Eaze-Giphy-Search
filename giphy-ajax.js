/* attach a submit handler to the form */



$(document).ready(function(){
	$("#giphy-search-button").click(function(event) {

		/* stop form from submitting normally */
		event.preventDefault();
		var searchQuery = $('#giphy-search-term').val().replace(' ','+');
		var number_of_gifs = 5;
		
		var xhr = $.get("https://api.giphy.com/v1/gifs/search?q=" + searchQuery + "&api_key=e6p4x0purzFsR3Olm8TwglCTNwcUWcbR&limit=" + number_of_gifs);
		
		//Success in getting gifs
		xhr.done(function(data) { 
			 
			var response = JSON.parse(xhr.responseText);
			var dataArray = response.data;
			var theGif = dataArray[0].images.fixed_height.url;
			var gifArray = new Array();
			
			for(var i=0; i < dataArray.length; i++){
				gifArray.push('<img class="gif-options" src="' + dataArray[i].images.fixed_height.url + '">');
				$("#giphy-results").prepend(gifArray[i]);
				console.log(gifArray[i]);
			}
						
		});
		
		//failed getting gifs
		xhr.fail(function( data ) {
			alert('error: ' + JSON.stringify(data));
			console.log(JSON.stringify(data));
		});	
			
	});
	
	
	//Code for adding the gifs to the post
	$("#giphy-finished-button").click(function(event) {
		event.preventDefault();
		var post_id = $("#post_ID").val();
		var selectedGifs = $(".selected"); //check the type of this
		
		/* Send the data to be added to the posts custom fields (using post with element id and custom field values)*/
		var posting = $.post( '/wp-content/plugins/Eaze%20Giphy%20Search/add-custom-fields.php', { the_id: post_id, gif_1: selectedGifs["0"].currentSrc, gif_2: selectedGifs["1"].currentSrc, gif_3: selectedGifs["2"].currentSrc } );
	
		/* Alerts the results */
		posting.done(function( data ) {
			alert('GIFs added to post.');
		});
		
		posting.fail(function( data ) {
			alert('Failed: ' + data);
		});
			
			
	});	
	
	
	//Code for selecting the gifs
	$("#giphy-results").on("click", "img", function(){
		$(this).toggleClass("selected");
	});
	

	$("#giphy-results").sortable();


});


	    




