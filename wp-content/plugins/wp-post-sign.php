<?php
/*
Plugin Name: Post marker
Description: Plugin add NOTES under evry post
Version: 1.0
Author: Ivan Krot
Author URI:
*/

add_filter( 'the_content', 'wfm_sign_content' );

function wfm_sign_content($content){
	if( !is_single() ) return $content;
	$wfm_sign = '<div class="alignright"><em>This text was wrote by "Post marker" plugin</em></div>';
	return $content . $wfm_sign;
}