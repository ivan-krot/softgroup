<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SoftGroup
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<!--Displayed users menu in the footer-->
		<div class="main-navigation">
			<div>Footer Menu by Me )</div>
			<?php wp_nav_menu( array( 'theme_location' => 'bottom') ); ?>
		</div><!-- footer-navigation, class 'main-navigation' like as main navigation-->
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'softgroup' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'softgroup' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'softgroup' ), 'softgroup', '<a href="https://automattic.com/" rel="designer">Underscores.me</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
