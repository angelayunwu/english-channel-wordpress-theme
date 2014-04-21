<?php
/**
 * EC functions and definitions
 *
 * @package english-channel
 * @since English-Channel 1.0
 */




function emphaino_default_settings( $setting = '' )
{
 $defaults = array(
  'logo_image'            => '',
  'posts_layout'          => 'dynamic_grid_excerpts',
  'full_posts_feat_img'   => 'on',
  'sidebar_in_posts_index'=> false,
  'footer_text'           => '&copy; '. date('Y') .' '. get_bloginfo('name').'.',
  'link_color'   => '#388ca4',
  'non_responsive'        => false,
  'disable_webfonts'      => false,
  'disable_backtotop'  => false,
  'custom_css'            => '',
  'header_textcolor'      => '555'

 );

 apply_filters( 'emphaino_default_settings', $defaults );

 if($setting) return $defaults[$setting];
 else return $defaults;
}


function ec_customize_register( $wp_customize ) {
	//All our sections, settings, and controls will be added here
	$wp_customize->remove_section( 'nav' );
	$wp_customize->remove_section( 'static_front_page' );
	//$wp_customize->add_control( 'blogdescription' )->theme_supports=false;

}
add_action( 'customize_register', 'ec_customize_register' );


if ( ! function_exists( 'ec_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 */
	function ec_setup() {

		/**
		 * Custom template tags for this theme.
		 */
		require get_template_directory() . '/inc/template-tags.php';

		/**
		 * Custom functions that act independently of the theme templates
		 */
		require get_template_directory() . '/inc/extras.php';


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
				'primary' => 'Primary Menu'
			) );

		/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
		add_theme_support( 'post-formats', array(
				'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
			) );
		add_theme_support( 'html5', array( 'search-form' ) ) ;
		/**
		 * This theme styles the visual editor with editor-style.css to match the theme style.
		 */
		add_editor_style();

		/**
		 * This theme uses its own gallery styles.
		 */
		add_filter( 'use_default_gallery_style', '__return_false' );
	}
endif; // ec_setup
add_action( 'after_setup_theme', 'ec_setup' );

/**
 * Register widgetized area
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
			'description' => ( get_theme_mod( 'sidebar_in_posts_index' ) == 'on' )?__( 'Appears in blog home, archives, single posts and pages.', 'emphanio' ):__( 'Appears in single posts and pages.', 'emphaino' ),
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
	wp_enqueue_style( 'responsive-nav', get_template_directory_uri() . '/responsive-nav.css', false, $theme->Version, 'screen, projection' );
	wp_enqueue_style( 'print', get_template_directory_uri() . '/print.css', false, $theme->Version, 'print' );

	wp_register_style( 'ie-style', get_template_directory_uri() . '/ie.css', false, $theme->Version, 'screen, projection' );

	$GLOBALS['wp_styles']->add_data( 'ie-style', 'conditional', 'lt IE 9' );
	wp_enqueue_style( 'ie-style' );
	wp_enqueue_style( 'flex', get_template_directory_uri() . '/flexslider/flexslider.css', false, $theme->Version, 'screen, projection' );
	//wp_enqueue_script( 'respondIE8', get_template_directory_uri() . '/js/respond.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'responsive-nav', get_template_directory_uri() . '/js/responsive-nav.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'jquery-masonry', true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'underscore', get_template_directory_uri() . '/js/underscore-min.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'dlts_scripts' );

function ec_head() {
	echo '<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>';
}
add_action( 'wp_head', 'ec_head' );



/**
 * Enqueues google fonts css for the custom header admin preview page.
 *
 */
function emphaino_custom_header_admin_scripts()
{
 if( 'appearance_page_custom-header' == get_current_screen()->id && get_theme_mod('disable_webfonts') != 'on' && !get_theme_mod('logo_image') && 'blank' !=  get_header_textcolor()) {
  emphaino_enqueue_webfonts();
 }
}
add_action( 'admin_enqueue_scripts', 'emphaino_custom_header_admin_scripts' );



/**
 * Custom post classes.
 *
 */
function ec_post_class( $classes ) {
	if ( has_post_thumbnail() ) // Check if the current post has a post thumbnail
		$classes[] = 'has-post-thumbnail';
	return $classes;
}
add_filter( 'post_class', 'ec_post_class' );

/* Admin area facelift  */

function ec_news_columns( $taxonomies ) {
	$taxonomies[] = 'kind';
	return $taxonomies;
}
add_filter( 'manage_taxonomies_for_news_columns', 'ec_news_columns' );
//////////

