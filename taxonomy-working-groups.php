<?php
/**
 * Working Group Pages.
 *
 */

get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<section id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
   
 <div id="dynamic-grid" class="clearfix dynamic-grid">


 <header class="page-header brick brick2"> <div class="archive-description"> 
      <?php if ( !empty( $term->description ) ): ?>
     <?php echo ($term->description); ?> 
       <?php else:   ?>
      Description coming soon.
      <?php endif; ?>

         <?php
  $t_id = $term->term_id;
  // retrieve the existing value(s) for this meta field. This returns an array
  $term_meta = get_option( "taxonomy_$t_id" );
  $u = trim($term_meta['wg_url']);
  if (!empty($u)){ ?>
       <div class="wg_url"><a href="<?php echo $u ?>"><?php echo $u ?></a></div>
  <?php }  ?>



       </div>
   </header>
    <!-- .page-header -->


      <!--  EVENTS  -->

   

          <?php 
          	global $post;
  		$all_events = tribe_get_events(array('eventDisplay'=>'upcoming','posts_per_page'=>3,
  			'tax_query'=> array(array('taxonomy' => 'working-groups','field' => 'slug','terms' => $term->slug))));
      if (count($all_events) > 0){
        ?>
         <div class="brick brick2">
    <h3  class="post-type">Event<?php echo (count($all_events) >1 ) ? 's' : ''; ?></h3>
    <ul class= "tribe_events tribe-events-list">
      <?php 
  		foreach($all_events as $post) {
    		setup_postdata($post);
    		?>
         <li class="hentry" id="post-<?php the_ID(); ?>" >
          		<?php tribe_get_template_part( 'list/single', 'event-ec' ) ?>
          
          </li>
          <?php } //endforeach 
          ?>
        </ul></div>
        <?php
        } // end if 

        ?>
       
<!--  END EVENTS  -->


    <?php 	
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
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
?>

	<div class="brick brick2" >
      <h3 class="post-type">News and Notes</h3>
      <?php
		  while ( $the_query->have_posts() ) : $the_query->the_post(); 
				  get_template_part( 'content', 'news' );			
		  endwhile;  ?>
    </div>
    <?php } ?>
<!--  END News  -->

<!--  Start people  -->
    
 <?php

	$t_id = $term->term_id;
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" );
	$t = trim($term_meta['working-groups']);
  if (!empty($t)){ ?>
      <div class="brick brick1 freehtml-area" >
      <h3 class="post-type">People</h3>
      <div class="hentry"><article><?php echo $term_meta['working-groups']; ?></article></div></div>
  <?php }  ?>


<!--  END people  -->

<!--  Start projects  -->

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
if ( $the_query->have_posts() ) {

 ?>
    <div class="brick brick2">
      <h3  class="post-type">Related Project<?php echo ($the_query->post_count >1 ) ? 's' : ''; ?></h3>

<?php


while ( $the_query->have_posts() ) : $the_query->the_post();
		get_template_part( 'content', 'projects3' );
endwhile; ?>
    </div>
<?php 
} 
?>

  </div> <!-- #dynamic-grid -->
  </div>
  <!-- #content .site-content --> 
</section>
<!-- #primary .content-area -->

<?php get_footer(); ?>
