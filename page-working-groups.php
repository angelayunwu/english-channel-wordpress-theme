<?php
/*
Template Name: Working Groups
*/

get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" >
    <?php 

				$args = array(
   # 'orderby'       => 'name', 
   # 'order'         => 'ASC',
    'hide_empty'    => 0
); 

		$terms = get_terms("working-groups", $args);
    $count = count($terms);
 if ( $count > 0 ){
    
	foreach ( $terms as $term ) {
		echo "<article class='hentry brick'>" . '<header class="entry-header"><h1 class="entry-title"><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View working group page: %s', 'my_localization_domain'), $term->name) . '">' .  $term->name . "</a></h1></header>";
 		

 		$t_id = $term->term_id;
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" );
	$t = trim($term_meta['wg_short']);
  if (!empty($t)){ 
echo '<div class="entry-summary">' . $term_meta['wg_short'] . '</div>'; 
  } else {
  
    echo '<div class="entry-summary">' .  wp_trim_words( $term->description, $num_words = 30, $more = '...' ) . '</div>';
  }
       	echo "</article>"; 
     }
 }
			 ?>
  </div>
  <!-- #content .site-content --> 
</div>
<!-- #primary .content-area -->

<?php get_footer(); ?>
