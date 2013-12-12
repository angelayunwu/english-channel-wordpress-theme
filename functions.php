<?php
/**
 * EC functions and definitions
 *
 * @package english-channel
 * @since English-Channel 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since English-Channel 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 660; /* pixels */



function emphaino_default_settings( $setting = '' )
{
	$defaults = array(
		'logo_image'            => '',
		'posts_layout'          => 'dynamic_grid_excerpts',
		'full_posts_feat_img'   => 'on',
		'sidebar_in_posts_index'=> false,
		'footer_text'           => '&copy; '. date('Y') .' '. get_bloginfo('name').'.',
		'link_color'			=> '#388ca4',
		'non_responsive'        => false,
		'disable_webfonts'      => false,
		'disable_backtotop'		=> false,
		'custom_css'            => '',
		'header_textcolor'      => '555'
		
	);

	apply_filters( 'emphaino_default_settings', $defaults );

	if($setting) return $defaults[$setting];
	else return $defaults;
}


if ( ! function_exists( 'emphaino_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Emphaino 1.0
 */
function emphaino_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require get_template_directory() . '/inc/extras.php';

  

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'emphaino', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Post thumbnail size for excerpts and search results
	add_image_size( 'half-width', 280, 9999 ); // Post thumbnail size for dynamic grid posts
	add_image_size( 'full-width', 660, 9999 ); // Post thumbnail size for full post displays

	

	

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'emphaino' ),
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */
	add_editor_style();

	/**
	 * This theme uses its own gallery styles.
	 */
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // emphaino_setup
add_action( 'after_setup_theme', 'emphaino_setup' );

/**
 * Register widgetized area
 *
 * @since Emphaino 1.0
 */
function emphaino_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'emphaino' ),
		'id' => 'footer-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar', 'emphaino' ),
		'description' => (get_theme_mod('sidebar_in_posts_index') == 'on')?__( 'Appears in blog home, archives, single posts and pages.', 'emphanio' ):__( 'Appears in single posts and pages.', 'emphaino' ),
		'id' => 'the-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'emphaino_widgets_init' );


/**
 * Enqueue webfonts
 */
function dlts_enqueue_webfonts() {
	$font_families[] = 'PT+Sans:400,700,400italic';
	$font_families[] = 'Montserrat:700,400';
	$font_families[] = 'Bree+Serif';
	$font_families[] = 'Lato:100,300,400,700,100italic,300italic,400italic,700italic';
	

	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array(
		'family' => implode( '|', $font_families ),
	);
	wp_enqueue_style( 'webfonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
}


/**
 * Enqueue scripts and styles
 */
function dlts_scripts() {

	$theme  = wp_get_theme();

	dlts_enqueue_webfonts();	

	wp_enqueue_style( 'style', get_stylesheet_uri(), false, $theme->Version, 'screen, projection' );

	wp_enqueue_style( 'print', get_template_directory_uri() . '/print.css', false, $theme->Version, 'print' );

	wp_register_style( 'ie-style', get_template_directory_uri() . '/ie.css', false, $theme->Version, 'screen, projection' );
	$GLOBALS['wp_styles']->add_data( 'ie-style', 'conditional', 'lt IE 9' );
	wp_enqueue_style( 'ie-style' );
	wp_enqueue_style( 'flex', get_template_directory_uri() . '/flexslider/flexslider.css', false, $theme->Version, 'screen, projection' );
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), $theme->Version, true );

	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'jquery-masonry', true );
	
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'emphaino-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), $theme->Version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	
}
add_action( 'wp_enqueue_scripts', 'dlts_scripts' );




function ec_head()
{
	echo '<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>';
	
}
add_action( 'wp_head', 'ec_head' );






/**
 * Enqueues google fonts css for the custom header admin preview page.
 *
 * @since Emphaino 1.0
 */
function emphaino_custom_header_admin_scripts()
{
	if( 'appearance_page_custom-header' == get_current_screen()->id && get_theme_mod('disable_webfonts') != 'on' && !get_theme_mod('logo_image') && 'blank' !=  get_header_textcolor()) {
		emphaino_enqueue_webfonts();
	}
}
add_action( 'admin_enqueue_scripts', 'emphaino_custom_header_admin_scripts' );



/**
 * Custom classes for the body tag
 *
 * @since Emphaino 1.0
 */
function emphaino_body_class($classes)
{
	if( get_theme_mod('non_responsive') == 'on' )
		$classes[] = 'non-responsive';
	else 
		$classes[] = 'responsive';

	$header_image = get_header_image();
	if ( ! empty( $header_image ) )
		$classes[] = 'custom-header';
	else
		$classes[] = 'no-custom-header';

	if( 'blank' == get_header_textcolor() )
		$classes[] = 'header-text-hidden';

	if( get_theme_mod( 'logo_image' ) )
		$classes[] = 'has-logo-image';
	else
		$classes[] = 'no-logo-image';

	if( is_active_sidebar( 'the-sidebar' ) && !( ( is_home() || is_archive() ) && ( get_theme_mod( 'sidebar_in_posts_index' ) != 'on' ) ) )
		$classes[] = 'has-sidebar';
	else
		$classes[] = 'no-sidebar';

	if( ! is_singular() ) {
		$classes[] = str_replace( '_', '-', get_theme_mod( 'posts_layout', emphaino_default_settings('posts_layout') ) );
	}

	if( is_singular() && ! get_option('show_avatars') )
		$classes[] = 'no-comment-avatars';

	return $classes;
}

//add_filter( 'body_class', 'emphaino_body_class' );

/**
 * Custom post classes.
 *
 * @since Emphaino 1.0
 */
function emphaino_post_class( $classes ) {
	if( has_post_thumbnail() ) // Check if the current post has a post thumbnail
		$classes[] = 'has-post-thumbnail';
	return $classes;
}
add_filter( 'post_class', 'emphaino_post_class' );

/* DLTS */

add_filter( 'manage_taxonomies_for_news_columns', 'my_news_columns' );
function my_news_columns( $taxonomies ) {
    $taxonomies[] = 'kind';
    return $taxonomies;
}

