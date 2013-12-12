<?php
/**
 * Project archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */

get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<section id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
    <header class="page-header">
      <h1 class="archive-title">Working Groups: <?php echo apply_filters( 'the_title', $term->name ); ?></h1>
      <?php if ( !empty( $term->description ) ): ?>
      <div class="archive-description"> <?php echo esc_html($term->description); ?> </div>
      <?php endif; ?>
    </header>
    <!-- .page-header -->
    <?php 

///////////////////////
	
$args = array(
	'post_type' => 'news',
	'tax_query' => array(
		array(
			'taxonomy' => 'working-groups',
			'field' => 'slug',
			'terms' => get_query_var('term')
		)
	)
);
$the_query = new WP_Query( $args );?>

<div id="dynamic-grid" class="clearfix">

    <div class="hentry">
      <h3 class="post-type">News and Notes</h3>
      <?php
		  while ( $the_query->have_posts() ) : $the_query->the_post(); 
				  get_template_part( 'content', 'projects2' );			
		  endwhile;  ?>
    </div>
    <?php
//////////
$args = array(
	'post_type' => 'projects',
	'tax_query' => array(
		array(
			'taxonomy' => 'working-groups',
			'field' => 'slug',
			'terms' => get_query_var('term')
		)
	)
);
unset($the_query);
$the_query = new WP_Query( $args );
 ?>
    <div class="hentry">
      <h3  class="post-type">Projects</h3>
<?php
while ( $the_query->have_posts() ) : $the_query->the_post();
		get_template_part( 'content', 'projects2' );
endwhile; ?>
    </div>
        <?php
//////////
$args = array(
	'post_type' => 'people',
	'tax_query' => array(
		array(
			'taxonomy' => 'working-groups',
			'field' => 'slug',
			'terms' => get_query_var('term')
		)
	)
);
$the_query = new WP_Query( $args );
 ?>
    <div class="hentry">
      <h3  class="post-type">People</h3>
<?php
while ( $the_query->have_posts() ) : $the_query->the_post();
		get_template_part( 'content', 'people' );
endwhile; ?>
    </div>
  </div> <!-- #dynamic-grid -->
  </div>
  <!-- #content .site-content --> 
</section>
<!-- #primary .content-area -->

<?php if( get_theme_mod( 'sidebar_in_posts_index' ) == 'on' ) get_sidebar(); ?>
<?php get_footer(); ?>
