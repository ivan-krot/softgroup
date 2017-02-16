<?php
/*
Plugin Name: Single post 'title/category'
Description: Plugin add category list after the TITLE in evry single post
Version: 1.0
Author: Ivan Krot
Author URI:
*/

add_action('my_action_start', 'filter_title');
function filter_title(){
		?>
		<span><?php echo get_theme_mod('separator'); the_category(',')?>
		<?php
	}

