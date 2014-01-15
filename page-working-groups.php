<?php
/*
Template Name: Working Groups
*/

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
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
 	echo '<div class="entry-summary">' . $term->description . '</div>';
       echo "</article>";
        
     }
    
 }


				 ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>