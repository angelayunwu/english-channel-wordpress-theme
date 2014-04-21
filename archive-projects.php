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


<?php get_footer(); ?>
