<?php
/*Plugin Name: List Subpages Widget
Description: This widget checks if the current page has parent or child pages and if so, outputs a list of the highest ancestor page.
Version: 0.1
Author: Ivan Krot
Author URI: 
License: GPLv2
*/
function check_for_page_tree() {
    //start by checking if we're on a page
	if( is_page() ) {  
		global $post; 
        // next check if the page has parents
		if ( $post->post_parent ){    
            // fetch the list of ancestors
			$parents = array_reverse( get_post_ancestors( $post->ID ) );        
            // get the top level ancestor
			return $parents[0];           
		}       
        // return the id  - this will be the topmost ancestor if there is one, or the current page if not
		return $post->ID;
	}
}
//add new Class for WP_Widget
class List_Pages_Widget extends WP_Widget {     
	function __construct() {
		parent::__construct(      
        // base ID of the widget
			'list_pages_widget',       
        // name of the widget
			__('List Related Pages', 'softgroup' ),        
        // widget options
			array (
				'description' => __( 'Identifies where the current page is in the site structure and displays a list of pages in the same section of the site. Only works on Pages.', 'softgroup' )
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
    	<label for="<?php echo $this->get_field_id( 'depth' ); ?>">Depth of list:</label>
    	<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" value="<?php echo esc_attr( $depth ); ?>">
    </p>           
    <?php
  }  
  function update( $new_instance, $old_instance ) {
  	$instance = $old_instance;
  	$instance[ 'depth' ] = strip_tags( $new_instance[ 'depth' ] );
  	return $instance;  
  }    
	function widget( $args, $instance ) {      
	}  
}

//register widget
function register_list_pages_widget() {
    register_widget( 'List_Pages_Widget' );
}
add_action( 'widgets_init', 'register_list_pages_widget' );

?>