<?php
/**
 * The Header for our theme.
 */

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0,user-scalable=no" >

<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>

<?php wp_head(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.js" type="text/javascript"></script>
<![endif]-->


<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function()
{ (i[r].q=i[r].q||[]).push(arguments)}
,i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-54671719-1', 'auto');
ga('send', 'pageview');
</script>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<?php do_action( 'before' ); ?>
<header class="site-header" role="banner">
  <div class="header-main">
    <div class="header-r-hold">
    <h2 class="site-description">
      <?php bloginfo( 'description' ); ?>
    </h2>
    <div class="searchB">&nbsp;</div>
     <?php get_search_form(); ?>
  </div>
    <a class="site-branding-a" href="<?php echo esc_url( home_url( '/' ) ); ?>"  rel="home">
         <div class="site-branding">
      <h1 class="site-title">
        <?php bloginfo( 'name' ); ?>
      </h1>
    </div>
    </a> </div>
</header>
<!-- .site-header -->
<main id="main" role="main">

<div id="top-block">
  <div class="rowhold">
    <?php

wp_reset_query();
if ( is_page( 'Home Page' ) ) : ?>
    <section class="left-block" id="slideshow">
      <div class="flexslider">
        <ul class="slides tribe_events">
          <?php
global $post;
$all_events = tribe_get_events( array( 'eventDisplay'=>'upcoming', 'posts_per_page'=>3 ) );
foreach ( $all_events as $post ) {
  setup_postdata( $post );
?>
          <li id="post-<?php the_ID(); ?>" >
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="event-thumb">
              <?php the_post_thumbnail( 'thumbnail' ); ?>
            </div>
            <?php }  ?>
            <div class="event-body <?php echo has_post_thumbnail() ? 'thumbtrue' : ''?>">
              <h3 ><a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
                <span class="meta-nav">&rarr;</span> </a></h3>
              <?php
  $subtitle = types_render_field( "subtitle", array( "raw"=>"true" ) );
  if ( !empty( $subtitle ) ) {
    echo "<h4 class='subtitle'>$subtitle</h4>";
  }
?>
              <div class="event-excerpt">
                <?php the_excerpt(); ?>
              </div>
              <?php
  echo '<time datetime="' . tribe_get_start_date( $post->ID, false, 'Y-m-d' ) . '">';
  echo '<span class="dayofweek">' .tribe_get_start_date( $post->ID, false, 'l' ) . '</span>';
  echo '<span class="dayofmonth">' .tribe_get_start_date( $post->ID, false, 'j' ) . '</span>';
  echo '<span class="mon">' .tribe_get_start_date( $post->ID, false, 'F' ) . '</span>';
  echo '<span class="time">'.  tribe_get_start_date( $post->ID, false, 'g:i A' )  . '</span></time>';
?>
            </div>
          </li>
          <?php } //endforeach ?>
        </ul>
      </div>
    </section>
    <!-- .site-navigation .main-navigation -->

    <?php else:


?>
    <div class="left-block" >
      <header class="page-header">
        <h1 class="page-title">
          <?php
          if ( is_single() ) {
            if ( get_post_type() == 'tribe_events' ) {
              echo 'Event';
            } else {
              the_title();
            }
          } else if ( is_post_type_archive( 'tribe_events' ) ) {
            //  echo tribe_get_current_month_text();
            tribe_events_title();

          } else if ( is_post_type_archive() ) {
            post_type_archive_title();
          } else if ( is_tag( '' ) ) {
            echo '<span class="type_flag">Tag:</span>';
            wp_title( '', true );
          } else if ( is_search() ) {
            echo 'Search Results';
          } else if ( is_tax( 'kind' ) ) {
            //$obj = get_post_type_object( 'news' );
            //$myCPT = $obj->labels->name;
            //wp_title( "'<h2>' . $myCPT . '</h2>'", true);
            echo '<span class="type_flag">News and Notes:</span>';
            echo wp_title( '', false ). 's';
          } else if ( is_tax( 'project-types' ) ) {
            echo '<span class="type_flag">Projects:</span>';
            echo  wp_title( '', false ) . 's';
          } else {
            wp_title( '', true );
          }
          ?></h1>
        <?php
if ( is_single() ) {
  $subtitle = types_render_field( "subtitle", array( "raw"=>"true" ) );
  if ( !empty( $subtitle ) ) {
    echo "<h2 class='subtitle'>$subtitle</h2>";
  }
}

if ( tribe_is_month() || tribe_is_list_view() ) {
  tribe_get_template_part( 'modules/bar' );
}
?>
      </header>
    </div> <!-- end left block -->
    <?php endif; ?>
    <nav role="navigation" class="site-navigation">
      <div class="home-page-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="icon-home"><span>Home</span></a></div>
      <h1 class="assistive-text icon-menu"><span>Menu</span></h1>
      <div class="assistive-text skip-link"><a href="#content" title="Skip to content">Skip to content</a></div>
      <?php
wp_nav_menu( array( 'theme_location' => 'primary' ) )   ;
?>
    </nav>
  </div>
</div>

<!-- End HEADER.PHP -->
