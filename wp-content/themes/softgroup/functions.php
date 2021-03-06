<?php
/**
 * SoftGroup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SoftGroup
 */

if ( ! function_exists( 'softgroup_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function softgroup_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on SoftGroup, use a find and replace
	 * to change 'softgroup' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'softgroup', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'softgroup' ),
		) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'softgroup_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
		) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'softgroup_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function softgroup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'softgroup_content_width', 640 );
}
add_action( 'after_setup_theme', 'softgroup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function softgroup_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'softgroup' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'softgroup' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );
	register_sidebar( array(
		'name' => esc_html__( 'My Sidebar', 'softgroup' ),
		'id' => 'my-sidebar',
		'description' => esc_html__( 'The main sidebar appears on the right on each page except the front page template', 'softgroup' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		) );
}
add_action( 'widgets_init', 'softgroup_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function softgroup_scripts() {
	wp_enqueue_style( 'softgroup-style', get_stylesheet_uri() );

	wp_enqueue_script( 'softgroup-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'softgroup-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'softgroup_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

																			//NEXT CODE was wrote by Junior WordPress Developer J.Krot

// add Format Types to the Theme
add_theme_support( 'post-formats', array( 'aside', 'status', 'quote', 'chat', 'link', 'image', 'gallery', 'audio', 'video') );

//register menus position
//location on the page=> name in Admin panel;
register_nav_menus(array(
	'bottom' => 'Footer',
	'sidebar' => 'Sidebar'
	));

// post formats for Page type
add_post_type_support( 'page', 'post-formats' );

//Post format - LINK
function get_first_link (){
	if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ))
		return false;
	return esc_url_raw($matches[1]);
}
//Second "Hello from Hell" )

//our sidebar registration on line 91

//START ADD NEW ELEMETT TO CUSTOMIZATION

function course_register_theme_customizer( $wp_customize ) {

	//Add settings
	$wp_customize->add_setting(
		'cource_link_color',
		array(
			'default'     => '#000000'
			)
		);

// add control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label'      => __( 'Link Color', 'cource' ),
				'section'    => 'colors',
				'settings'   => 'cource_link_color'
				)
			)
		);

// Update Settings
	function cource_customizer_css() {
		?>
		<style type="text/css">
			a { color: <?php echo get_theme_mod( 'cource_link_color' ); ?>; }
		</style>
		<?php
	}
	add_action( 'wp_head', 'cource_customizer_css' );

// Update options
	$wp_customize->add_setting(
		'course_link_color',
		array(
			'default'     => '#000000',
			'transport'   => 'postMessage'
			)
		);


// Add live preview function and registering new JS file
	function course_customizer_live_preview() {
		wp_enqueue_script(
			'course-theme-customizer',
			get_template_directory_uri() . '/js/theme-customizer.js',
			array( 'jquery', 'customize-preview' ),
			'0.3.0',
			true
			);
	}
	add_action( 'customize_preview_init', 'course_customizer_live_preview' );

//NEW SECTION
	// Add new section
	$wp_customize->add_section(
		'social_options',
		array(
			'title'     =>  'Social',
			'priority'  => 200,
			)
		);
/*
SEPARATOR
*/
//Add settings
	$wp_customize->add_setting(
		'separator',
		array(
			'section' => 'social_options',
			'default'     => '-',
			'transport'   => 'postMessage',
			)
		);

	$wp_customize->add_control( 'separator', array(
	'label' => 'Separator between Title & Category List',
	'section' => 'social_options',
	'settings' => 'separator',
	'type' => 'text',
	'priority' => 1
	) );


	//Add settings
	$wp_customize->add_setting(
		'facebook',
		array(
			'section' => 'social_options',
			'default'     => '',
			'transport'   => 'postMessage',
			)
		);

	// add control
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'facebook', array(
	'label' => 'Icon of facebook :',
	'section' => 'social_options',
	'settings' => 'facebook',
	'priority' => 7
	) ) );

$wp_customize->add_setting(
	'facebook-link',
	array(
		'section' => 'social_options',
		'default'     => 'https://www.facebook.com/',
		'transport'   => 'postMessage',
		)
	);

$wp_customize->add_control( 'facebook-link', array(
	'label' => 'You page in Facebook',
	'section' => 'social_options',
	'type' => 'text',
	'priority' => 8
	) );

//Add settings
$wp_customize->add_setting(
	'vk',
	array(
		'section' => 'social_options',
		'default'     => '',
		'transport'   => 'postMessage',
		)
	);
/*

*/
	// add control
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vk', array(
	'label' => 'Icon of vk :',
	'section' => 'social_options',
	'settings' => 'vk',
	'priority' => 3
	) ) );

$wp_customize->add_setting(
	'vk-link',
	array(
		'section' => 'social_options',
		'default'     => 'https://www.vk.com/',
		'transport'   => 'postMessage',
		)
	);

$wp_customize->add_control( 'vk-link', array(
	'label' => 'You page in VK',
	'section' => 'social_options',
	'type' => 'text',
	'priority' => 4
	) );

//Add settings
	$wp_customize->add_setting(
		'google',
		array(
			'section' => 'social_options',
			'default'     => '',
			'transport'   => 'postMessage',
			)
		);

	// add control
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'google', array(
	'label' => 'Icon of Google+ :',
	'section' => 'social_options',
	'settings' => 'google',
	'priority' => 5
	) ) );

$wp_customize->add_setting(
	'google-link',
	array(
		'section' => 'social_options',
		'default'     => 'https://www.google.com/',
		'transport'   => 'postMessage',
		)
	);

$wp_customize->add_control( 'google-link', array(
	'label' => 'You page in Google',
	'section' => 'social_options',
	'type' => 'text',
	'priority' => 6
	) );



    //Add settings
$wp_customize->add_setting(
	'course_link_color',
	array(
		'default'     => '#000000',
		'transport'   => 'postMessage'
		)
	);

	// add control
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'link_color',
		array(
			'label'      => __( 'Link Color', 'course' ),
			'section'    => 'colors',
			'settings'   => 'course_link_color'
			)
		)
	);



}
add_action( 'customize_register', 'course_register_theme_customizer');

//END ADD NEW ELEMETT TO CUSTOMIZATION