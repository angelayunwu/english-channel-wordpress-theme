<?php
/**
 * Taxonomy pages
 *
 */

get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" >
    <header class="page-header">
      <?php if ( !empty( $term->description ) ): ?>
      <div class="archive-description"> <?php echo esc_html($term->description); ?> </div>
      <?php endif; ?>
    </header>
    <!-- .page-header -->
    <?php
 // $the_query = new WP_Query( $args );
  $x = get_query_var( 'taxonomy' );
  while ( have_posts() ) : the_post();
      if ($x == 'project-types') {
          get_template_part( 'content', 'projects');
      } else if ($x == 'kind'){
        get_template_part( 'content', 'news');
      }
  endwhile;
 ?>
  </div>
  <!-- #content .site-content --> 
</div>
<!-- #primary .content-area -->

<?php get_footer(); ?>
