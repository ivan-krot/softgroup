<?php
/*Plugin Name: Quote Post Format
Description: This widget is displayed posts with checked format.
Version: 1.0
Author: Ivan Krot
Author URI: 
License: GPLv2
*/
//add new Class for WP_Widget
global $set_post;
class Post_Format_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(      
        // base ID of the widget
      'post_format_widget',       
        // name of the widget
      __('Format Posts', 'softgroup' ),        
        // widget options
      array (
        'description' => __( 'This widget is displayed last posts with selected format. For example quote, link, gallery, aside, image, video, chat, audio, status.', 'softgroup' )
        )        
      );   
  }
  function form( $instance) {
    $defaults = array(
      'depth' => '0',
      'count' => '1',
      );
    $depth = $instance[ 'depth' ];
    $count = $instance[ 'count' ];
    // markup for form ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'depth' ); ?>">Enter a format of post(link,quote,gallery...):</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" value="<?php echo esc_attr( $depth ); ?>">
      <label for="<?php echo $this->get_field_id( 'count' ); ?>">Type the count:</label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo esc_attr( $count ); ?>">
    </p>
    <?php
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'depth' ] = strip_tags( $new_instance[ 'depth' ] );
    $instance[ 'count' ] = strip_tags( $new_instance[ 'count' ] );
    return $instance;
  }
  function widget( $args, $instance ) {
    extract($args);
    $args = array(
      'depth' => $instance[ 'depth' ],
      );
    echo $before_widget;
    echo $before_title . 'Latest post with '. $instance[ 'depth' ] . ' format.' . $after_title;

    $args = array(
      'numberposts' => 1000,
      'category'    => 0,
      'orderby'     => 'date',
      'order'       => 'DESC',
      'post_type'   => 'post',
      'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
      );
    $posts = get_posts($args);
    $stop = 0;
    foreach($posts as $post){
      if ($stop == $instance[ 'count' ]){
        break;
      }
      if(get_post_format($post->ID) == $instance ['depth']){
        $url = get_permalink($post->ID);
        ?>
          <a href="<?php echo $url ?>" target="_blank"><?php echo $post->post_title; ?></a><br>
        <?php
        if (get_post_format($post->ID) == 'quote' || get_post_format($post->ID) == 'aside') {
          ?>
          <a href="<?php echo $url ?>" target="_blank"><?php echo $post->post_content; ?></a><br>
        <?php
        }
        $stop++;
      }
    }
  }
}

//register widget
function register_post_format_widget() {
    register_widget( 'Post_Format_Widget' );
}
add_action( 'widgets_init', 'register_post_format_widget' );

?>