<?php
/**
 * @package Hallo Spaceboy
 * @version 1.7
 */
/*
Plugin Name: Hallo Spaceboy
Plugin URI: https://github.com/lukecav/hallo-spaceboy
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by David Bowie: Hallo Spaceboy. When activated you will randomly see a lyric from <cite>Hallo Spaceboy</cite> in the upper right of your admin screen on every page.
Author: Luke Cavanagh
Version: 1.7
Author URI: https://github.com/lukecav
*/

function hallo_spaceboy_get_lyric() {
	/** These are the lyrics to Hallo Spaceboy */
	$lyrics = "Hallo Spaceboy, 
you're sleepy now 
Your silhouette is so stationary
You're released but your custody calls
And I want to be free
Don't you want to be free
Do you like girls or boys
It's confusing these days
But Moondust will cover you
Cover you
This chaos is killing me";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hallo_spaceboy() {
	$chosen = hallo_spaceboy_get_lyric();
	echo "<p id='spaceboy'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hallo_spaceboy' );

// We need some CSS to position the paragraph
function spaceboy_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#spaceboy {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'spaceboy_css' );

?>
