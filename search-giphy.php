<?php
	if(!$_POST['name']) {
		echo 'error';
		exit;
	}
	$search_term = $_POST['name'];
	$sanitized_search_term = str_replace(" ", "+", $search_term);
	$search_query = 'http://api.giphy.com/v1/gifs/search?q=' . $sanitized_search_term . '&rating=g&api_key=e6p4x0purzFsR3Olm8TwglCTNwcUWcbR&limit=5';
	
	
	$giphy_response = json_decode(file_get_contents($search_query));
	
	$image1 = $giphy_response->data[0]->images->fixed_height->url;
	
	echo '<img src="'.$giphy_response->data[0]->images->fixed_height->url.'">';















?>