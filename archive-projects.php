<?php
/**
 * Project archive pages.
 */

get_header(); ?>

<section id="primary" class="content-area">
  <!-- Here -->
  <div id="content" class="site-content" role="main">
    <?php if ( have_posts() ) : ?>
  
    <div id="dynamic-grid" class="clearfix dynamic-grid">
    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'projects' );
					?>
    <?php endwhile; ?>
   </div> 
   
    <?php else : ?>
    <?php get_template_part( 'no-results', 'archive' ); ?>
    <?php endif; ?>
  </div>
  <!-- #content .site-content --> 
</section>
<!-- #primary .content-area -->

<?php if( get_theme_mod( 'sidebar_in_posts_index' ) == 'on' ) get_sidebar(); ?>
<?php get_footer(); ?>
