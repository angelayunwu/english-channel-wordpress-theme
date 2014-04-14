<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if (is_single() || is_page()) : ?>
  <div class="entry-content">
    <?php if( has_post_thumbnail() && 'on' == get_theme_mod( 'full_posts_feat_img', emphaino_default_settings('full_posts_feat_img') ) ): ?>
    <div class="featured-image">
      <?php the_post_thumbnail('full-width'); ?>
    </div>
    <?php endif; // featured image ?>
    <?php the_content(); ?>
  
  </div>
  <!-- .entry-content -->
  <?php else: ?>
  <header class="entry-header">
    <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'emphaino' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
      <?php the_title(); ?>
      </a></h1>
  </header>
  <!-- .entry-header -->
  
  <div class="entry-summary">
    <?php if( has_post_thumbnail() ): ?>
    <div class="featured-image"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
      <?php
						the_post_thumbnail();
					?>
      </a> </div>
    <?php endif; // featured image ?>
    <?php the_excerpt(); ?>
  </div>
    <?php endif;  ?>
</article>
<!-- #post-<?php the_ID(); ?> --> 