//http://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies/
// Add term page
function ec_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
?>
	<div class="form-field">
		<label for="term_meta[wg_short]">Short description</label>

		<textarea rows="3" cols="40" name="term_meta[wg_short]" id="term_meta[wg_short]"> </textarea>

		<p class="description">Enter a short description here</p>
	</div>
	<div class="form-field">
		<label for="term_meta[working-groups]">Names here</label>


		<textarea rows="10" cols="40" name="term_meta[working-groups]" id="term_meta[working-groups]"> </textarea>

		<p class="description">Enter a list of members' names here</p>
	</div>

	<div class="form-field">
		<label for="term_meta[wg_url]">URL here</label>
		<input type="text" name="term_meta[wg_url]" id="term_meta[wg_url]" value="">
		<p class="description">Enter URL</p>
	</div>
<?php
}

add_action( 'working-groups_add_form_fields', 'ec_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function ec_taxonomy_edit_meta_field( $term ) {

	// put the term ID into a variable
	$t_id = $term->term_id;

	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[wg_short]">Short description</label></th>
		<td>
		<!-- 	<input type="text" name="term_meta[working-groups]" id="term_meta[working-groups]" value="<?php //echo esc_attr( $term_meta['working-groups'] ) ? esc_attr( $term_meta['working-groups'] ) : ''; ?>">
-->
			<textarea rows="3" name="term_meta[wg_short]" id="term_meta[wg_short]"> <?php echo esc_attr( $term_meta['wg_short'] ) ? esc_attr( $term_meta['wg_short'] ) : ''; ?></textarea>
			<p class="description">Enter short description</p>
		</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[working-groups]">Names</label></th>
		<td>
		<!-- 	<input type="text" name="term_meta[working-groups]" id="term_meta[working-groups]" value="<?php //echo esc_attr( $term_meta['working-groups'] ) ? esc_attr( $term_meta['working-groups'] ) : ''; ?>">
-->
			<textarea rows="12" name="term_meta[working-groups]" id="term_meta[working-groups]"> <?php echo esc_attr( $term_meta['working-groups'] ) ? esc_attr( $term_meta['working-groups'] ) : ''; ?></textarea>
			<p class="description">Enter names</p>
		</td>
	</tr>

	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[wg_url]">URL</label></th>
		<td>
			<input type="text" name="term_meta[wg_url]" id="term_meta[wg_url]" value="<?php echo esc_attr( $term_meta['wg_url'] ) ? esc_attr( $term_meta['wg_url'] ) : ''; ?>" >
			<p class="description">enter URL, including the http: part</p>
		</td>
	</tr>
<?php
}
add_action( 'working-groups_edit_form_fields', 'ec_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {

			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$value = $_POST['term_meta'][$key];
				$value = get_magic_quotes_gpc() ? $value : stripslashes($value);

				$term_meta[$key] = $value;
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}
add_action( 'edited_working-groups', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_working-groups', 'save_taxonomy_custom_meta', 10, 2 );
/// allow html in descriptions
//http://docs.woothemes.com/document/allow-html-in-term-category-tag-descriptions/

foreach ( array( 'pre_term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_filter_kses' );
}

foreach ( array( 'term_description' ) as $filter ) {
	remove_filter( $filter, 'wp_kses_data' );
}

////
////http://wordpress.stackexchange.com/questions/29020/how-to-remove-taxonomy-name-from-wp-title
function ec_remove_tax_name( $title, $sep, $seplocation ) {
	if ( is_tax() ) {
		$term_title = single_term_title( '', false );

		// Determines position of separator
		if ( 'right' == $seplocation ) {
			$title = $term_title . " $sep ";
		} else {
			$title = " $sep " . $term_title;
		}
	}

	return $title;
}
add_filter( 'wp_title', 'ec_remove_tax_name', 10, 3 );

///////
//add_filter( 'pre_get_posts', 'query_post_type' );

function query_post_type( $query ) {
	if ( is_category() || is_tag() ) {
		$post_type = get_query_var( 'post_type' );
		//if($post_type) {
		//    $post_type = $post_type;
		// } else {
		$post_type = array( 'nav_menu_item', 'post', 'projects', 'news', 'events' );
		$query->set( 'post_type', $post_type );
		return $query;
		// }
	} //else if ($query->is_search) {
		//$query->set('post_type', array( 'nav_menu_item', 'post', 'projects', 'news', 'events' ));
   // }
    //return $query;
}
////////
// To address bluehost limitations
// http://tri.be/support/forums/topic/events-displaying-on-website-but-not-in-admin-panel/page/2/
add_action( 'init', 'tribe_allow_large_joins' );
function tribe_allow_large_joins() {
	global $wpdb;
	$wpdb->query( 'SET SQL_BIG_SELECTS=1' );
}
