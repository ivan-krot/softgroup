<?php
/*Plugin Name: My Menu Pages
Description: Some description )
Version: 1.0.0
Author: Ivan Krot
Author URI: 
License: GPLv2
*/

function get_child_pages_by_parent($id, $depth) {
	$child = new WP_Query( array(
		'post_type'      => 'page',
		'post_parent'    => $id,
		) );
	if ($child->have_posts()){
		?>
		<ul>
			<?php
			while ($child->have_posts() ) :
				$child ->the_post();
			?>
			<li><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></li>
			<?php
			$id = get_the_ID();
			$depth--;
			if ($depth > 0) {
				get_child_pages_by_parent($id, $depth);
			}
			endwhile;
			?>
		</ul>
		<?php 
	}
}

class My_Menu extends WP_Widget {
	function __construct() {
		parent::__construct(
			'my_menu',
			'My Menu',
			array( 'description' => __( 'Description menu', 'softgroup' ), )
			);
	}
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['depth'] = strip_tags( $new_instance['depth'] );
		return $instance;
	}
	function form( $instance ) {
		$depth = $instance[ 'depth' ];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Menu title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
			name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" 
			value="<?php echo $instance['title']; ?>" />
			<label for="<?php echo $this->get_field_id( 'depth' ); ?>">Depth of list (count of 'children'):</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" value="<?php echo esc_attr( $depth ); ?>">
			<i>(set up '0' value for show only TOP pages)</i>
		</p>           
		<?php
	}
	function widget( $args, $instance ) {
		echo $before_widget;    	
		echo $before_title;
		?>
		<h2 class="widget-title"><?php echo $instance[ 'title' ] ?></h2>
		<?php echo $after_title; ?>
		<ul>
			<?php
			$query = new WP_Query( array(
				'post_type'      => 'page',
				'post_parent'    => 0,
				) );
			while ( $query->have_posts() ) :
				$query->the_post();
			?>
			<li>
				<a href="<?php the_permalink(); ?>" target="_blank"><?php the_title();?></a>
				<?php
				$id = get_the_ID();
				global $depth;
				$depth = $instance[ 'depth' ];
				if ($depth) {
					get_child_pages_by_parent($id, $depth);
				}
				?>	
			</li>
			<?php
			endwhile;
			?>
		</ul>
		<?php
	}
}
add_action( 'widgets_init', function(){
	register_widget( 'My_Menu' );
});