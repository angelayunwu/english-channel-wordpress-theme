<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width" />

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header class="site-header" role="banner">
		<div class="header-main">
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<a class="site-branding-a"href="<?php echo esc_url( home_url( '/' ) ); ?>"  rel="home">
			<div class="site-branding">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>		
			</div></a>
		</div>
</header><!-- .site-header -->

	<div id="main" class="site-main">

		<section id="top-block">

			<nav role="navigation" class="site-navigation">
				<div class="home-page-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="icon-home"><span>Home</span></a></div>
				
				<?php if( $emphaino_menu = wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => '', 'echo' => false ) ) ): ?>

					<h1 class="assistive-text icon-menu"><span>Menu</span></h1>
					<div class="assistive-text skip-link"><a href="#content" title="Skip to content">Skip to content</a></div>
					<?php echo $emphaino_menu; ?>

				<?php endif; ?>

			</nav> 

<?php 

		wp_reset_query();
	if (is_page('Home Page')) : ?>
			<section class="left-block" id="slideshow">
				<div class="flexslider">
          	
          <ul class="slides tribe_events">
<?php 
          	global $post;
  		$all_events = tribe_get_events(array('eventDisplay'=>'upcoming','posts_per_page'=>3));
  		foreach($all_events as $post) {
    	setup_postdata($post);
    ?>
    <li id="post-<?php the_ID(); ?>" >

      <?php if ( has_post_thumbnail() ) { ?>
      <div class="event-thumb"> <?php the_post_thumbnail('thumbnail'); ?></div>
         <?php }  ?>

   
      <h3 ><a href="<?php the_permalink(); ?>">
        <?php the_title(); ?> <span class="meta-nav">&rarr;</span>
        </a></h3>
     <?php   
     $subtitle = types_render_field("subtitle", array("raw"=>"true"));
     if (!empty($subtitle)) {
        echo "<h4 class='subtitle'>$subtitle</h4>";
 		}
     ?>
      <div class="event-body">
      <div class="event-excerpt">
        <?php the_excerpt(); ?>
      </div>

         <?php
    echo '<time datetime="' . tribe_get_start_date($post->ID, false, 'Y-m-d') . '">';
       echo '<span class="dayofweek">' .tribe_get_start_date($post->ID, false, 'l') . '</span>';
    echo '<span class="dayofmonth">' .tribe_get_start_date($post->ID, false, 'j') . '</span>';
    echo '<span class="mon">' .tribe_get_start_date($post->ID, false, 'F') . '</span>';
    echo '<span class="time">'.  tribe_get_start_date($post->ID, false, 'g:i A')  . '</span></time>'; 
    ?>
     </div>
   </li>
      <?php } //endforeach ?>
          	</ul></div>
				 
			</section>
			<!-- .site-navigation .main-navigation -->
			

		
<?php else:

	
		?>

<section class="left-block" >
	<header class="page-header">
	<h1 class="page-title">
		
		<?php  
	if (is_single()) {
		the_title();
	} else if ( is_post_type_archive('projects') ) {
     post_type_archive_title(); 
		//echo "Digital Projects";
	} else if ( is_post_type_archive('news') ) {
     //post_type_archive_title(); 
		echo "News and Notes";
	} else {
		wp_title('', true);
	}
	?></h1>
 <?php   
 if (is_single()) {
     $subtitle = types_render_field("subtitle", array("raw"=>"true"));
     if (!empty($subtitle)) {
        echo "<h2 class='subtitle'>$subtitle</h2>";
 		}
 	}
     ?></header></section>
		<?php endif; ?>
</section>