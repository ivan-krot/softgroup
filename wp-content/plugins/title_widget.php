<?php
/*Plugin Name: Trainee Widget
Description: Some description )
Version: 1.0.0
Author: Ivan Krot
Author URI: 
License: GPLv2
*/
class Trainee_Widget extends WP_Widget {
  function __construct() {
   parent::__construct(
     'trainee_widget',
     'Trainee Widget',
     array( 'description' => __( 'Widget for training )', 'softgroup' ), )
     );
 }
 function update( $new_instance, $old_instance ) {
   $instance = array();
   $instance['title'] = strip_tags( $new_instance['title'] );
   $instance['format'] = strip_tags( $new_instance['format'] );
   $instance['count'] = strip_tags( $new_instance['count'] );
   return $instance;
 }
 function form( $instance ) {
  ?>
  <p>
   <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title :</label>
   <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" 
   value="<?php echo $instance['title']; ?>" />
   <?php
   $arguments = array(
    'numberposts' => -1,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    );
   $formats = get_posts($arguments);
   $unique_formats = array();
   foreach($formats as $format){
    $get_format = get_post_format($format->ID);
    array_push($unique_formats, $get_format);
  }
  $unique_formats = array_unique($unique_formats);
  ?>
  <p>
    <label for="<?php echo $this->get_field_id('format'); ?>">Select format of posts :</label>
    <select name="<?php echo $this->get_field_name('format'); ?>" id="<?php echo $this->get_field_id('format'); ?>">
      <?php
      foreach ( $unique_formats as $format ) {
        echo '<option value="' . $format . '"'
        . selected( $instance['format'], $format, false )
        . '>' .$format . "</option>\n";
      }
      ?>
    </select>
  </p>
  <label for="<?php echo $this->get_field_id( 'count' ); ?>">Count of post`s :</label>
   <input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" 
   name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" 
   value="<?php echo $instance['count']; ?>" />
</p>
<?php
}
function widget( $args, $instance ) {
  ?>
  <h2 class="widget-title"><?php echo $instance[ 'title' ]; ?> (<?php echo $instance[ 'format' ]; ?>)</h2>
 <?php
 $arguments = array(
    'numberposts' => -1,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    );
 $posts = get_posts($arguments);
 $stop = 0;
 foreach($posts as $post){
      if ($stop == $instance[ 'count' ]){
        break;
      }
      if(get_post_format($post->ID) == $instance ['format']){
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
add_action( 'widgets_init', function(){
 register_widget( 'Trainee_Widget' );
});