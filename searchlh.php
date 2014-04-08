<?php
/**
* The template for displaying Search Results pages.
*/
get_header(); ?>
<section id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
    <?php if ( have_posts() ) :
    $numR = $wp_query->found_posts;
    ?>
    <header class="page-header">
      <h2 class="page-desc">
      <?php
      echo 'Showing ' . $numR . ' result'. (($numR > 1) ? 's ' : ' ') . ' for: ' . '<span>' . get_search_query() . '</span>' ;
      ?>
      </h2>
    </header>
    <!-- .page-header -->
    
    <?php
// working
$search_query = trim(get_search_query());
 $querystr = $wpdb->prepare( "
    SELECT $wpdb->terms.name, $wpdb->term_taxonomy.description 
    FROM $wpdb->terms
    LEFT JOIN $wpdb->term_taxonomy
    ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
    WHERE $wpdb->term_taxonomy.taxonomy = 'working-groups'
    AND $wpdb->terms.name LIKE %s
    LIMIT 15", "%". $search_query . "%");
// //
 $pageterms = $wpdb->get_results($querystr,  OBJECT);
 
 ?>
<?php if ($pageterms): ?>
 <?php //global $post; ?>
 <?php foreach ($pageterms as $wg): ?>
 <article class="hentry">
  <h1><?php echo $wg->name; ?></h1>
  <div><?php echo $wg->description; ?></div>
</article>
 <?php endforeach; ?>
 
 <?php endif; ?>


  <?php  
    $args = array( 'post_type' => 'tribe_events', 's'=> get_search_query() );
    $e_query = new WP_Query( $args); 
    if ( $e_query->have_posts() ) :
      echo '<h3>Events</h3><div class="tribe-events-list">';
   
      while ( $e_query->have_posts() ) : $e_query->the_post();  ?>
        <!-- Search Event  LMH -->
    <div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
      <?php tribe_get_template_part( 'list/single', 'event-listing' ) ?>
    </div><!-- .hentry .vevent -->
    <?php
      endwhile;
      echo "</div>";
    endif;
    ////


    $args = array( 'post_type' => 'news', 's'=> get_search_query() );
    $news_query = new WP_Query( $args);
    if ( $news_query->have_posts() ) :
      echo "<h3>News and Notes</h3>";
      while ( $news_query->have_posts() ) : $news_query->the_post();
         get_template_part( 'content', 'news' );
      endwhile;
    endif;
    
  
 ///////
    $args = array( 'post_type' => 'projects', 's'=> get_search_query() );
    $p_query = new WP_Query( $args); 
    if ( $p_query->have_posts() ) :
      echo "<h3>Projects</h3>";
      while ( $p_query->have_posts() ) : $p_query->the_post(); 
        get_template_part( 'content', 'projects' ); 
      endwhile;
    endif;
    ////
 ///////
    $args = array( 'post_type' => 'page', 's'=> get_search_query() );
    $pa_query = new WP_Query( $args); 
    if ( $pa_query->have_posts() ) :
      echo "<h3>Pages</h3>";
      while ( $pa_query->have_posts() ) : $pa_query->the_post(); 
        get_template_part( 'content', 'page' ); 
      endwhile;
    endif;
    ////


    ?>
    <?php else : ?>
    <?php get_template_part( 'no-results', 'search' ); ?>
    <?php endif; ?>
  </div>
  <!-- #content .site-content -->
</section>
<!-- #primary .content-area -->
<?php get_footer(); ?>