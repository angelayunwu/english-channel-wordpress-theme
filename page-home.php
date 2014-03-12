<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
<section class="home-top ">
  <section class="home-top-left news">
    <h1 class="section-title"><a href="<?php echo get_site_url(); ?>/news/">News and Notes</a></h1>
    <?php  
    $args = array( 'post_type' => 'news', 'posts_per_page' => 5 );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
      get_template_part( 'content', 'announcements-home' );
    endwhile;
    ?>
  </section>
  <article class="twitter-widget">
    <div class="entry-summary"><a class="twitter-timeline" href="https://twitter.com/NYUEngChannel/english-channel-list" data-widget-id="431507761684164608" width=320 height=425>&nbsp;</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    </div>
    <!-- .entry-summary --> 
    
  </article>
  <!-- #post-<?php the_ID(); ?> --> 
  
</section>

      <?php wp_reset_query(); ?>
   <!--  </section> -->
    <section class="s3 projects">
    <h1 class="section-title"><a href="<?php echo get_site_url(); ?>/projects/">Featured Projects</a></h1>
    <?php  
   $args = array( 'post_type' => 'projects', 'posts_per_page' => 6 );
$loop = new WP_Query( $args );
?>
  <div id="dynamic-grid" class="clearfix dynamic-grid">

  <?php 
    while ( $loop->have_posts() ) : $loop->the_post();
 
      get_template_part( 'content', 'projects' );
    endwhile;

?>
  </div>
  </section>
  </div>
  <!-- #content .site-content --> 
</div>
<!-- #primary .content-area -->


<?php get_footer(); ?>
