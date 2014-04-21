<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); ?>
<section id="primary" class="content-area">
  <div id="content" class="site-content" role="main">

       <?php
// Custom query for searching the titles and descriptions of custom taxonomy. 
$search_query = trim( get_search_query() );
$querystr = $wpdb->prepare( "
        SELECT $wpdb->terms.name, $wpdb->terms.slug, $wpdb->term_taxonomy.description
        FROM $wpdb->terms
        LEFT JOIN $wpdb->term_taxonomy
        ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        WHERE $wpdb->term_taxonomy.taxonomy = 'working-groups'
        AND $wpdb->terms.name LIKE %s
        LIMIT 15", "%". $search_query . "%" );
$pageterms = $wpdb->get_results( $querystr,  OBJECT );
$wgcount = count( $pageterms );
?>

    <?php
$numR = 0;
if ( have_posts() || ( $wgcount > 0 ) ) :
  $numR = ( $wp_query->found_posts ) + $wgcount;
?>
    <header class="page-header">
      <h2 class="page-desc">
      <?php
echo 'Showing ' . $numR . ' result'. ( ( $numR > 1 ) ? 's ' : ' ' ) . ' for: ' . '<span>' . get_search_query() . '</span>' ;
?>
      </h2>
    </header>
    <!-- .page-header -->
 <?php

// List out Working Groups, if any
if ( $pageterms ): ?>
        <?php foreach ( $pageterms as $wg ): ?>
        <article class="hentry type-projects type-working-group">
        <header class="entry-header">
          
          <h1 class="entry-title"><a href="working-groups/<?php echo $wg->slug; ?>"><span class="info">Working Group: &nbsp;</span><?php echo $wg->name; ?></a></h1></header>
        <div class="entry-summary"><?php echo $wg->description; ?></div>
        </article>
        <?php endforeach; ?>
<?php endif; ?>
      <?php
      // List out Content Types
      while ( have_posts() ) : the_post();
        $pt = get_post_type();
        get_template_part( 'content', $pt );
      endwhile; ?>


<?php else : ?>
<?php get_template_part( 'no-results', 'search' ); ?>
<?php endif; ?>
  </div>
  <!-- #content .site-content -->
</section>
<!-- #primary .content-area -->
<?php get_footer(); ?>
