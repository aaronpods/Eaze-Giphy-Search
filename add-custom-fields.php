<?php
include '../../../wp-load.php';

	if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

	global $post;	
	
	$gif_1 = $_POST['gif_1'];
	$gif_2 = $_POST['gif_2'];
	$gif_3 = $_POST['gif_3'];
	
	$post_id = $_POST['the_id'];
	
	//only add post meta data if a user selected it. 	
	if ( ! add_post_meta( $post_id, 'Post_GIF_1', $gif_1, true ) ) { 
	   update_post_meta( $post_id, 'Post_GIF_1', $gif_1 );
	}
	if ( ! add_post_meta( $post_id, 'Post_GIF_2', $gif_2, true ) ) { 
	   update_post_meta( $post_id, 'Post_GIF_2', $gif_2 );
	}
	if ( ! add_post_meta( $post_id, 'Post_GIF_3', $gif_3, true ) ) { 
	   update_post_meta( $post_id, 'Post_GIF_3', $gif_3 );
	}

	return true;













?>