<?php
/*
Plugin Name: Tooltips
Plugin URI: http://www.a-scripts.com/wordpress-plugins/tooltips-for-wordpress/
Description: Simple filter plugin that allows you to use tooltips for words / phrases.
Author: Andrej Farkas
Version: 1.0
Author URI: http://www.a-scripts.com
*/

/*
Copyright 2009  Andrej Farkas (http://www.a-scripts.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details: http://www.gnu.org/licenses/gpl.txt
*/


function as_tooltip_scripts() 
{
	wp_enqueue_script( "as_tooltip_script", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/as_tooltip.js"), array( 'jquery' ) );
}

function as_add_tooltips( $strContentHtml )
{
	$aryMatchesArray = array();
	preg_match_all( '/\[:ttip=".*" id=".*"\].*\[:\/ttip\]/U', $strContentHtml, $aryMatchesArray );
	$strContentHtml = preg_replace( '/\[:ttip="(.*)" id="(.*)"\](.*)\[:\/ttip\]/U', '<span id="tip-$2" class="ttip-span">$3</span>', $strContentHtml );
	foreach ( $aryMatchesArray[0] as $strMatch )
	{
		$strContentHtml .= preg_replace( '/\[:ttip="(.*)" id="(.*)"\].*\[:\/ttip\]/U', '<div id="ttip-$2" class="ttip-div">$1</div>', $strMatch );
	}
	
	return $strContentHtml;
}

function as_tooltip_css()
{
	printf( '<link rel="stylesheet" type="text/css" media="screen" href="%s/style.css"/>',
			path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )) );
}

add_filter('the_content', 'as_add_tooltips');
add_action('wp_head', 'as_tooltip_css');
add_action('wp_print_scripts', 'as_tooltip_scripts');