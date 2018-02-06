<?php

/*
Plugin Name: Eaze Giphy Search
Plugin URI: https://eaze.com
Description: A demo project showing the basics of a plugin that creates a custom meta box in the WP backend and allows a user to search and use gifs. 
Version: 9999
Author: Aaron Podbelski
Author URI: http://www.portmanteaudesigns.com
License: GPLv2 or later
Text Domain: eaze-giphy-search
*/



if ( !function_exists( 'add_action' ) ) {
	echo 'Error, function already exists';
	exit;
}

global $post;

define( 'EAZE_GIPHY_SEARCH_VERSION', '9999' );
define( 'EAZE_GIPHY_SEARCH__MINIMUM_WP_VERSION', '4.0' );
define( 'EAZE_GIPHY_SEARCH__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


register_activation_hook( __FILE__, array( 'eaze-giphy-search', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'eaze-giphy-search', 'plugin_deactivation' ) );

add_action('wp_enqueue_scripts', array( $this, 'giphy_load_ajax'));
wp_enqueue_style( 'eaze-giphy-search-style', '/wp-content/plugins/Eaze%20Giphy%20Search/eaze-giphy-search-style.css');

if( !class_exists('Eaze_Giphy')) {

	class Eaze_Giphy {


		/**
		 * Object constructor for plugin
		 *
		 * Runs on the admin_init hook
		 */
		function __construct() {


			add_action('add_meta_boxes', array( $this, 'giphy_load_ajax'));
			add_action('add_meta_boxes', array( $this, 'add_giphy_meta_box'));
			
		}
		
		function add_giphy_meta_box() {
			add_meta_box("eaze-giphy-meta-box", "Giphy Search", array( $this, "eaze_giphy_meta_box_markup"), "post", "normal", "high", null);
		}
		
		function eaze_giphy_meta_box_markup() {
			echo "<p>Select up to 3 GIFs by searching, then clicking and ordering the GIFs you want to add to your post.</p>";
			echo "<p>Gifs that have already been added to a post will appear here when the post is loaded. You can add and remove by click them and selecting Add GIFs to Post</p>";
			
			
			echo '<form id="giphy-search-form" action="search-giphy.php">Search:<input type="text" id="giphy-search-term" name="gif_search"><br><input type="submit" id="giphy-search-button" value="Search"><br><input type="submit" id="giphy-finished-button" value="Add GIFs to Post"><br><div id="giphy-results">';

			$selected_gif_1 = get_post_meta(get_the_ID(), 'Post_GIF_1' );
			$selected_gif_2 = get_post_meta(get_the_ID(), 'Post_GIF_2' );
			$selected_gif_3 = get_post_meta(get_the_ID(), 'Post_GIF_3' );
			
			if($selected_gif_1[0] != null) {
				echo  '<img class="gif-options" src="'. $selected_gif_1[0].'" >';
			}
			if($selected_gif_2[0] != null) {
				echo  '<img class="gif-options" src="'. $selected_gif_2[0].'" >';
			}
			if($selected_gif_3[0] != null) {
				echo  '<img class="gif-options" src="'. $selected_gif_3[0].'" >';
			}

			echo '</div>';

			//Automatically select any gifs that have already been added to the post. 
			echo '<script type="text/javascript"> $(document).ready(function(){ $("img.gif-options").addClass("selected");	});  </script>';
			
			
		} //function eaze_giphy_meta_box_markup
		
		function giphy_load_ajax() {
		    wp_enqueue_script( 'giphy-ajax', plugins_url( '/giphy-ajax.js', __FILE__ ), array( 'jquery' ), '', true);
		}
		
	}//Class

}

new Eaze_Giphy();
























?>