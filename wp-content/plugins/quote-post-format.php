<?php
/*Plugin Name: Quote Post Format
Description: This widget is displayed all posts with format "Quote"
Version: 1.0
Author: Ivan Krot
Author URI: 
License: GPLv2
*/

//add new Class for WP_Widget
class Post_Format_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(      
        // base ID of the widget
			'post_format_widget',       
        // name of the widget
			__('Format Posts', 'softgroup' ),        
        // widget options
			array (
				'description' => __( 'This widget is displayed posts with post selected format. For example Quote, Link, Gallery and other', 'softgroup' )
				)        
			);   
	}
	function form( $instance ) {
		$defaults = array(
			'depth' => '-1'
			);
		$depth = $instance[ 'depth' ];  
    // markup for form ?>
    <p>
    	<label for="<?php echo $this->get_field_id( 'depth' ); ?>">Select format of posts:</label>
    	<select>
    	<option>Quote</option>
    		<option>Link</option>
    	</select>
    </p>           
    <?php
  }
	function update( $new_instance, $old_instance ) {
	}
	function widget( $args, $instance ) {
	}
}

//register widget
function register_post_format_widget() {
    register_widget( 'Quote_Format_Widget' );
}
add_action( 'widgets_init', 'register_post_format_widget' );

?>